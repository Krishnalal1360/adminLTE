<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel Breeze and other authentication services
     * to redirect users after login/registration.
     */
    public const HOME = '/admin/dashboard';  // <-- add here

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
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Admin routes
            /*Route::middleware('web')
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));*/

            Route::middleware('auth')
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));
        });
    }
}
