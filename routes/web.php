<?php

use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\HealthUpController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)
    ->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)
        ->name('dashboard');
});

Route::get('/up', HealthUpController::class)
    ->name('health.up');

require base_path('routes/settings.php');
