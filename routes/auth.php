<?php

use App\Http\Controllers\Auth\ConfirmedTwoFactorAuthController;
use App\Http\Controllers\Auth\RecoveryCodeController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;

Route::middleware('auth')->group(function () {
    Route::post('/user/confirmed-two-factor-authentication', [ConfirmedTwoFactorAuthController::class, 'store'])
            ->name('two-factor.confirm');
    Route::post('/user/two-factor-recovery-codes', [RecoveryCodeController::class, 'store'])
        ->name('two-factor.recovery-codes');
});

Route::get('/two-factor-challenge', [TwoFactorAuthenticatedSessionController::class, 'create'])
    ->middleware('ensure-two-factor-challenge-session')
    ->name('two-factor.login');
