<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use ShortPixel\ShortPixel;

class ShortPixelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        ShortPixel::setKey(config('shortpixel.api_key'));
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
