<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

// Public welcome page (root "/")
Route::get('/admin', function () {
    return view('auth.login');
})->name('login');

Route::middleware(['auth'])
    ->prefix('admin')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        // User Management
        Route::get('/user', [UserController::class, 'index'])
            ->name('admin.user.index');

        Route::get('/user/create', [UserController::class, 'create'])
            ->name('admin.user.create');

        Route::post('/user', [UserController::class, 'store'])
            ->name('admin.user.store');

        Route::get('/user/{id}/edit', [UserController::class, 'edit'])
            ->name('admin.user.edit');

        Route::put('/user/{id}', [UserController::class, 'update'])
            ->name('admin.user.update');

        Route::delete('/user/{id}', [UserController::class, 'destroy'])
            ->name('admin.user.destroy');

        // Export users
        Route::get('/user/export/{type}', [UserController::class, 'export'])
            ->name('admin.user.export');
    });
