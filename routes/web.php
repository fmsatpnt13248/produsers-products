<?php

use App\Http\Controllers\ProducerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthController::class, 'login']);
Route::get('/', [AuthController::class, 'index']);

Route::resource('products', ProductController::class);
Route::resource('producers', ProducerController::class);
Route::resource('orders', OrderController::class);
Route::resource('order_items', OrderItemController::class);

Route::get('users_api', [AuthController::class, 'fetch']);

Route::get('producers_api', [ProducerController::class, 'search']);
Route::get('products_api', [ProductController::class, 'search']);

Route::get('orders_api', [OrderController::class, 'search']);
Route::get('order_items_api', [OrderItemController::class, 'search']);
