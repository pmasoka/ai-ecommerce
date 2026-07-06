<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/product/{slug}', [ProductController::class, 'detail']);
Route::get('/{slug}', [CategoryController::class, 'listing'])
    ->where('slug', '^[A-Za-z0-9-]+$');
    Route::post(
    '/cart/add',
    [CartController::class, 'add']
)->name('cart.add');
