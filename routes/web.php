<?php

use App\Http\Controllers\ProducerController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::resource('products', ProductController::class);
Route::resource('producers', ProducerController::class);

Route::get('producers_api', [ProducerController::class, 'search']);
Route::get('products_api', [ProductController::class, 'search']);

//  Route::get('/producers_search', function(){
//      return view('producers_search');
//  })->name('producers_search');
//  Route::get('/products_search', function(){
//      return view('products_search');
//  })->name('products_search');
