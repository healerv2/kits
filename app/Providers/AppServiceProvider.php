<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
use App\Models\Settings;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        view()->composer('layouts.index', function ($view) {
            $view->with('settings', Settings::first());
        });
        view()->composer('frontend.login', function ($view) {
            $view->with('settings', Settings::first());
        });
        view()->composer('frontend.forgot-password', function ($view) {
            $view->with('settings', Settings::first());
        });
        view()->composer('frontend.confirm-password', function ($view) {
            $view->with('settings', Settings::first());
        });
        view()->composer('frontend.two-factor-challenge', function ($view) {
            $view->with('settings', Settings::first());
        });
        view()->composer('frontend.reset-password', function ($view) {
            $view->with('settings', Settings::first());
        });
        view()->composer('frontend.register', function ($view) {
            $view->with('settings', Settings::first());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');

        Paginator::useBootstrap();
    }
}
