<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        return DB::transaction(function () use ($request) {

            $user = $request->user();

            $cart = $user->cart()
                ->with('items.product')
                ->first();

            // Check if cart exists
            if (!$cart || $cart->items->isEmpty()) {

                return response()->json([
                    'message' => 'Cart is empty'
                ], 400);
            }

            /*
        |--------------------------------------------------------------------------
        | Stock Validation
        |--------------------------------------------------------------------------
        */

            foreach ($cart->items as $item) {

                $product = $item->product;

                // Product deleted
                if (!$product) {

                    return response()->json([
                        'message' => 'Product not found'
                    ], 404);
                }

                // Not enough stock
                if ($product->stock < $item->quantity) {

                    return response()->json([
                        'message' => "{$product->name} does not have enough stock"
                    ], 400);
                }
            }

            /*
        |--------------------------------------------------------------------------
        | Create Order
        |--------------------------------------------------------------------------
        */

            $order = Order::create([

                'user_id' => $user->id,

                'total' => 0,

                'status' => Order::STATUS_PENDING

            ]);

            $total = 0;

            /*
        |--------------------------------------------------------------------------
        | Create Order Items
        |--------------------------------------------------------------------------
        */

            foreach ($cart->items as $item) {

                $price = $item->product->price;

                $qty = $item->quantity;

                $order->items()->create([

                    'product_id' => $item->product_id,

                    'quantity' => $qty,

                    'price' => $price

                ]);

                $total += $price * $qty;

                // Decrease stock
                $item->product->decrement('stock', $qty);
            }

            /*
        |--------------------------------------------------------------------------
        | Update Total
        |--------------------------------------------------------------------------
        */

            $order->update([
                'total' => $total
            ]);

            /*
        |--------------------------------------------------------------------------
        | Clear Cart
        |--------------------------------------------------------------------------
        */

            $cart->items()->delete();

            return response()->json([

                'message' => 'Order created successfully',

                'order_id' => $order->id,

                'total' => $total

            ]);
        });
    }
    public function index(Request $request)
    {
        $orders = $request->user()
            ->orders()
            ->with('items.product')
            ->latest()
            ->get();

        return response()->json($orders);
    }

    public function show(Request $request, $id)
    {
        $order = $request->user()
            ->orders()
            ->with('items.product')
            ->findOrFail($id);

        return response()->json($order);
    }
}
