<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GroupController::class, 'index'])->name('home');
Route::get('/group/{id}', [GroupController::class, 'show'])->name('group.show');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
