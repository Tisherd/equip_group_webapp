<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductRepository
{
    public function getProducts(array $groupIds, Request $request)
    {
        $query = Product::query()
            ->leftJoin('prices', 'products.id', '=', 'prices.id_product')
            ->select('products.*', 'prices.price')
            ->with('price');

        if (!empty($groupIds)) {
            $query->whereIn('id_group', $groupIds);
        }

        if ($request->has('sort_by')) {
            switch ($request->sort_by) {
                case 'price_asc':
                    $query->orderBy('price');
                    break;
                case 'price_desc':
                    $query->orderByDesc('price');
                    break;
                case 'name_asc':
                    $query->orderBy('name');
                    break;
                case 'name_desc':
                    $query->orderByDesc('name');
                    break;
            }
        }

        return $query->paginate($request->query('per_page', 6));
    }
}
