<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\API\AuthController;
use App\Http\Controllers\Admin\API\BlogAPIController;
use App\Http\Controllers\Admin\API\ProfileAPIController;
use App\Http\Controllers\Admin\API\ContactController;
use App\Http\Controllers\Admin\API\UserAPIController;

// Public API login
Route::post('/login', [AuthController::class, 'login']);

// Protected API routes (requires valid token via Sanctum)
/*Route::middleware('auth:sanctum')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Admin blog API routes
    Route::prefix('admin')->group(function () {
        Route::apiResource('blogs', BlogAPIController::class);
    });
});
*/
//
// Logout
Route::post('/logout', [AuthController::class, 'logout']);

// Admin blog API routes
Route::prefix('admin')->group(function () {
Route::apiResource('blogs', BlogAPIController::class);
});

// CMS contact API routes
Route::prefix('cms')->group(function (){
Route::apiResource('contact', ContactController::class);
});

// Admin profile API routes
Route::prefix('admin')->group(function(){
    Route::apiResource('profile', ProfileAPIController::class);
});

// Admin user API routes
Route::prefix('admin')->group(function(){
    Route::apiResource('user', UserAPIController::class);
});