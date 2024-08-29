<?php

use App\Http\Controllers\ProducerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use Illuminate\Support\Facades\Route;


Route::resource('products', ProductController::class);
Route::resource('producers', ProducerController::class);
Route::resource('orders', OrderController::class);
Route::resource('order_items', OrderItemController::class);

Route::get('producers_api', [ProducerController::class, 'search']);

Route::get('products_api', [ProductController::class, 'search']);
Route::get('order_items/create/products_api', [ProductController::class, 'search']);

Route::get('orders_api', [OrderController::class, 'search']);
Route::get('order_items_api', [OrderItemController::class, 'search']);
Route::get('order_items/orderSelection/{id}', [OrderItemController::class, 'orderSelection']);

//  Route::get('/producers_search', function(){
//      return view('producers_search');
//  })->name('producers_search');
//  Route::get('/products_search', function(){
//      return view('products_search');
//  })->name('products_search');
