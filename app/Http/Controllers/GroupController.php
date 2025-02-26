<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Product;
use Inertia\Inertia;
use Illuminate\Http\Request;


class GroupController extends Controller
{
    public function index(Request $request)
    {
        $groupId = $request->query('group_id', null);

        $groupHierarchy = Group::withHierarchy();

        if ($groupId) {
            // Получаем все вложенные группы
            $groupIds = array_column($groupHierarchy, 'full_group_ids');
            $products = Product::with('price')->whereIn('id_group', $groupIds)->paginate(10);
        } else {
            $products = Product::with('price')->paginate(10);
        }

        return Inertia::render('HomePage', [
            'groups' => $groupHierarchy,
            'products' => $products,
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
