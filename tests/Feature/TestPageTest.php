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
    Config::set('legacy.module_label', 'CRM');
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

    $html = view('pages.test', [
        'tables' => [
            ['id' => 'otpremnice', 'title' => 'Otpremnice', 'columns' => ['despatchAdviceNumber' => 'Broj otpremnice', 'status' => 'Status'], 'rows' => [['despatchAdviceNumber' => 'OTP-1', 'status' => 'SENT']], 'order' => [[0, 'desc']]],
            ['id' => 'subjekti', 'title' => 'Subjekti', 'columns' => ['id' => 'id'], 'rows' => [], 'order' => [[0, 'desc']]],
        ],
    ])->render();

    expect($html)
        ->toContain('id="m_header"')
        ->toContain('id="m_aside_left"')
        ->toContain('Adresar')
        ->toContain('https://kancelarko.test/contacts?module_from_url=CRM')
        ->toContain('Interna organizacija')
        ->toContain('https://kancelarko.test/listwp?module_from_url=CRM')
        ->toContain('Kontakt - Feedback')
        ->toContain('legacy/assets/images/Viber-zajednica-reklama-FB-2.jpg')
        ->not->toContain('Test strana')
        ->toContain('m-portlet')
        ->toContain('SENT')
        ->toContain('Broj otpremnice')
        ->toContain('id="tabela-otpremnice"')
        ->toContain('.DataTable(')
        ->toContain('Pera')
        ->toContain('/redirectModule/')
        ->toContain('legacy/assets/vendors/base/vendors.bundle.css')
        ->not->toContain('@vite');
});
