<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Laravel\Fortify\Fortify;

class InertiaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (! class_exists(Inertia::class)) {
            return;
        }

        $this->configureViews();
    }

    /**
     * Configure the views for the application.
     */
    protected function configureViews(): void
    {
        Fortify::loginView(function () {
            return inertia('auth/Login', [
                'canResetPassword' => Route::has('password.request'),
                'status' => session('status'),
            ]);
        });

        Fortify::requestPasswordResetLinkView(function () {
            return inertia('auth/ForgotPassword', [
                'status' => session('status'),
            ]);
        });

        Fortify::resetPasswordView(function (Request $request) {
            return inertia('auth/ResetPassword', [
                'email' => $request->input('email'),
                'token' => $request->route('token'),
            ]);
        });

        Fortify::registerView(function () {
            return inertia('auth/Register');
        });

        Fortify::verifyEmailView(function () {
            return inertia('auth/VerifyEmail', [
                'status' => session('status'),
            ]);
        });

        Fortify::twoFactorChallengeView(function () {
            return inertia('auth/TwoFactorChallenge');
        });

        Fortify::confirmPasswordView(function () {
            return inertia('auth/ConfirmPassword');
        });
    }
}
