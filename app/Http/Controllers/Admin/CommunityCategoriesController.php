<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommunityTypes;
use Illuminate\Http\Request;

class CommunityCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = CommunityTypes::paginate(20);
        return view('admin.communities.categories.index', compact('types'));
    }
}
