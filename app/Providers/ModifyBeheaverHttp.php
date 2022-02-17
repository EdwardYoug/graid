<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModifyBeheaverHttp extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('\Psr\Http\Client\ClientInterface','App\Http\Services\TestService1');

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
