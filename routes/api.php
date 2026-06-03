<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CategoryController;




// products controller
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

// cart controller

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add', [CartController::class, 'add']);
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove']);
});

// auth controller
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// orders controller
Route::middleware('auth:sanctum')->group(function () {
    //checkout
    Route::post('/checkout', [OrderController::class, 'checkout']);
    // orders
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    // logout
    Route::post('/logout', [AuthController::class, 'logout']);
    // increase decrease quantity
    Route::post('/cart/increase/{id}', [CartController::class, 'increase']);
    Route::post('/cart/decrease/{id}', [CartController::class, 'decrease']);
});

// categories controller
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
