<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\customer;
use App\Observers\CustomerModelObserver;

class CustomerModelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        customer::observe(CustomerModelObserver::class);
    }
}
