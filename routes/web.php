<?php

use App\Http\Controllers\TestPageController;
use App\Legacy\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect(LoginController::home()))->name('home');

Route::middleware(['checkUserLoggedIn', 'checkAppModule:'.config('legacy.module')])->group(function () {
    Route::get('test', TestPageController::class)->name('test');
});
