<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;


class CartController extends Controller
{
    // Show cart
    public function index(Request $request)
    {
        $user = $request->user();

        $cart = $user->cart()->with('items.product')->first();

        return response()->json($cart);
    }

    // Add item to cart
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size'       => 'nullable|string',
        ]);

        $product = \App\Models\Product::findOrFail($request->product_id);

        // Check stock
        if ($product->stock <= 0) {
            return response()->json([
                'message' => 'Product is out of stock'
            ], 400);
        }

        $user = $request->user();

        $cart = $user->cart;

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id
            ]);
        }

        // Match on both product_id AND size
        $item = $cart->items()
            ->where('product_id', $request->product_id)
            ->where('size', $request->size)
            ->first();

        // Total quantity of this product across all sizes
        $totalQuantity = $cart->items()
            ->where('product_id', $request->product_id)
            ->sum('quantity');

        if ($totalQuantity >= $product->stock) {
            return response()->json([
                'message' => "Only {$product->stock} left for {$product->name}"
            ], 400);
        }

        if ($item) {
            $item->increment('quantity');
        } else {
            $cart->items()->create([
                'product_id' => $request->product_id,
                'quantity'   => 1,
                'size'       => $request->size,
            ]);
        }

        return response()->json([
            'message' => 'Added to cart'
        ]);
    }

    // Delete item from cart
    public function remove(Request $request, $id)
    {
        $item = $request->user()
            ->cart
            ->items()
            ->findOrFail($id);

        $item->delete();

        return response()->json([
            'message' => 'Item removed'
        ]);
    }

    // Increase quantity
    public function increase(Request $request, $id)
    {
        $item = $request->user()
            ->cart
            ->items()
            ->findOrFail($id);

        $product = $item->product;

        // Check total stock across all sizes for this product
        $totalQuantity = $item->cart->items()
            ->where('product_id', $product->id)
            ->sum('quantity');

        if ($totalQuantity >= $product->stock) {
            return response()->json([
                'message' => "Only {$product->stock} left for {$product->name}"
            ], 400);
        }

        $item->increment('quantity');

        return response()->json([
            'message'  => 'Quantity increased',
            'quantity' => $item->fresh()->quantity,
        ]);
    }

    // Decrease quantity
    public function decrease(Request $request, $id)
    {
        $item = $request->user()
            ->cart
            ->items()
            ->findOrFail($id);

        if ($item->quantity > 1) {
            $item->decrement('quantity');

            return response()->json([
                'message'  => 'Quantity decreased',
                'quantity' => $item->fresh()->quantity,
            ]);
        }

        $item->delete();

        return response()->json([
            'message' => 'Item removed from cart'
        ]);
    }
}
