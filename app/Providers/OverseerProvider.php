<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Overseer;

class OverseerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        this->app->bind(Overseer::class, function(){
            return new Overseer();
    }
}
