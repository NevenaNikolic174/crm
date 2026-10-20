<?php

namespace App\Legacy;

use App\Legacy\Encrypt\ModuleEncrypter;
use Illuminate\Support\ServiceProvider;

final class LegacyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ModuleEncrypter::class);
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }
}
