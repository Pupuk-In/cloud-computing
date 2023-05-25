<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\PageHomeController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\SoilController;
use App\Http\Controllers\Api\PlantController;


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
    Route::post('reset-password', [AuthController::class, 'resetPassword'])->middleware('auth:sanctum');

    Route::prefix('stores')->group(function(){
        Route::get('{id}', [StoreController::class, 'index']);
        Route::get('', [StoreController::class, 'indexSelf']);
        Route::post('', [StoreController::class, 'store'])->middleware('auth:sanctum', 'storeprofile');
        Route::patch('', [StoreController::class, 'update'])->middleware('auth:sanctum', 'storeprofile');
        
        Route::get('items/actives', [ItemController::class, 'index']);
        Route::get('items/inactives', [ItemController::class, 'indexInactive'])->middleware('auth:sanctum');
        Route::get('items/getall', [ItemController::class, 'indexAllItems'])->middleware('auth:sanctum');
        Route::get('items/{id}', [ItemController::class, 'indexDetail']);

        Route::post('items', [ItemController::class, 'store'])->middleware('auth:sanctum', 'item-create');
        Route::patch('items/{id}', [ItemController::class, 'update'])->middleware('auth:sanctum', 'item-inactive');

        Route::delete('items/del/{id}', [ItemController::class, 'destroy'])->middleware('auth:sanctum', 'item-edit');
        Route::patch('items/restore/{id}', [ItemController::class, 'restoreSoftDelete'])->middleware('auth:sanctum', 'item-inactive');
        Route::delete('items/permdel/{id}', [ItemController::class, 'PermDelete'])->middleware('auth:sanctum', 'item-inactive');
    });

    Route::prefix('home')->group(function(){
        Route::get('types', [PageHomeController::class, 'indexTypeHome']);
        Route::get('plants', [PageHomeController::class, 'indexPlantHome']);
    });

    Route::prefix('profile')->middleware('auth:sanctum')->group(function(){
        Route::get('', [ProfileController::class, 'index'])->middleware('userprofile');
        Route::patch('', [ProfileController::class, 'update'])->middleware('userprofile');
    });


    Route::prefix('soils')->group(function(){
        Route::get('', [SoilController::class, 'index']);
        Route::post('', [SoilController::class, 'store']);
        Route::patch('{id}', [SoilController::class, 'update']);
        Route::delete('{id}', [SoilController::class, 'destroy']);
    });

    Route::prefix('plants')->group(function(){
        Route::get('', [PlantController::class, 'index']);
        Route::post('', [PlantController::class, 'store']);
        Route::patch('{id}', [PlantController::class, 'update']);
        Route::delete('{id}', [PlantController::class, 'destroy']);
    });

    Route::prefix('types')->group(function(){
        Route::get('', [TypeController::class, 'index']);
        Route::post('', [TypeController::class, 'store']);
        Route::patch('{id}', [TypeController::class, 'update']);
        Route::delete('{id}', [TypeController::class, 'destroy']);
    });

    Route::prefix('plantparts')->group(function(){
        Route::get('', [PlantPartController::class, 'index']);
        Route::post('', [PlantPartController::class, 'store']);
        Route::patch('{id}', [PlantPartController::class, 'update']);
        Route::delete('{id}', [PlantPartController::class, 'destroy']);
    });

    Route::get('index', [AuthController::class, 'index'])->middleware('auth:sanctum');
});