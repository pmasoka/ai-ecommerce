<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CategoryController;

Route::get('/', [HomeController::class, 'index']);
Route::get('category/{slug}', [CategoryController::class, 'listing']);
