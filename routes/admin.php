<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CMS\CMSController;

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

        // Edit profile
        /*Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])
            ->name('admin.profile.edit');*/

        Route::put('/profile/{id}/update', [ProfileController::class, 'update'])
            ->name('admin.profile.update');

        // -------------------
        // User Routes
        // -------------------
        Route::get('/user', [UserController::class, 'index'])
            ->name('admin.user.index');

        /*Route::get('/user/create', [UserController::class, 'create'])
            ->name('admin.user.create');

        Route::post('/user', [UserController::class, 'store'])
            ->name('admin.user.store');*/

        Route::get('/user/{id}/edit', [UserController::class, 'edit'])
            ->name('admin.user.edit');

        Route::put('/user/{id}', [UserController::class, 'update'])
            ->name('admin.user.update');

        Route::delete('/user/{id}', [UserController::class, 'destroy'])
            ->name('admin.user.destroy');

        Route::get('/user/export/{type}', [UserController::class, 'export'])
            ->name('admin.user.export');

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
        // -------------------
        // CMS Routes
        // -------------------
        Route::get('/home', [CMSController::class, 'home'])
            ->name('cms.home');

        Route::get('/blogs', [CMSController::class, 'index'])
            ->name('cms.index');

        Route::get('/blog/{id}', [CMSController::class, 'show'])
            ->name('cms.show');

        Route::get('/contact', [CMSController::class, 'create'])
            ->name('cms.contact.create');

        Route::post('/contact-store', [CMSController::class, 'contactStore'])
            ->name('cms.contact.store');
