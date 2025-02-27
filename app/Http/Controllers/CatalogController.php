<?php

namespace App\Http\Controllers;

use App\Services\GroupHierarchy;
use Inertia\Inertia;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request, GroupHierarchy $groupHierarchy): \Inertia\Response
    {
        $activeGroupId = (int)$request->input('activeGroupId', 0);
        $groupHierarchy->setActiveGroup($activeGroupId);

        return Inertia::render('CatalogPage', [
            'groups' => $groupHierarchy->getHierarchy(),
            'activeGroupId' => $activeGroupId,
        ]);
    }
}
