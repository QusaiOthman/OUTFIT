<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function checkout()
    {
        $user = auth()->user();

        $cart = $user->cart()->with('items.product')->first();
        if (!$cart || $cart->items->isEmpty()) {
            return back()->with('error', 'Cart is empty');
        }

        // 🧾 1. إنشاء Order
        $order = Order::create([
            'user_id' => $user->id,
            'total' => 0,
            'status' => 'pending'
        ]);

        $total = 0;

        // 📦 2. نقل Cart Items → Order Items
        foreach ($cart->items as $item) {
            $price = $item->product->price;
            $quantity = $item->quantity;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $quantity,
                'price' => $price,
                'size' => $item->size

            ]);

            $total += $price * $quantity;
        }

        // 💰 3. تحديث total
        $order->update([
            'total' => $total
        ]);

        // 🗑️ 4. تفريغ السلة
        $cart->items()->delete();

        return redirect('/cart')->with('success', 'Order placed successfully');
    }
    public function payment()
    {
        $user = auth()->user();

        $cart = $user->cart()->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {

            return redirect('/cart');
        }

        // Collect quantities for same product
        $productQuantities = [];

        foreach ($cart->items as $item) {

            $productId = $item->product_id;

            if (!isset($productQuantities[$productId])) {

                $productQuantities[$productId] = 0;
            }

            $productQuantities[$productId] += $item->quantity;
        }

        // Check stock
        foreach ($productQuantities as $productId => $quantity) {

            $product = Product::find($productId);

            // Out Of Stock
            if ($product->stock <= 0) {

                return redirect('/cart')->with(

                    'error',

                    "{$product->name} is out of stock."

                );
            }

            // Quantity exceeds stock
            if ($quantity > $product->stock) {

                return redirect('/cart')->with(

                    'error',

                    "Only {$product->stock} left for {$product->name}"

                );
            }
        }

        return view('payment');
    }

    public function processPayment(Request $request)
    {
        $request->validate([

            'phone' => 'required',

            'address' => 'required',

            'card_holder' => 'required',

            'card_number' => [

                'required',

                'regex:/^\d{4}\s\d{4}\s\d{4}\s\d{4}$/'

            ],

            'expiry_date' => [

                'required',

                function ($attribute, $value, $fail) {

                    if (!preg_match('/^(0[1-9]|1[0-2])\/\d{2}$/', $value)) {

                        return $fail('Invalid expiry date format.');
                    }

                    [$month, $year] = explode('/', $value);

                    $currentMonth = now()->format('m');

                    $currentYear = now()->format('y');

                    if (

                        $year < $currentYear ||

                        ($year == $currentYear && $month < $currentMonth)

                    ) {

                        return $fail('Card expiry date is invalid.');
                    }
                }

            ],

            'cvv' => [

                'required',

                'digits:3'

            ],

        ], [

            'card_number.regex' => 'Card number must contain 16 digits.',

            'cvv.digits' => 'CVV must be 3 digits.',

        ]);

        $user = auth()->user();

        // Save user info
        $user->update([

            'phone' => $request->phone,

            'address' => $request->address

        ]);

        $cart = $user->cart()->with('items.product')->first();
        if (!$cart || $cart->items->isEmpty()) {

            return back()->with('error', 'Cart is empty');
        }

        // Collect quantities for same product
        $productQuantities = [];

        foreach ($cart->items as $item) {

            $productId = $item->product_id;

            if (!isset($productQuantities[$productId])) {

                $productQuantities[$productId] = 0;
            }

            $productQuantities[$productId] += $item->quantity;
        }

        // Final stock check
        foreach ($productQuantities as $productId => $quantity) {

            $product = Product::find($productId);

            // Out Of Stock
            if ($product->stock <= 0) {

                return back()->with(

                    'error',

                    "{$product->name} is out of stock"

                );
            }

            // Quantity exceeds stock
            if ($quantity > $product->stock) {

                return back()->with(

                    'error',

                    "Only {$product->stock} left for {$product->name}"

                );
            }
        }
        return DB::transaction(function () use (
            $request,
            $user,
            $cart,
            $productQuantities
        ) {
            // Create Order
            $order = \App\Models\Order::create([

                'user_id' => $user->id,

                'total' => 0,

                'status' => 'paid'

            ]);

            $settings = Setting::getSettings();

            $subtotal = 0;

            // Create Order Items
            foreach ($cart->items as $item) {

                $product = $item->product;

                $price = $product->price;

                \App\Models\OrderItem::create([

                    'order_id' => $order->id,

                    'product_id' => $item->product_id,

                    'quantity' => $item->quantity,

                    'price' => $price,

                    'size' => $item->size

                ]);

                $subtotal += $price * $item->quantity;
            }

            // Reduce stock once per product
            foreach ($productQuantities as $productId => $quantity) {

                $product = Product::find($productId);

                $product->decrement('stock', $quantity);
            }

            // Shipping Logic
            $shipping = $subtotal >= $settings->free_shipping_minimum

                ? 0

                : $settings->shipping_price;

            // Final Total
            $total = $subtotal + $shipping;

            // Update Order
            $order->update([

                'subtotal' => $subtotal,

                'shipping' => $shipping,

                'total' => $total

            ]);

            // Clear Cart
            $cart->items()->delete();

            return redirect()->route('orders.show', $order->id);
        });
    }
    public function show($id)
    {
        $order = auth()->user()
            ->orders()
            ->with('items.product.images', 'items.product.category')
            ->findOrFail($id);
        return view('orders.show', compact('order'));
    }
    public function index()
    {
        $orders = auth()->user()
            ->orders()
            ->with('items.product.images')
            ->latest()
            ->get();
        return view('orders.index', compact('orders'));
    }
}
