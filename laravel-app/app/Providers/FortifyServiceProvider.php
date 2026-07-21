<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Http\Responses\LoginResponse as ProfileLoginResponse;
use App\Http\Responses\RegisterResponse as ProfileRegisterResponse;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // custom redirect on login
        $this->app->singleton(
            LoginResponse::class,
            ProfileLoginResponse::class
        );
        $this->app->singleton(
            RegisterResponse::class,
            ProfileRegisterResponse::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::loginView('auth/login');
        Fortify::registerView('auth/register');
        Fortify::twoFactorChallengeView('auth/two-factor-challenge');
        Fortify::confirmPasswordView('auth/confirm-password');

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);
        // Fortify::updateUserProfileInformationUsing(function ($request) {
        //     $user = $request->user();
            
        //     $user->update([
        //         'display_name' => $request->display_name,
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'birth_date' => $request->birth_date,
        //     ]);
            
        //     // Actualizar contact_data
        //     $user->contactData()->updateOrCreate(
        //         ['user_id' => $user->id],
        //         [
        //             'phone' => $request->phone,
        //             'address' => $request->address,
        //             'country_id' => $request->country_id,
        //         ]
        //     );
            
        //     return $user;
        // });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('passkeys', function (Request $request) {
            $credentialId = $request->input('credential.id');

            return Limit::perMinute(10)->by(
                ($credentialId ?: $request->session()->getId()).'|'.$request->ip()
            );
        });
    }
}
