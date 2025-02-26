<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('AboutProjectPage', []);
})->name('about_project');

Route::get('/catalog', [GroupController::class, 'index'])->name('catalog');


Route::get('/group/{id}', [GroupController::class, 'show'])->name('group.show');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
