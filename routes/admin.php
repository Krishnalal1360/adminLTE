<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CMS\CMSController;

// Protected admin routes
Route::middleware(['auth'])
    ->prefix('admin')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        // -------------------
        // User Routes
        // -------------------
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
            ->name('admin.cms.home');

        Route::get('/blogs', [CMSController::class, 'index'])
            ->name('admin.cms.index');

        Route::get('/blog/{id}', [CMSController::class, 'show'])
            ->name('admin.cms.show');

        Route::get('/cms/blog/create', [CMSController::class, 'create'])
            ->name('admin.cms.create');

        Route::post('/cms/blog/store', [CMSController::class, 'store'])
            ->name('admin.cms.store');

        /*Route::get('/cms/blog/{id}/edit', [CMSController::class, 'edit'])
            ->name('admin.cms.edit');

        Route::put('/cms/blog/{id}/update', [CMSController::class, 'update'])
            ->name('admin.cms.update');

        Route::delete('/cms/{id}/destroy', [CMSController::class, 'destroy'])
            ->name('admin.cms.destroy');

        Route::get('/cms/export/{type}', [CMSController::class, 'export'])
            ->name('admin.cms.export');*/