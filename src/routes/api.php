<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\UserProfiles;
use Illuminate\Support\Facades\Auth;

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
    
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);
    // Route::get('commands', [AuthController::class, 'commands']);
    Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    Route::prefix('users')->middleware('auth:sanctum')->group(function(){
        Route::get('', [UserController::class, 'index'])->middleware('userprofile');
        Route::patch('', [UserController::class, 'update'])->middleware('userprofile');
    });

    Route::prefix('stores')->group(function(){
        Route::get('{id}', [StoreController::class, 'index']);
        Route::get('', [StoreController::class, 'indexself'])->middleware('auth:sanctum');
        Route::post('', [StoreController::class, 'store'])->middleware('auth:sanctum')->middleware('storeprofile');
        Route::patch('', [StoreController::class, 'update'])->middleware('auth:sanctum')->middleware('storeprofile');

        Route::get('items/{id}', [ItemController::class, 'index']);
        Route::post('items', [ItemController::class, 'store'])->middleware('item-create');
        Route::patch('items/{id}', [ItemController::class, 'update'])->middleware('item-edit');
    });

    Route::get('index', [AuthController::class, 'index'])->middleware('auth:sanctum');
});