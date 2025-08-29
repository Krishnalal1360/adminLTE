<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

// Fallback for admin routes
Route::fallback(function () {
    if (Auth::check()) {
        // Logged-in user: any unmatched /admin/* goes to dashboard
        return redirect()->route('admin.dashboard');
    }
    // Logged-out user: redirect to login page (/admin)
    return redirect()->route('login');
});

// Load admin routes
require __DIR__.'/admin.php';

// Auth routes (login, register, etc.)
require __DIR__.'/auth.php';
