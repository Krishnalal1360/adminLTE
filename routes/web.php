<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Admin routes
require __DIR__.'/admin.php';

// Auth routes
require __DIR__.'/auth.php';

// Auth routes
require __DIR__.'/cms.php';

/**
 * Explicitly handle /admin as login OR redirect to dashboard
 */
Route::get('/admin', function () {
    if (Auth::check()) {
        return redirect()->route('admin.dashboard'); // logged-in users
    }
    return view('auth.login'); // guests
})->name('login');

/**
 * Fallback for unmatched /admin/* routes
 */
Route::fallback(function () {
    $currentUrl = rtrim(request()->path(), '/'); // remove trailing slash

    if (str_starts_with($currentUrl, 'admin/')) {
        return Auth::check()
            ? redirect()->route('admin.dashboard') // logged-in
            : redirect()->route('login');          // guest
    }

    // Let Laravel handle all other URLs
    abort(404);
});
