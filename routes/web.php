<?php

use App\Http\Controllers\TestPageController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

Route::middleware(['checkUserLoggedIn', 'checkAppModule:'.config('legacy.module')])->group(function () {
    Route::get('test', TestPageController::class)->name('test');
});

require __DIR__.'/settings.php';
