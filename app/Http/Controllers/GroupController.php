<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Inertia\Inertia;

class GroupController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('CatalogPage', [
            'groups' => Group::withHierarchy(),
        ]);
    }
}
