<?php

namespace App\Http\Controllers;

use App\Services\GroupHierarchy;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function show(Product $product, GroupHierarchy $groupHierarchy)
    {
        return Inertia::render('ProductShowPage', [
            'product' => $product,
            'groups' => $groupHierarchy->getActiveGroups($product->id_group),
        ]);
    }
}
