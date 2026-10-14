<?php

use App\Legacy\LegacyServiceProvider;
use App\Providers\AppServiceProvider;
use App\Providers\FortifyServiceProvider;

return [
    AppServiceProvider::class,
    FortifyServiceProvider::class,
    LegacyServiceProvider::class,
];
