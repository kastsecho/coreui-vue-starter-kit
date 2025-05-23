<?php

use App\Http\Controllers\Settings\AppearanceController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Settings\ProfilePhotoController;
use App\Http\Controllers\Settings\TwoFactorAuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::redirect('/settings', '/settings/profile');

    Route::get('/settings/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::delete('/settings/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::delete('/settings/profile-photo', [ProfilePhotoController::class, 'destroy'])
        ->name('profile-photo.destroy');

    Route::get('/settings/password', [PasswordController::class, 'edit'])
        ->name('password.edit');

    Route::get('/settings/two-factor', [TwoFactorAuthController::class, 'edit'])
        ->name('two-factor.edit');
    Route::post( '/user/two-factor-authentication', [TwoFactorAuthController::class, 'store'])
        ->name('two-factor.enable');

    Route::get('/settings/appearance', [AppearanceController::class, 'edit'])
        ->name('appearance.edit');
});
