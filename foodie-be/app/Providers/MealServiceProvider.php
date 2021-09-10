<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MealServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\IMealService', 'App\Services\MealService');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
