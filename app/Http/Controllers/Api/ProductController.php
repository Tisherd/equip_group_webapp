<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $groupIds = $request->query('group_ids', []);
        $perPage = $request->query('per_page', 10); // Количество товаров на страницу (по умолчанию 10)

        $query = Product::query();

        if (!empty($groupIds)) {
            $query->whereIn('id_group', $groupIds);
        }

        $products = $query->with('price')->paginate($perPage);

        return response()->json($products);
    }
}
