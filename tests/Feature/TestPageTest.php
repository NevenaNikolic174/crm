<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

test('test strana traži legacy prijavu', function () {
    Config::set('legacy.kancelarko_url', 'https://kancelarko.test');
    Config::set('legacy.module_url', 'http://crm.test');

    $this->get(route('test'))
        ->assertRedirect('https://kancelarko.test/redirectModuleLogin?src=http%3A%2F%2Fcrm.test&route=test');
});

test('test strana se renderuje u Kancelarko layoutu', function () {
    Config::set('legacy.kancelarko_url', 'https://kancelarko.test');
    Config::set('database.connections.office_master', ['driver' => 'sqlite', 'database' => ':memory:', 'prefix' => '']);
    Schema::connection('office_master')->create('parquet_storage_usage', function (Blueprint $table) {
        $table->increments('ID');
        $table->integer('licencaId');
        $table->bigInteger('storage_usage');
    });
    session([
        'loggedId' => 1,
        'username' => 'neko@firma.rs',
        'firstname' => 'Pera',
        'lastname' => 'Perić',
        'userRole' => 'SADMIN',
        'realRole' => 'SADMIN',
        'module' => 'CRM',
        'licenseid' => 1,
        'licenseModule' => ['MODULE_CRM' => 1],
        'devModules' => true,
    ]);

    $html = view('pages.test')->render();

    expect($html)
        ->toContain('id="m_header"')
        ->toContain('id="m_aside_left"')
        ->toContain('Test strana')
        ->toContain('Pera')
        ->toContain('/redirectModule/')
        ->toContain('legacy/assets/vendors/base/vendors.bundle.css')
        ->not->toContain('@vite');
});
