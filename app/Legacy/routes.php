<?php

use App\Legacy\Http\Controllers\LoginController;
use App\Legacy\Http\Controllers\RedirectModuleController;
use App\Legacy\Http\Controllers\SwitchModuleController;
use App\Legacy\Http\Controllers\UserRoleController;
use App\Legacy\Http\Middleware\RedirectIfAuthenticated;
use App\Legacy\Http\Middleware\UserCanChangeRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function (): void {
    Route::get('/login/{hash}', [LoginController::class, 'loginWithHash'])
        ->middleware(RedirectIfAuthenticated::class)
        ->name('legacy.login');

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.store');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/logout', [LoginController::class, 'logout'])->name('legacy.logout');

    Route::get('/redirectModule/{hash}', [RedirectModuleController::class, 'index'])->name('redirectModule');

    Route::get('/switchModul', [SwitchModuleController::class, 'switchModul'])
        ->middleware('checkUserLoggedIn')
        ->name('switchModul');

    Route::match(['get', 'post'], '/saveuserrole', [UserRoleController::class, 'changeFromCurrentModule'])
        ->name('saveuserrole');

    Route::match(['get', 'post'], '/external-modules/users/change-role', [UserRoleController::class, 'changeFromExternalModule'])
        ->middleware(UserCanChangeRole::class)
        ->name('changeRoleFromExternalModule');

    $toKancelarko = fn (string $path) => fn (Request $request): RedirectResponse => redirect(
        rtrim((string) config('legacy.kancelarko_url'), '/').$path.($request->getQueryString() ? '?'.$request->getQueryString() : '')
    );

    foreach ([
        'modulesInfo' => '/modules/info',
        'newcase' => '/newcase',
        'newtask' => '/newtask',
        'newwtime' => '/newwtime',
        'notifications' => '/notifications',
        'navigatesettings' => '/navigatesettings',
        'googlelogout' => '/googlelogout',
    ] as $name => $path) {
        Route::get($path, $toKancelarko($path))->name($name);
    }

    Route::get('/despatchAdvice/settings/counter', fn (): RedirectResponse => redirect(
        rtrim((string) config('legacy.otpremnice_url'), '/').'/despatchAdvice/settings/counter'
    ))->name('despatchCounterSettings');
});
