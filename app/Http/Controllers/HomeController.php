<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'images')->inRandomOrder()->take(12)->get();
        $categories = Category::withCount('products')->inRandomOrder()->take(4)->get();

        return view('home', compact('products', 'categories'));
    }
}
