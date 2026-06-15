<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\ProductController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/product/{slug}', [ProductController::class, 'detail']);
Route::get('/{slug}', [CategoryController::class, 'listing'])
    ->where('slug', '^[A-Za-z0-9-]+$');