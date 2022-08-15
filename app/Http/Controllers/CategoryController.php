<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }
    public function create(Request $request) {
        $request->validate([
            'type' => 'required|string|in:wiki,blog,forum',
            'name' => 'required|string|between:2,25',
            'icon' => 'required|url',
            'description' => 'required|string|between:25, 1024'
        ]);
        Category::create([
            'type' => $request->type,
            'name' => $request->name,
            'icon' => $request->icon,
            'description' => $request->description
        ]);
        return back()->with('success', 'Category created!');
    }
}
