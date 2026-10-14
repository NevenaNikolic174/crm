<?php

namespace App\Legacy\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Legacy\Auth\LegacyAuth;
use App\Legacy\Encrypt\ModuleEncrypter;
use App\Legacy\Exceptions\LoginException;
use App\Legacy\Http\Concerns\LegacyResponses;
use App\Legacy\Http\Requests\LoginRequest;
use App\Legacy\License\LicenseConnection;
use App\Legacy\License\OfficeMasterRepository;
use App\Legacy\Services\LoginService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class LoginController extends Controller
{
    use LegacyResponses;

    private const COOKIE_USERNAME = 'lID';

    private const COOKIE_LICENSE = 'l_id';

    public function __construct(
        private readonly ModuleEncrypter $encrypter,
        private readonly OfficeMasterRepository $officeMaster,
        private readonly LoginService $loginService,
    ) {}

    public function loginWithHash(string $hash, Request $request): Response
    {
        $data = $this->encrypter->getData($hash);

        if ($data === false) {
            return $this->errorView('Link nije validan.');
        }

        if (! $this->hashIsFresh($data)) {
            return $this->errorView('Link nije validan (istekao je). Pokušajte ponovo sa Kancelarka.');
        }

        $username = (string) ($data['username'] ?? '');
        $licenseId = (int) ($data['licenseID'] ?? 0);

        if ($username === '' || $licenseId <= 0) {
            return $this->errorView('Link nije validan.');
        }

        $licenses = $this->officeMaster->getUserLicenses($username, $licenseId);

        if ($licenses === []) {
            Log::channel('errorLogin')->info("Korisnik {$username} nije aktivan na licenci {$licenseId}");

            return $this->errorView('Korisnik nije aktivan na ovoj licenci.');
        }

        $license = $licenses[0];

        if (! $this->loginService->sqlAccountExists($license, $licenseId, $username)) {
            return $this->redirectToCreateSqlAccount($data, $licenseId);
        }

        try {
            $this->loginService->complete($license, $username, $request, LoginService::VIA_KANCELARKO);
        } catch (LoginException $e) {
            return $this->failedLogin($request, $e->getMessage());
        }

        return redirect(self::safeRoute($data['route'] ?? null));
    }

    public function showLoginForm(): Response
    {
        if (! config('legacy.login_form')) {
            return $this->externalRedirect($this->kancelarkoUrl());
        }

        if (LegacyAuth::check()) {
            return redirect(self::home());
        }

        return response()->view('legacy.login');
    }

    public function login(LoginRequest $request): Response
    {
        if (! config('legacy.login_form')) {
            return $this->externalRedirect($this->kancelarkoUrl());
        }

        $username = $request->username();
        $throttleKey = $this->throttleKey($request);

        if (RateLimiter::tooManyAttempts($throttleKey, $this->maxAttempts())) {
            Log::channel('errorLogin')->info('ID 429 - login lockout: '.$throttleKey);

            return $this->failedForm(
                $request,
                'Pristup je zabranjen zbog većeg broja neuspelih pokušaja prijave. '
                .'Pokušajte kasnije ili se obratite tehničkoj podršci: '.config('legacy.support_phones')
            );
        }

        if ($request->isChoosingLicense()) {
            $license = $this->chosenLicense($request);

            if ($license === null) {
                return $this->failedForm($request, 'Izbor licence nije važeći, prijavite se ponovo.');
            }
        } else {
            $licenses = $this->loginService->matchingLicenses($username, $request->password(), null);

            if ($licenses === []) {
                RateLimiter::hit($throttleKey, $this->decaySeconds());
                Log::channel('errorLogin')->info('ID 401 - fail login: '.$throttleKey);

                return $this->failedForm($request, 'Nije dobro korisničko ime ili lozinka.');
            }

            if (count($licenses) > 1) {
                $request->session()->put('OldRequest', [
                    'username' => $username,
                    'remember' => $request->remember(),
                    'licenses' => array_map(static fn (object $license): int => (int) $license->licenseID, $licenses),
                ]);

                return response()->view('legacy.chooseLicense', ['licenseCompany' => $licenses]);
            }

            $license = $licenses[0];
        }

        $request->session()->forget('OldRequest');
        $licenseId = (int) $license->licenseID;

        if ((int) ($license->login_2fa ?? 0) === 1) {
            return $this->failedForm($request, 'Za ovu licencu je uključena dvofaktorska prijava. Prijavite se preko Kancelarka.');
        }

        if (! $this->loginService->sqlAccountExists($license, $licenseId, $username)) {
            return $this->failedForm(
                $request,
                'Povezivanje na bazu licence nije uspelo. Prijavite se preko Kancelarka ili se obratite tehničkoj podršci: '
                .config('legacy.support_phones')
            );
        }

        try {
            $this->loginService->complete($license, $username, $request, LoginService::VIA_FORM);
        } catch (LoginException $e) {
            return $this->failedForm($request, $e->getMessage(), invalidateSession: true);
        }

        RateLimiter::clear($throttleKey);

        if ($request->remember()) {
            $minutes = (int) config('legacy.login.remember_minutes', 1051200);
            Cookie::queue(self::COOKIE_USERNAME, $username, $minutes);
            Cookie::queue(self::COOKIE_LICENSE, (string) $licenseId, $minutes);
        }

        return redirect()->intended(self::home());
    }

    public function logout(Request $request): RedirectResponse
    {
        $user = LegacyAuth::user();
        $viaForm = $request->session()->get('legacyLoginVia') === LoginService::VIA_FORM;

        if ($user !== null) {
            try {
                LicenseConnection::db()->table('users')->where('id', $user->id)->update(['userLoggedIn' => 0]);
            } catch (Throwable $e) {
                Log::channel('errorLogin')->warning('userLoggedIn=0 nije upisan: '.$e->getMessage());
            }
        }

        LegacyAuth::guard()->logout();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Cookie::queue(Cookie::forget(self::COOKIE_USERNAME));
        Cookie::queue(Cookie::forget(self::COOKIE_LICENSE));

        if ($viaForm && config('legacy.login_form')) {
            return redirect()->route('login')->with('success', 'Odjavljeni ste.');
        }

        return redirect($this->kancelarkoUrl('/logout'));
    }

    public static function safeRoute(mixed $route): string
    {
        $route = is_string($route) ? trim($route) : '';

        if ($route === '' || str_contains($route, '://') || str_starts_with($route, '//')) {
            return self::home();
        }

        return '/'.ltrim($route, '/');
    }

    private function chosenLicense(LoginRequest $request): ?object
    {
        $old = (array) $request->session()->get('OldRequest', []);
        $licenseId = $request->licenseId();

        if ($licenseId === null || ($old['username'] ?? null) !== $request->username()
            || ! in_array($licenseId, (array) ($old['licenses'] ?? []), true)) {
            return null;
        }

        return $this->loginService->licenseForUser($request->username(), $licenseId);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    private function hashIsFresh(array $data): bool
    {
        if (! isset($data['hash_created']) || ! is_numeric($data['hash_created'])) {
            return false;
        }

        return (int) $data['hash_created'] > time() - (int) config('legacy.hash_ttl', 300);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    private function redirectToCreateSqlAccount(array $data, int $licenseId): RedirectResponse
    {
        $data['licenseID'] = $licenseId;
        $data['server_ip'] = $_SERVER['SERVER_ADDR'] ?? gethostbyname((string) gethostname());
        $data['module_url'] = config('legacy.module_url');

        $hash = $this->encrypter->encrypt($data);

        return redirect($this->kancelarkoUrl('/no-mysql-account/'.$hash));
    }

    private function failedLogin(Request $request, string $message): Response
    {
        Log::channel('errorLogin')->info('Login failed: '.$message);
        $request->session()->invalidate();

        return $this->errorView($message);
    }

    private function failedForm(LoginRequest $request, string $message, bool $invalidateSession = false): RedirectResponse
    {
        $retriesLeft = RateLimiter::retriesLeft($this->throttleKey($request), $this->maxAttempts());

        if ($invalidateSession) {
            $request->session()->invalidate();
        }

        $request->session()->forget('OldRequest');

        return redirect()->route('login')
            ->withInput($request->only('username', 'remember'))
            ->with('fail', $message)
            ->with('failNo', $retriesLeft);
    }

    private function throttleKey(LoginRequest $request): string
    {
        return 'legacy-login|'.Str::transliterate(Str::lower($request->username())).'|'.$request->ip();
    }

    private function maxAttempts(): int
    {
        return (int) config('legacy.login.max_attempts', 10);
    }

    private function decaySeconds(): int
    {
        return (int) config('legacy.login.decay_minutes', 1440) * 60;
    }

    public static function home(): string
    {
        return (string) config('legacy.home', '/');
    }

    private function kancelarkoUrl(string $path = ''): string
    {
        return rtrim((string) config('legacy.kancelarko_url'), '/').$path;
    }
}
