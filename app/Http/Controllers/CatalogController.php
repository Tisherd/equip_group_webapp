<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Services\GroupHierarchy;
use Inertia\Inertia;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request, GroupHierarchy $groupHierarchy): \Inertia\Response
    {
        $activeGroupId = (int)$request->input('activeGroupId', 0);
        //$gh = new GroupHierarchy();
        $groupHierarchy->setActiveGroup($activeGroupId);

        //dd($groupHierarchy->getHierarchy());

        //dd($gh->getHierarchy());
        return Inertia::render('CatalogPage', [
            'groups' => $groupHierarchy->getHierarchy(),
            'activeGroupId' => $activeGroupId,
        ]);
    }
}
