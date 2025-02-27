<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\GroupHierarchy;

class ProductController extends Controller
{
    public function index(Request $request, GroupHierarchy $groupHierarchy)
    {
        $activeGroupId = (int)$request->input('active_group', 0);
        $groupIds = $groupHierarchy->getFullGroupIds($activeGroupId);

        $query = Product::query()
            ->leftJoin('prices', 'products.id', '=', 'prices.id_product') // Присоединяем цены
            ->select('products.*', 'prices.price') // Выбираем данные
            ->with('price'); // Загружаем связь

        if (!empty($groupIds)) {
            $query->whereIn('id_group', $groupIds);
        }
            // Обработка сортировки
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

        $products = $query->paginate($request->query('per_page', 6));

        return response()->json($products);
    }
}
