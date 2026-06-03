<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    //
    //  all categories
    public function index()
    {
        $categories = Category::withCount('products')->get();

        return response()->json($categories);
    }

    // show category with products
    public function show($id)
    {
        $category = Category::with('products')->findOrFail($id);

        return response()->json($category);
    }
}
