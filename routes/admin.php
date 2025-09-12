<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ProfileController;

// Protected admin routes
Route::middleware(['auth'])
    ->prefix('admin')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        // -------------------
        // Profile Routes
        // -------------------
        Route::get('/profile', [ProfileController::class, 'index'])
            ->name('admin.profile.index');

        Route::put('/profile/{id}/update', [ProfileController::class, 'update'])
            ->name('admin.profile.update');

        // -------------------
        // Contact Routes
        // -------------------
        Route::get('/contact', [ContactController::class, 'index'])
            ->name('admin.contact.index');

        Route::get('/contact/{id}', [ContactController::class, 'show'])
            ->name('admin.contact.show');

        Route::get('/contact/{id}/edit', [ContactController::class, 'edit'])
            ->name('admin.contact.edit');

        Route::put('/contact/{id}', [ContactController::class, 'update'])
            ->name('admin.contact.update');

        Route::delete('/contact/{id}', [ContactController::class, 'destroy'])
            ->name('admin.contact.destroy');

        Route::get('/contact/export/{type}', [ContactController::class, 'export'])
            ->name('admin.contact.export');

        // -------------------
        // Blog Routes
        // -------------------
        Route::get('/blog', [BlogController::class, 'index'])
            ->name('admin.blog.index');

        Route::get('/blog/create', [BlogController::class, 'create'])
            ->name('admin.blog.create');

        Route::post('/blog', [BlogController::class, 'store'])
            ->name('admin.blog.store');

        Route::get('/blog/{id}/edit', [BlogController::class, 'edit'])
            ->name('admin.blog.edit');

        Route::put('/blog/{id}', [BlogController::class, 'update'])
            ->name('admin.blog.update');

        Route::delete('/blog/{id}', [BlogController::class, 'destroy'])
            ->name('admin.blog.destroy');

        Route::get('/blog/export/{type}', [BlogController::class, 'export'])
            ->name('admin.blog.export');
    });
