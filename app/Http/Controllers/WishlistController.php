<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\WishlistItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function toggle($productId)
    {
        $user = Auth::user();

        $item = WishlistItem::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        // Remove
        if ($item) {

            $item->delete();

            return back();
        }

        // Add
        WishlistItem::create([

            'user_id' => $user->id,
            'product_id' => $productId

        ]);

        return back();
    }

    public function index()
    {
        $items = WishlistItem::where('user_id', Auth::id())
            ->with('product.category', 'product.images')
            ->latest()
            ->get();

        return view('wishlist', compact('items'));
    }
}
