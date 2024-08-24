<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProducerSearchController;


Route::get('api/producers_api', [ProducerSearchController::class, 'index']);



