<?php

use App\Http\Controllers\Settings\AppearanceController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Settings\ProfilePhotoController;
use App\Http\Controllers\Settings\TwoFactorAuthenticationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', '/settings/profile');

    Route::get('settings/profile', [ProfileController::class, 'edit'])
        ->name('user-profile-information.edit');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::delete('settings/profile', [ProfileController::class, 'destroy'])
        ->name('current-user.destroy');

    Route::delete('settings/profile-photo', [ProfilePhotoController::class, 'destroy'])
        ->name('current-user-photo.destroy');

    Route::get('settings/password', [PasswordController::class, 'edit'])
        ->name('user-password.edit');

    Route::get('settings/appearance', [AppearanceController::class, 'edit'])
        ->name('appearance.edit');

    Route::get('settings/two-factor', [TwoFactorAuthenticationController::class, 'edit'])
        ->name('two-factor.edit');
});
