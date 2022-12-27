<?php

namespace App\Providers;

use App\Services\CurrencyApiService;
use Illuminate\Support\ServiceProvider;

class CurrencyApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CurrencyApiService::class, function ($app) {
            return new CurrencyApiService();
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
