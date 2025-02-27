<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('AboutProjectPage', []);
})->name('about_project');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
