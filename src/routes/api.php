<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\UserProfiles;

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

Route::namespace('Api')->group(function(){
    
    Route::prefix('auth')->group(function(){
        Route::post('login', [AuthController::class, 'login']);
        Route::post('signup', [AuthController::class, 'signup']);
        // Route::get('commands', [AuthController::class, 'commands']);
        Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    });

    Route::prefix('user')->middleware('auth:sanctum')->group(function(){
        // Route::post('profiles', [UserController::class, 'store']);
        Route::patch('profiles', [UserController::class, 'update'])->middleware('userprofile');
    });
});