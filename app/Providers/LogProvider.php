<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Log\Log;

class LogProvider extends ServiceProvider
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
        $this->app->bind(Log::class, function(){
        return new Log();
    }
}
