<?php

return [

    'module' => env('LEGACY_MODULE', 'MODULE_CRM'),

    'module_label' => env('LEGACY_MODULE_LABEL', 'CRM'),

    'kancelarko_url' => env('KANCELARKO_URL'),

    'module_url' => env('CRM_URL', env('APP_URL')),

    'key_module_encrypt' => env('KEY_MODULE_ENCRYPT'),
    'cipher' => 'AES-256-CBC',

    'hash_ttl' => 300,

    'login_form' => (bool) env('LEGACY_LOGIN_FORM', true),

    'home' => '/test',

    'procedure_url' => env('PROCEDURE_URL'),
    'dogadjaji_url' => env('DOGADJAJI_URL'),
    'elms_url' => env('ELMS_URL'),
    'ticketing_url' => env('TICKETING_URL'),
    'troskovnik_url' => env('TROSKOVNIK_URL'),
    'obrasci_url' => env('OBRASCI_URL'),
    'otpremnice_url' => env('OTPREMNICE_URL'),
    'kamate_login_srv' => env('KAMATE_LOGIN_SRV', 'https://kamate.kalkulatori.rs/klogin'),
    'zarade_login_srv' => env('ZARADE_LOGIN_SRV', 'https://zarade.kalkulatori.rs/klogin'),
    'sudske_takse_srv' => env('SUDSKE_TAKSE_SRV', 'https://sudsketakse.kalkulatori.rs/klogin'),

    'app_server_production' => env('APP_DEFAULT_MODUL', 'Delovodnik'),

    'login' => [
        'max_attempts' => 10,
        'decay_minutes' => 1440,
        'remember_minutes' => 1051200,
    ],

    'guard' => 'legacy',

    'license_connection' => env('LEGACY_LICENSE_CONNECTION', 'license'),

    'office_master_connection' => 'office_master',

    'default_module' => env('APP_DEFAULT_MODUL', 'Principal'),

    'role_change_modules' => [
        'MODULE_KANCELARKO' => 'kancelarko_url',
    ],

    'db_servers' => [
        'localhost' => 'license_srv1',
        '127.0.0.1' => 'license_srv1',
        'mysql' => 'license_srv1',
        '162.55.243.221' => 'license_srv2',
        '167.235.112.156' => 'license_srv3',
        '94.130.19.106' => 'license_srv4',
        '159.69.63.240' => 'license_srv5',
        '176.9.188.34' => 'license_srv6',
        '195.201.170.208' => 'license_srv7',
    ],

    'auto_create_db_account' => (bool) env('LEGACY_AUTO_CREATE_DB_ACCOUNT', true),

    'allowed_app_servers' => [
        '116.202.84.213',
        '78.46.86.82',
        '195.201.206.206',
        '157.90.217.50',
        '168.119.214.190',
        '195.201.56.234',
        '91.98.176.84',
        '49.12.146.177',
    ],

    'orgapi' => [
        'enabled' => (bool) env('LEGACY_ORGAPI_ENABLED', true),
        'server' => env('ORGAPISERVER', 'http://orgapi.paragraf.rs/'),
        'token' => env('ORGAPISERVERTOKEN', ''),
        'timeout' => 30,
        'crm_package_name' => env('LEGACY_CRM_PACKAGE_NAME', 'CRM'),
    ],

    'dev_modules' => array_values(array_filter(array_map(
        'trim',
        explode(',', (string) env('LEGACY_DEV_MODULES', ''))
    ))),

    'support_phones' => '063/379-714, 063/379-904, 063/379-946',

];
