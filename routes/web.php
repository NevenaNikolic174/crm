<?php

use App\Http\Controllers\TestPageController;
use App\Legacy\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect(LoginController::home()))->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

Route::middleware(['checkUserLoggedIn', 'checkAppModule:'.config('legacy.module')])->group(function () {
    Route::get('test', TestPageController::class)->name('test');
});

require __DIR__.'/settings.php';
