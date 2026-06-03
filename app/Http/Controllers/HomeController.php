<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'images')->latest()->take(8)->get();
        $categories = Category::withCount('products')->take(4)->get();

        return view('home', compact('products', 'categories'));
    }
}
