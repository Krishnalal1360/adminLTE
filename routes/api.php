<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Admin\API\AuthController;
//use App\Http\Controllers\Admin\API\BlogAPIController;
use App\Http\Controllers\API\CMS\CMSController;
use App\Http\Controllers\API\CMS\BlogController;
use App\Http\Controllers\API\CMS\ContactController;

// Public API login
//Route::post('/login', [AuthController::class, 'login']);

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
//Route::post('/logout', [AuthController::class, 'logout']);

// Admin blog API routes
/*Route::prefix('admin')->group(function () {
Route::apiResource('blogs', BlogAPIController::class);
});*/

// CMS API routes
Route::prefix('cms')->group(function(){
    Route::apiResource('blog', BlogController::class);
    Route::apiResource('contact', ContactController::class);
});