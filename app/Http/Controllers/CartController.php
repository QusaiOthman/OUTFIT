<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    //
    public function add(Request $request, $productId)
    {
        $request->validate([
            'size' => 'required|string|max:20'
        ]);

        $user = auth()->user();

        $cart = $user->cart;

        // Create cart if not exists
        if (!$cart) {

            $cart = \App\Models\Cart::create([

                'user_id' => $user->id

            ]);
        }

        // Find product
        $product = Product::with('images')->findOrFail($productId);
        // Product out of stock
        if ($product->stock <= 0) {

            return back()->with(

                'error',

                "{$product->name} is out of stock."

            );
        }

        // Current item with same size
        $item = $cart->items()
            ->where('product_id', $productId)
            ->where('size', $request->size)
            ->first();

        // Total quantity of same product in cart
        $totalQuantity = $cart->items()
            ->where('product_id', $productId)
            ->sum('quantity');

        // Prevent exceeding stock
        if ($totalQuantity >= $product->stock) {

            return back()->with(

                'error',

                "Only {$product->stock} left for {$product->name}"

            );
        }

        // Same size already exists
        if ($item) {

            $item->increment('quantity');
        } else {

            // New size / first add
            $cart->items()->create([

                'product_id' => $productId,

                'quantity' => 1,

                'size' => $request->size

            ]);
        }

        return back();
    }
    public function index()
    {
        $user = auth()->user();

        $cart = $user->cart()
            ->with('items.product.images')
            ->first();

        $total = 0;

        if ($cart) {

            $total = $cart->items->sum(function ($item) {

                return ($item->product->price ?? 0) * $item->quantity;
            });
        }

        // Settings
        $settings = Setting::getSettings();

        $freeShippingGoal = $settings->free_shipping_minimum;

        $shippingPrice = $settings->shipping_price;

        $remaining = max($freeShippingGoal - $total, 0);

        $progress = $freeShippingGoal > 0
            ? min(($total / $freeShippingGoal) * 100, 100)
            : 0;

        $finalTotal = $total + (
            $total >= $freeShippingGoal
            ? 0
            : $shippingPrice
        );

        // Wishlist IDs
        $wishlistProductIds = auth()->user()
            ->wishlistItems()
            ->pluck('product_id')
            ->toArray();

        // Recommended Products
        $recommendedProducts = Product::with('category', 'images')
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('cart', compact(

            'cart',
            'total',
            'recommendedProducts',
            'freeShippingGoal',
            'shippingPrice',
            'remaining',
            'progress',
            'finalTotal',
            'wishlistProductIds'

        ));
    }
    public function remove($itemId)
    {
        $user = auth()->user();

        $cart = $user->cart;

        if ($cart) {
            $item = $cart->items()->find($itemId);

            if ($item) {
                $item->delete();
            }
        }

        return back();
    }
    public function increase($itemId)
    {
        $cart = auth()->user()->cart;

        if (!$cart) {
            return back();
        }

        $item = $cart->items()->find($itemId);

        if ($item) {

            $product = $item->product;

            $totalQuantity = $item->cart->items()
                ->where('product_id', $product->id)
                ->sum('quantity');

            if ($totalQuantity >= $product->stock) {

                return back()->with(
                    'error',
                    "Only {$product->stock} left for {$product->name}"
                );
            }

            $item->increment('quantity');
        }

        return back();
    }
    public function decrease($itemId)
    {
        $cart = auth()->user()->cart;

        if (!$cart) {
            return back();
        }

        $item = $cart->items()->find($itemId);

        if ($item) {
            if ($item->quantity > 1) {
                $item->quantity -= 1;
                $item->save();
            } else {
                $item->delete();
            }
        }

        return back();
    }
}
