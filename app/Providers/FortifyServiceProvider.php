<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureActions();
        $this->configureRateLimiting();
        $this->inertiaPrefix('auth/');
    }

    /**
     * Configure the actions for the application.
     */
    protected function configureActions(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }

    /**
     * Register the views for Fortify using conventional names under the given prefix.
     */
    protected function inertiaPrefix(string $prefix): void
    {
        if (! class_exists(Inertia::class)) {
            return;
        }

        Fortify::loginView(fn() => inertia($prefix.'Login', [
            'canRegister' => Features::enabled(Features::registration()),
            'canResetPassword' => Features::enabled(Features::resetPasswords()),
            'status' => session('status'),
        ]));
        Fortify::twoFactorChallengeView(fn() => inertia($prefix.'TwoFactorChallenge'));
        Fortify::registerView(fn() => inertia($prefix.'Register'));
        Fortify::requestPasswordResetLinkView(fn() => inertia($prefix.'ForgotPassword', [
            'status' => session('status'),
        ]));
        Fortify::resetPasswordView(fn(Request $request) => inertia($prefix.'ResetPassword', [
            'email' => $request->input('email'),
            'token' => $request->route('token'),
        ]));
        Fortify::verifyEmailView(fn() => inertia($prefix.'VerifyEmail', [
            'status' => session('status'),
        ]));
        Fortify::confirmPasswordView(fn() => inertia($prefix.'ConfirmPassword'));
    }
}
