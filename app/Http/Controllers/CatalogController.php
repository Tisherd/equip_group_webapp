<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Inertia\Inertia;

class CatalogController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('CatalogPage', [
            'groups' => Group::withHierarchy(),
        ]);
    }
}
