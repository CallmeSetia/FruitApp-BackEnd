<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $this->app->bind('App\Repository\AuthRepository\AuthRepositoryInterface',
            'App\Repository\AuthRepository\AuthRepository');
        $this->app->bind('App\Repository\UserRepository\UserRepositoryInterface',
            'App\Repository\UserRepository\UserRepository');


    }
}
