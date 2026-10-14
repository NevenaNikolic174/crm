<?php

namespace App\Legacy;

use App\Legacy\Auth\LegacyAuth;
use App\Legacy\Encrypt\ModuleEncrypter;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

final class LegacyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ModuleEncrypter::class);
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        if (class_exists(Inertia::class)) {
            Inertia::share('legacy', static fn (): array => LegacyAuth::sharedData());
        }
    }
}
