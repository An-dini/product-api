<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('category-products', [CategoryController::class, 'getCategory']);
    Route::get('category-products/{id}', [CategoryController::class, 'getCategoryByID']);
    Route::delete('category-products/{id}', [CategoryController::class, 'deleteCategory']);
    Route::patch('category-products/{id}', [CategoryController::class, 'updateCategory']);
    Route::post('category-products', [CategoryController::class, 'addCategory']);

    Route::get('product', [ProductController::class, 'getProduct']);
    Route::get('product/{id}', [ProductController::class, 'getProductByID']);
    Route::delete('product/{id}', [ProductController::class, 'deleteProduct']);
    Route::patch('product/{id}', [ProductController::class, 'updateProduct']);
    Route::post('product', [ProductController::class, 'addProduct']);
});

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);