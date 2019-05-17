<?php

namespace App\Providers;

use Hashids\Hashids;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class EncoderServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('encoder', function($app) {
            return new Hashids(env('HASHIDS_SALT'), env('HASHIDS_MIN_LENGTH'));
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

    public function provides()
    {
        return [Hashids::class];
    }
}
