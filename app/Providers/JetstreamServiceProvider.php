<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use Laravel\Fortify\Fortify;
use App\Models\Angkatan;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);
        //login
        Fortify::loginView(function () {
        return view('frontend.login')->withTitle('Login');
        });
        //register
        Fortify::registerView(function () {
        $angkatan = Angkatan::all();
        $title = 'Register';
        return view('frontend.register',compact('angkatan','title'));
        });
        //email verfikasi
        Fortify::verifyEmailView(function () {
            return view('frontend.verify-email')->withTitle('Email verification');
        });
        //forgot password 
        Fortify::requestPasswordResetLinkView(function () {
            return view('frontend.forgot-password')->withTitle('Forgot Password');
        });
        //reset password
        Fortify::resetPasswordView(function ($request) {
            return view('frontend.reset-password', ['request' => $request])->withTitle('Reset Password');
        });
        //confrim password
        Fortify::confirmPasswordView(function () {
            return view('frontend.confirm-password')->withTitle('Confirm Password');
        });
        //challenge two-factor
        Fortify::twoFactorChallengeView(function () {
            return view('frontend.two-factor-challenge')->withTitle('Challenge Code 2FA');
        });
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
