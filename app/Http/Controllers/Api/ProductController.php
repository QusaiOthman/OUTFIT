<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Product::query();

        // Filter by category
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->gender == 'male') {

            $query->whereIn('gender', ['male', 'unisex']);
        } elseif ($request->gender == 'female') {

            $query->whereIn('gender', ['female', 'unisex']);
        } elseif ($request->gender == 'unisex') {

            $query->where('gender', 'unisex');
        }

        // Search
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // category + pagination
        $products = $query
            ->with('category')
            ->paginate(5);

        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);

        return response()->json($product);
    }
}
