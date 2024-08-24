<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProducerController;

Route::resource('products', ProductController::class);
Route::resource('producers', ProducerController::class);

Route::get('/producers_search', function(){
    return view('producers_search');
})->name('producers_search');
Route::get('/products_search', function(){
    return view('products_search');
})->name('products_search');
