<?php

use App\Http\Middleware\CheckRole;
use App\Legacy\Http\Middleware\AuthMiddleware as LegacyAuthMiddleware;
use App\Legacy\Http\Middleware\CheckDataSession;
use App\Legacy\Http\Middleware\CheckModule;
use App\Legacy\Http\Middleware\CheckUserLoggedIn;
use App\Legacy\Http\Middleware\CheckUserRole;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            CheckDataSession::class,
            AddLinkHeadersForPreloadedAssets::class,
        ]);

        $middleware->alias([
            'checkUserLoggedIn' => CheckUserLoggedIn::class,
            'checkAppModule' => CheckModule::class,
            'checkRole' => CheckRole::class,
            'checkuserrole' => CheckUserRole::class,
            'authmiddleware' => LegacyAuthMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
