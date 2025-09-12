<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CMS\CMSController;

        // -------------------
        // CMS Routes
        // -------------------
        Route::get('/home', [CMSController::class, 'home'])
            ->name('cms.home');

        Route::get('/blogs', [CMSController::class, 'blogs'])
            ->name('cms.index');

        Route::get('/blog/{id}', [CMSController::class, 'blogDetail'])
            ->name('cms.show');

        Route::get('/contact', [CMSController::class, 'contactCreate'])
            ->name('cms.contact.create');

        Route::post('/contact-store', [CMSController::class, 'contactStore'])
            ->name('cms.contact.store');