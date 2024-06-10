<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Tinify\Tinify;

class TinifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('tinify', function ($app) {
            $apiKey = config('tinify.api_key');
            if (!$apiKey) {
                throw new \Exception("Provide an API key with Tinify\setKey(...)");
            }
            \Tinify\setKey($apiKey);
            return new \Tinify\Tinify();
        });
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
