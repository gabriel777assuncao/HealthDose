<?php

use App\Http\Controllers\Auth\{AuthController, ChangeCredentialsController};
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('reset-password', [ChangeCredentialsController::class, 'reset']);
    Route::post('request-reset-password', [ChangeCredentialsController::class, 'sendResetToken']);

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
        Route::post('refresh', [AuthController::class, 'refresh']);
    });
});
