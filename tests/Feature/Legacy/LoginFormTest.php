<?php

use App\Legacy\Exceptions\LoginException;
use App\Legacy\Http\Controllers\LoginController;
use App\Legacy\Services\LoginService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Mockery\MockInterface;

function licenseRow(int $id, string $companies = 'Firma d.o.o.', int $login2fa = 0): object
{
    return (object) [
        'licenseID' => $id,
        'appCode' => 'TEST-CODE-'.$id,
        'companyNames' => $companies,
        'login_2fa' => $login2fa,
        'TimeAvailabilityGroup' => null,
    ];
}

beforeEach(function () {
    Config::set('legacy.login_form', true);
    Config::set('legacy.kancelarko_url', 'https://kancelarko.test');
});

test('/login je legacy login forma, a ne Fortify', function () {
    expect(Route::getRoutes()->getByName('login')?->getActionName())
        ->toBe(LoginController::class.'@showLoginForm');
    expect(Route::getRoutes()->getByName('login.store')?->getActionName())
        ->toBe(LoginController::class.'@login');
});

test('login forma se prikazuje (rokovnik Metronic strana)', function () {
    $this->get(route('login'))
        ->assertOk()
        ->assertViewIs('legacy.login')
        ->assertSee('m-login--1', false)
        ->assertSee('name="username"', false)
        ->assertSee('https://kancelarko.test/login?forget=1', false)
        ->assertSee('https://kancelarko.test/reg', false)
        ->assertDontSee('NoCaptcha');
});

test('kada je forma isključena /login šalje na Kancelarko', function () {
    Config::set('legacy.login_form', false);

    $this->get(route('login'))->assertRedirect('https://kancelarko.test');
    $this->post(route('login.store'), ['username' => 'neko@firma.rs', 'password' => 'tajna'])
        ->assertRedirect('https://kancelarko.test');
});

test('korisničko ime i lozinka su obavezni', function () {
    $this->from(route('login'))
        ->post(route('login.store'), [])
        ->assertRedirect(route('login'))
        ->assertSessionHasErrors(['username', 'password']);
});

test('pogrešni podaci vraćaju poruku, broj preostalih pokušaja i broje pokušaj', function () {
    $this->mock(LoginService::class, function (MockInterface $mock) {
        $mock->shouldReceive('matchingLicenses')->once()->with('neko@firma.rs', 'tajna', null)->andReturn([]);
        $mock->shouldNotReceive('complete');
    });

    $this->post(route('login.store'), ['username' => 'neko@firma.rs', 'password' => 'tajna'])
        ->assertRedirect(route('login'))
        ->assertSessionHas('fail', 'Nije dobro korisničko ime ili lozinka.')
        ->assertSessionHas('failNo', (int) config('legacy.login.max_attempts') - 1)
        ->assertSessionHasInput('username', 'neko@firma.rs');

    expect(RateLimiter::attempts('legacy-login|neko@firma.rs|127.0.0.1'))->toBe(1);

    $this->get(route('login'))->assertSee('Nije dobro korisničko ime ili lozinka.');
});

test('posle previše neuspelih pokušaja prijava je zaključana', function () {
    RateLimiter::increment('legacy-login|neko@firma.rs|127.0.0.1', amount: (int) config('legacy.login.max_attempts'));

    $this->mock(LoginService::class, function (MockInterface $mock) {
        $mock->shouldNotReceive('matchingLicenses');
    });

    $this->post(route('login.store'), ['username' => 'neko@firma.rs', 'password' => 'tajna'])
        ->assertRedirect(route('login'))
        ->assertSessionHas('fail', fn (string $message) => str_contains($message, 'Pristup je zabranjen'));
});

test('kada lozinka odgovara na više licenci prikazuje se izbor licence', function () {
    $this->mock(LoginService::class, function (MockInterface $mock) {
        $mock->shouldReceive('matchingLicenses')->once()
            ->andReturn([licenseRow(1, 'Firma A'), licenseRow(2, 'Firma B')]);
        $mock->shouldNotReceive('complete');
    });

    $this->post(route('login.store'), ['username' => 'neko@firma.rs', 'password' => 'tajna', 'remember' => 'on'])
        ->assertOk()
        ->assertViewIs('legacy.chooseLicense')
        ->assertViewHas('licenseCompany', fn (array $licenses) => count($licenses) === 2)
        ->assertSee('Firma A')
        ->assertSee('Firma B')
        ->assertSee('name="chooseLicense"', false)
        ->assertSessionHas('OldRequest', ['username' => 'neko@firma.rs', 'remember' => true, 'licenses' => [1, 2]])
        ->assertSessionMissing('OldRequest.password');

    expect(RateLimiter::attempts('legacy-login|neko@firma.rs|127.0.0.1'))->toBe(0);
});

test('izabrana licenca iz drugog koraka završava prijavu bez ponovne lozinke', function () {
    $this->mock(LoginService::class, function (MockInterface $mock) {
        $mock->shouldNotReceive('matchingLicenses');
        $mock->shouldReceive('licenseForUser')->once()->with('neko@firma.rs', 2)->andReturn(licenseRow(2));
        $mock->shouldReceive('sqlAccountExists')->once()->andReturn(true);
        $mock->shouldReceive('complete')->once()
            ->withArgs(fn (object $license, string $username, $request, string $via) => $license->licenseID === 2
                && $username === 'neko@firma.rs'
                && $via === LoginService::VIA_FORM);
    });

    $this->withSession(['OldRequest' => ['username' => 'neko@firma.rs', 'remember' => true, 'licenses' => [1, 2]]])
        ->post(route('login.store'), ['chooseLicense' => 'POST', 'licenseCompany' => 2])
        ->assertRedirect('/')
        ->assertSessionMissing('OldRequest')
        ->assertCookie('lID', 'neko@firma.rs')
        ->assertCookie('l_id', '2');
});

test('licenca koja nije bila u ponudi ne može da se izabere', function () {
    $this->mock(LoginService::class, function (MockInterface $mock) {
        $mock->shouldNotReceive('licenseForUser');
        $mock->shouldNotReceive('complete');
    });

    $this->withSession(['OldRequest' => ['username' => 'neko@firma.rs', 'remember' => false, 'licenses' => [1, 2]]])
        ->post(route('login.store'), ['chooseLicense' => 'POST', 'licenseCompany' => 3])
        ->assertRedirect(route('login'))
        ->assertSessionHas('fail', fn (string $message) => str_contains($message, 'Izbor licence'))
        ->assertSessionMissing('OldRequest');
});

test('licenca sa dvofaktorskom prijavom ne može kroz formu', function () {
    $this->mock(LoginService::class, function (MockInterface $mock) {
        $mock->shouldReceive('matchingLicenses')->once()->andReturn([licenseRow(1, login2fa: 1)]);
        $mock->shouldNotReceive('complete');
    });

    $this->post(route('login.store'), ['username' => 'neko@firma.rs', 'password' => 'tajna'])
        ->assertRedirect(route('login'))
        ->assertSessionHas('fail', fn (string $message) => str_contains($message, 'dvofaktorska'));
});

test('poruka iz LoginException se prikazuje na formi', function () {
    $this->mock(LoginService::class, function (MockInterface $mock) {
        $mock->shouldReceive('matchingLicenses')->once()->andReturn([licenseRow(1)]);
        $mock->shouldReceive('sqlAccountExists')->once()->andReturn(true);
        $mock->shouldReceive('complete')->once()
            ->andThrow(new LoginException('Period trajanja svih paketa licence je istekao.'));
    });

    $this->post(route('login.store'), ['username' => 'neko@firma.rs', 'password' => 'tajna'])
        ->assertRedirect(route('login'))
        ->assertSessionHas('fail', 'Period trajanja svih paketa licence je istekao.');
});

test('uspešna prijava vodi na početnu i pamti korisnika uz "zapamti me"', function () {
    RateLimiter::increment('legacy-login|neko@firma.rs|127.0.0.1', amount: 3);

    $this->mock(LoginService::class, function (MockInterface $mock) {
        $mock->shouldReceive('matchingLicenses')->once()->andReturn([licenseRow(7)]);
        $mock->shouldReceive('sqlAccountExists')->once()->andReturn(true);
        $mock->shouldReceive('complete')->once();
    });

    $this->post(route('login.store'), ['username' => 'neko@firma.rs', 'password' => 'tajna', 'remember' => 'on'])
        ->assertRedirect('/')
        ->assertCookie('lID', 'neko@firma.rs')
        ->assertCookie('l_id', '7');

    expect(RateLimiter::attempts('legacy-login|neko@firma.rs|127.0.0.1'))->toBe(0);
});

test('odjava posle prijave kroz formu vraća na formu', function () {
    $this->withSession(['legacyLoginVia' => LoginService::VIA_FORM])
        ->get(route('legacy.logout'))
        ->assertRedirect(route('login'))
        ->assertSessionHas('success');
});

test('odjava posle prijave sa Kancelarka ide na odjavu Kancelarka', function () {
    $this->withSession(['legacyLoginVia' => LoginService::VIA_KANCELARKO])
        ->get(route('legacy.logout'))
        ->assertRedirect('https://kancelarko.test/logout');
});
