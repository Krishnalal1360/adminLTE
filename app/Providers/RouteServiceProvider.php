<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/admin/dashboard';

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->routes(function () {
            // Web routes (session + CSRF)
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // API routes (stateless)
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Admin routes (web + auth) — can also be included inside web.php if you want
            // Comment this out if admin routes are already loaded in web.php
            Route::middleware(['web', 'auth'])
                 ->prefix('admin')
                 ->group(base_path('routes/admin.php'));
        });
    }
}
