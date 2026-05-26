<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CategoryController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/{slug}', [CategoryController::class, 'listing'])
    ->where('slug', '^[A-Za-z0-9-]+$');