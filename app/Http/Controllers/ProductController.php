<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        return Inertia::render('ProductPage', [
            'product' => $product,
        ]);
    }
}
