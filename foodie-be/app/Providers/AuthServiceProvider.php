<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        App\Models\User::class => App\Policies\UserPolicy::class,
        App\Models\Restaurant::class => App\Policies\RestaurantPolicy::class,
        App\Models\Order::class => App\Policies\OrderPolicy::class,
        App\Models\Meal::class => App\Policies\MealPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
