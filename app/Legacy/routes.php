<?php

use App\Legacy\Http\Controllers\LoginController;
use App\Legacy\Http\Controllers\RedirectModuleController;
use App\Legacy\Http\Controllers\SwitchModuleController;
use App\Legacy\Http\Controllers\UserRoleController;
use App\Legacy\Http\Middleware\RedirectIfAuthenticated;
use App\Legacy\Http\Middleware\UserCanChangeRole;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function (): void {
    Route::get('/login/{hash}', [LoginController::class, 'loginWithHash'])
        ->middleware(RedirectIfAuthenticated::class)
        ->name('legacy.login');

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.store');

    Route::get('/logout', [LoginController::class, 'logout'])->name('legacy.logout');

    Route::get('/redirectModule/{hash}', [RedirectModuleController::class, 'index'])->name('legacy.redirectModule');

    Route::get('/switchModul', [SwitchModuleController::class, 'switchModul'])
        ->middleware('checkUserLoggedIn')
        ->name('legacy.switchModul');

    Route::match(['get', 'post'], '/saveuserrole', [UserRoleController::class, 'changeFromCurrentModule'])
        ->name('legacy.saveuserrole');

    Route::match(['get', 'post'], '/external-modules/users/change-role', [UserRoleController::class, 'changeFromExternalModule'])
        ->middleware(UserCanChangeRole::class)
        ->name('legacy.changeRoleFromExternalModule');
});
