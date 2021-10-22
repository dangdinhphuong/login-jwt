<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;

// Auth
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
    Route::post('/change-pass', [AuthController::class, 'changePassWord']);    
});

// Permission xu85xugk_-iYzgH
Route::group([
    'middleware' => 'api',
    'prefix' => 'role'
], function ($router) {
    Route::get('show', [RoleController::class, 'index']);  
    Route::get('create', [RoleController::class, 'create']);  
    Route::post('store', [RoleController::class, 'store']); 
    Route::get('edit', [RoleController::class, 'edit']); 
    Route::post('update', [RoleController::class, 'update']); 
    Route::get('delete', [RoleController::class, 'destroy']);
    Route::post('/register', [UserController::class, 'register']);
});

// users
Route::group([
    'middleware' => 'api',
    'prefix' => 'user'
], function ($router) {
    Route::get('/create', [UserController::class, 'create'])->middleware('can:Category-list');
    Route::post('/register', [UserController::class, 'register']);
    Route::get('edit', [UserController::class, 'edit']); 
    Route::post('update', [UserController::class, 'update']); 
});
