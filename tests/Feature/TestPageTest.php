<?php

use Illuminate\Support\Facades\Config;

test('test strana traži legacy prijavu', function () {
    Config::set('legacy.kancelarko_url', 'https://kancelarko.test');
    Config::set('legacy.module_url', 'http://crm.test');

    $this->get(route('test'))
        ->assertRedirect('https://kancelarko.test/redirectModuleLogin?src=http%3A%2F%2Fcrm.test&route=test');
});

test('test strana se renderuje u Kancelarko UI layoutu sa naslovom Test', function () {
    Config::set('legacy.kancelarko_url', 'https://kancelarko.test');
    Config::set('legacy.module_label', 'CRM');
    session([
        'username' => 'neko@firma.rs',
        'firstname' => 'Pera',
        'lastname' => 'Perić',
    ]);
    $this->withoutVite();

    $html = view('pages.test')->render();

    expect($html)
        ->toContain('<k-layout>')
        ->toContain('<k-sidebar')
        ->toContain('<k-header')
        ->toContain('Adresar')
        ->toContain('kancelarko.test')
        ->toContain('contacts?module_from_url=CRM')
        ->toContain('Interna organizacija')
        ->toContain('listwp?module_from_url=CRM')
        ->toContain('Uputstva')
        ->toContain('invite.viber.com')
        ->toContain('Pera Perić')
        ->toContain('neko@firma.rs')
        ->toContain('Odjava')
        ->toContain('window.appLocale')
        ->not->toContain('Otpremnice')
        ->toContain('<k-page-section title="Test">')
        ->not->toContain('<k-data-table')
        ->not->toContain('m_aside_left')
        ->not->toContain('legacy/assets');
});
