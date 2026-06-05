<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;



use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    public function index(Request $request)
    {
        $query = \App\Models\Product::with('category', 'images');

        //  Search
        if ($request->search) {

            $query->where('name', 'like', '%' . $request->search . '%');
        }

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

        switch ($request->sort) {
            case 'price_low':
                $query->orderBy('price');
                break;

            case 'price_high':
                $query->orderByDesc('price');
                break;

            case 'oldest':
                $query->oldest();
                break;

            default:
                $query->latest();
        }

        $query->when($request->min_price, function ($q) use ($request) {
            $q->where('price', '>=', $request->min_price);
        });

        $query->when($request->max_price, function ($q) use ($request) {
            $q->where('price', '<=', $request->max_price);
        });
        $products = $query->paginate(12)
            ->appends(request()->query());

        $categories = \App\Models\Category::all();

        //  Get user's cart if authenticated
        $cart = auth()->check() ? auth()->user()->cart : null;

        return view('products.index', compact('products', 'categories', 'cart'));
    }

    public function show($id)
    {
        $product = Product::with(['category', 'sizes', 'images'])
            ->findOrFail($id);

        $cart = auth()->check()
            ? auth()->user()->cart()->with('items')->first()
            : null;

        $item = null;
        $qty = 0;

        if ($cart) {

            $item = $cart->items->where('product_id', $product->id)->first();

            $qty = $item ? $item->quantity : 0;
        }

        $relatedProducts = Product::with('category', 'images')
            ->where(function ($query) use ($product) {
                if ($product->gender == 'unisex') return;
                $query->where('gender', $product->gender)->orWhere('gender', 'unisex');
            })
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('products.show', compact(
            'product',
            'cart',
            'item',
            'qty',
            'relatedProducts'
        ));
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {

            $product->sizes()->delete();

            $product->images()->delete();

            $product->delete();
        }

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully');
    }
    public function edit($id)
    {
        $product = Product::with(['images', 'sizes'])->findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }
}
