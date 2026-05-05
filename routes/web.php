<?php

use App\Http\Controllers\HealthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)
    ->name('home');
Route::get('/up', HealthController::class)
    ->name('up');
