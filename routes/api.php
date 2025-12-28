<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\ProductController;

Route::get('/home', [HomeController::class, 'index']);
Route::get('/menu', [MenuController::class, 'index']);
Route::get('/products/{slug}', [ProductController::class, 'show']);

