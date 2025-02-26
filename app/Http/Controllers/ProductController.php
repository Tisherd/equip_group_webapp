<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::with('price', 'group')->findOrFail($id);

        // Генерация хлебных крошек
        $breadcrumbs = [];
        $currentGroup = $product->group;

        while ($currentGroup) {
            array_unshift($breadcrumbs, [
                'id' => $currentGroup->id,
                'name' => $currentGroup->name,
            ]);
            $currentGroup = $currentGroup->parent;
        }

        return Inertia::render('ProductPage', [
            'product' => $product,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
