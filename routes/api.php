<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MeController;
use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('/v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/verify-email', [AuthController::class, 'verifyEmail']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);

    Route::middleware('auth:api')->group(function () {
        Route::prefix('/me')->group(function () {
            Route::get('/', [MeController::class, 'index']);
            Route::put('/', [MeController::class, 'update']);
        });

        Route::prefix('todos')->group(function () {
            Route::get('/', [TodoController::class, 'index']);
            Route::get('/{todo}', [TodoController::class, 'show']);
            Route::post('/', [TodoController::class, 'store']);
            Route::put('/{todo}', [TodoController::class, 'update']);
            Route::delete('/{todo}', [TodoController::class, 'destroy']);
        });
    });
});
