<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use App\Services\GroupHierarchy;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(Request $request, GroupHierarchy $groupHierarchy)
    {
        $activeGroupId = (int)$request->input('active_group', 0);
        $groupIds = $groupHierarchy->getFullGroupIds($activeGroupId);

        $products = $this->productRepository->getProducts($groupIds, $request);

        return response()->json($products);
    }
}
