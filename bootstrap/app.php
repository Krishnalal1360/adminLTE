<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    // Routing setup
    ->withRouting(
        web: [
            __DIR__ . '/../routes/web.php',
        ],
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        api: [
            __DIR__ . '/../routes/api.php',
        ],

        // 👇 Route + rate limiter config
        then: function () {
            RateLimiter::for('api', function (Request $request) {
                return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
            });
        },
    )
    // Middleware setup
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);

        $middleware->web(append: [
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    })
    // Exception handling
    ->withExceptions(function (Exceptions $exceptions): void {
        // Custom exception handling can go here
    })

    // 👇 Add cron jobs here
    ->withSchedule(function (Schedule $schedule) {
        // Custom notifications (from your custom table)
        $schedule->command('contacts:reminders-custom')->everyMinute();

        // (Optional) built-in notifications if you also want them
        // $schedule->command('contacts:reminders-builtin')->dailyAt('09:00');
    })

    ->create();
