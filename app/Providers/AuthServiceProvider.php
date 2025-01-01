<?php

namespace App\Providers;

use App\Models\Review;
use App\Policies\ReviewPolicy;
// use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    // The $policies property maps the Review model to the ReviewPolicy
    protected $policies = [
        Review::class => ReviewPolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        // This method is for binding services into the container
        // You can use it to register custom services or classes
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register the policies
        $this->registerPolicies();
    }
}
