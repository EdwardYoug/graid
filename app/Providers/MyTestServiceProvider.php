<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MyTestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Http\Interfaces\TestServiceInterface', 'App\Http\Services\TestService');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
