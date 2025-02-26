<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Product;
use Inertia\Inertia;
use Illuminate\Http\Request;


class GroupController extends Controller
{
    public function index()
    {
        $groupHierarchy = Group::withHierarchy();


        return Inertia::render('CatalogPage', [
            'groups' => $groupHierarchy,
        ]);
    }

    public function show($id, Request $request)
    {
        $group = Group::findOrFail($id);
        $subgroups = Group::where('id_parent', $id)->get();

        // Собираем товары текущей группы и её подгрупп
        $groupIds = Group::where('id_parent', $id)->pluck('id')->toArray();
        $groupIds[] = $id;

        $products = Product::whereIn('id_group', $groupIds)
            ->with('price')
            ->orderBy($request->get('sort_by', 'name'), $request->get('order', 'asc'))
            ->paginate(10);

        return Inertia::render('GroupPage', [
            'group' => $group,
            'subgroups' => $subgroups,
            'products' => $products,
        ]);
    }
}
