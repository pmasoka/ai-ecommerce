<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get(
    '/register',
    [RegisterController::class, 'register']
)->name('register');

Route::post(
    '/register',
    [RegisterController::class, 'store']
)->name('register.store');

/*
    User Login
*/

Route::get(
    '/login',
    [LoginController::class, 'login']
)->name('login');

Route::post(
    '/login',
    [LoginController::class, 'store']
)->name('login.store');

/*
|-------------------------
| User Logout
|-------------------------
*/

Route::post(
    '/logout',
    [LoginController::class, 'logout']
)->name('logout');

Route::get('/product/{slug}', [ProductController::class, 'detail']);
Route::get('/{slug}', [CategoryController::class, 'listing'])
    ->where('slug', '^[A-Za-z0-9-]+$');
Route::post(
    '/cart/add',
    [CartController::class, 'add']
)->name('cart.add');


