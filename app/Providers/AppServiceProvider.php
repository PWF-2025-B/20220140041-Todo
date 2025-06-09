<?php

namespace App\Providers;

use Dedoc\Scramble\Scramble;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set Sanctum to use PersonalAccessToken model
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        
        // Use Tailwind for pagination views
        Paginator::useTailwind();
        
        // Define admin gate
        Gate::define('admin', function ($user) {
            return $user->is_admin === true;
        });
        
        // Configure Scramble for API documentation (only if package is installed)
        if (class_exists(Scramble::class)) {
            Scramble::routes(function (Route $route) {
                return Str::startsWith($route->uri, 'api/');
            });
        }
    }
}