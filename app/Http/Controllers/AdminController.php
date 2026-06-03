<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;



use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        $productsCount = \App\Models\Product::count();

        $categoriesCount = \App\Models\Category::count();

        $ordersCount = \App\Models\Order::count();

        $usersCount = \App\Models\User::count();

        $recentOrders = \App\Models\Order::with('user')
            ->latest()
            ->take(5)
            ->get();
        // Revenue Stats
        $totalRevenue = \App\Models\Order::whereIn('status', Order::revenueStatuses())
            ->sum('total');

        $monthlyRevenue = \App\Models\Order::whereIn('status', Order::revenueStatuses())
            ->whereMonth('created_at', now()->month)
            ->sum('total');

        $todayRevenue = \App\Models\Order::whereIn('status', Order::revenueStatuses())
            ->whereDate('created_at', today())
            ->sum('total');

        // Low Stock Products
        $lowStockProducts = Product::where('stock', '<=', 5)->with('images')
            ->orderBy('stock')
            ->take(5)
            ->get();

        // Top Selling Products
        $topProducts = Product::withSum('orderItems', 'quantity')->with('images')
            ->orderByDesc('order_items_sum_quantity')
            ->take(5)
            ->get();

        // Latest Users
        $latestUsers = \App\Models\User::latest()
            ->take(5)
            ->get();
        // Orders Analytics
        $pendingOrders = \App\Models\Order::where('status', Order::STATUS_PENDING)->count();

        $paidOrders = \App\Models\Order::where('status', Order::STATUS_PAID)->count();

        $deliveredOrders = \App\Models\Order::where('status', Order::STATUS_DELIVERED)->count();

        $cancelledOrders = \App\Models\Order::where('status', Order::STATUS_CANCELLED)->count();

        // Monthly Revenue Chart
        $monthlyRevenueChart = [];
        $months = [];

        for ($i = 1; $i <= 12; $i++) {

            $monthlyRevenueChart[] = \App\Models\Order::whereIn('status', Order::revenueStatuses())
                ->whereMonth('created_at', $i)
                ->sum('total');

            $months[] = date('M', mktime(0, 0, 0, $i, 1));
        }

        return view('admin.dashboard', compact(

            'productsCount',
            'categoriesCount',
            'ordersCount',
            'usersCount',
            'recentOrders',
            'totalRevenue',
            'monthlyRevenue',
            'todayRevenue',
            'lowStockProducts',
            'topProducts',
            'latestUsers',
            'pendingOrders',
            'paidOrders',
            'deliveredOrders',
            'cancelledOrders',
            'monthlyRevenueChart',
            'months'

        ));
    }
    public function products(Request $request)
    {
        $query = \App\Models\Product::with('category', 'orderItems', 'images');



        // Search
        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Category Filter
        if ($request->category) {

            $query->where('category_id', $request->category);
        }

        //  Gender Filter
        if ($request->gender) {

            $query->where('gender', $request->gender);
        }
        // Stock Filter
        if ($request->stock == 'in') {
            $query->where('stock', '>', 5);
        } elseif ($request->stock == 'low') {
            $query->where('stock', '<=', 5)->where('stock', '>', 0);
        } elseif ($request->stock == 'out') {

            $query->where('stock', '<=', 0);
        }

        // Date Sorting
        if ($request->date == 'newest') {

            $query->latest();
        } elseif ($request->date == 'oldest') {

            $query->oldest();
        }

        // Price Sorting
        if ($request->price == 'low-high') {

            $query->orderBy('price');
        } elseif ($request->price == 'high-low') {

            $query->orderByDesc('price');
        }

        // Product Analytics
        $totalProducts = \App\Models\Product::count();

        $totalStock = \App\Models\Product::sum('stock');

        $outOfStock = \App\Models\Product::where('stock', '<=', 0)->count();

        $lowStock = \App\Models\Product::where('stock', '<=', 5)->where('stock', '>', 0)->count();

        $totalSales = \App\Models\OrderItem::whereHas('order', function ($query) {

            $query->whereIn(
                'status',
                Order::revenueStatuses()
            );
        })->sum('quantity');
        $totalRevenue = \App\Models\Order::whereIn('status', Order::revenueStatuses())->sum('total');

        $averagePrice = \App\Models\Product::avg('price');

        $categoriesCount = \App\Models\Category::count();

        // Best Seller
        $bestSeller = \App\Models\Product::with('images')
            ->withSum('orderItems', 'quantity')
            ->orderByDesc('order_items_sum_quantity')
            ->first();
        // Highest Revenue Product
        $highestRevenueProduct = \App\Models\Product::with('orderItems', 'images')->get()
            ->sortByDesc(function ($product) {

                return $product->orderItems->sum(function ($item) {

                    return $item->price * $item->quantity;
                });
            })
            ->first();

        // Products
        $products = $query->latest()->get();

        // Categories
        $categories = \App\Models\Category::all();

        return view('admin.products', compact(

            'products',
            'categories',
            'totalProducts',
            'totalStock',
            'outOfStock',
            'lowStock',
            'totalSales',
            'totalRevenue',
            'averagePrice',
            'categoriesCount',
            'bestSeller',
            'highestRevenueProduct'

        ));
    }
    public function orders(Request $request)
    {
        $query = \App\Models\Order::with(['user', 'items.product.images']);

        // Search
        if ($request->search) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('id', $search)

                    ->orWhereHas('user', function ($userQuery) use ($search) {

                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        // Status Filter
        if ($request->status) {

            $query->where('status', $request->status);
        }

        // Date Sorting
        if ($request->date == 'newest') {

            $query->latest();
        } elseif ($request->date == 'oldest') {

            $query->oldest();
        }

        // Total Sorting
        if ($request->total == 'high-low') {

            $query->orderByDesc('total');
        } elseif ($request->total == 'low-high') {

            $query->orderBy('total');
        }
        // Analytics
        $totalOrders = \App\Models\Order::count();

        $pendingOrders = \App\Models\Order::where('status', Order::STATUS_PENDING)->count();

        $paidOrders = \App\Models\Order::where('status', Order::STATUS_PAID)->count();

        $shippedOrders = \App\Models\Order::where('status', Order::STATUS_SHIPPED)->count();

        $deliveredOrders = \App\Models\Order::where('status', Order::STATUS_DELIVERED)->count();

        $cancelledOrders = \App\Models\Order::where('status', Order::STATUS_CANCELLED)->count();

        $totalRevenue = \App\Models\Order::whereIn('status', Order::revenueStatuses())->sum('total');

        $averageOrder = \App\Models\Order::avg('total');

        $orders = $query->get();
        return view('admin.orders', compact('orders', 'totalOrders', 'pendingOrders', 'paidOrders', 'shippedOrders', 'deliveredOrders', 'cancelledOrders', 'totalRevenue', 'averageOrder'));
    }
    public function deleteOrder($id)
    {
        $order = \App\Models\Order::findOrFail($id);

        // Delete order items first
        $order->items()->delete();

        // Delete order
        $order->delete();

        return back()->with(

            'success',

            'Order deleted successfully.'

        );
    }
    public function editProduct($id)
    {
        $product = Product::with('images', 'sizes')->findOrFail($id);
        $categories = \App\Models\Category::all();

        return view('admin.edit_product', compact('product', 'categories'));
    }
    public function updateProduct(Request $request, $id)
    {
        $product = \App\Models\Product::findOrFail($id);



        // Update Product
        $product->update([

            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'gender' => $request->gender,
            'description' => $request->description,
            'stock' => $request->stock

        ]);


        // Update Images
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $path = $image->store('products', 'public');

                $product->images()->create([

                    'image' => $path

                ]);
            }
        }


        // Add New Sizes
        if ($request->sizes) {

            // حذف المقاسات القديمة
            $product->sizes()->delete();

            // إضافة الجديدة
            $sizes = explode(',', $request->sizes);

            foreach ($sizes as $size) {

                $product->sizes()->create([

                    'size' => trim($size)

                ]);
            }
        }

        return redirect()->route('admin.products')
            ->with('success', 'Product updated');
    }
    public function createProduct()
    {
        $categories = \App\Models\Category::all();
        return view('admin.create_product', compact('categories'));
    }
    public function storeProduct(Request $request)
    {


        // Create Product
        $product = Product::create([

            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'gender' => $request->gender,
            'description' => $request->description,
            'stock' => $request->stock

        ]);

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $path = $image->store('products', 'public');

                $product->images()->create([

                    'image' => $path

                ]);
            }
        }

        // Add Sizes
        if ($request->sizes) {

            $sizes = explode(',', $request->sizes);

            foreach ($sizes as $size) {

                $product->sizes()->create([

                    'size' => trim($size)

                ]);
            }
        }

        return redirect()->route('admin.products');
    }
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        $product->sizes()->delete();

        $product->images()->delete();

        $product->delete();

        return back();
    }

    public function deleteProductImage($id)
    {
        $image = \App\Models\ProductImage::findOrFail($id);

        Storage::disk('public')->delete($image->image);

        $image->delete();

        return response()->json(['success' => true]);
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', Order::statuses())
        ]);

        $order = \App\Models\Order::findOrFail($id);

        $order->update([
            'status' => $request->status
        ]);

        return back();
    }
    public function settings()
    {
        $settings = Setting::getSettings();

        return view('admin.settings', compact('settings'));
    }
    public function updateSettings(Request $request)
    {
        $request->validate([

            'shipping_price' => 'required|numeric|min:0',

            'free_shipping_minimum' => 'required|numeric|min:0',

            'premium_customer_minimum' => 'required|numeric|min:0',

            'vip_customer_minimum' => 'required|numeric|min:0',

            'elite_customer_minimum' => 'required|numeric|min:0',

        ]);

        $settings = Setting::getSettings();

        $settings->update([

            'shipping_price' => $request->shipping_price,

            'free_shipping_minimum' => $request->free_shipping_minimum,

            'premium_customer_minimum' => $request->premium_customer_minimum,

            'vip_customer_minimum' => $request->vip_customer_minimum,

            'elite_customer_minimum' => $request->elite_customer_minimum,

        ]);

        return back()->with('success', 'Settings updated successfully');
    }
    public function users(Request $request)
    {
        $query = User::with('orders');

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Sorting
        if ($request->sort == 'oldest') {

            $query->oldest();
        } else {

            $query->latest();
        }

        // Role Filter
        if ($request->role == 'admin') {

            $query->where('is_admin', true);
        }
        if ($request->role == 'customer') {

            $query->where('is_admin', false);
        }

        // Status Filter
        if ($request->status == 'suspended') {

            $query->where('is_suspended', true);
        }
        if ($request->status == 'active') {

            $query->where('is_suspended', false);
        }

        // Verification Filter
        if ($request->verification == 'verified') {

            $query->whereNotNull('email_verified_at');
        }
        if ($request->verification == 'not_verified') {

            $query->whereNull('email_verified_at');
        }



        $users = $query->get();

        return view('admin.users', compact('users'));
    }
    public function showUser($id)
    {
        $user = \App\Models\User::with([

            'orders.items.product.images',
            'wishlistItems.product.images',
            'cart.items.product.images',
            'orders.items.product.category',
            'wishlistItems.product.category',
        ])->findOrFail($id);

        return view('admin.user-show', compact('user'));
    }
    public function updateUserNotes(Request $request, $id)
    {
        $request->validate([

            'admin_notes' => 'nullable|string'

        ]);

        $user = \App\Models\User::findOrFail($id);

        $user->update([

            'admin_notes' => $request->admin_notes

        ]);

        return back()->with('success', 'Notes updated successfully');
    }
    public function toggleSuspend($id)
    {
        $user = \App\Models\User::findOrFail($id);

        if (Auth::id() == $user->id) {

            return back()->with(
                'error',
                'You cannot suspend your own account.'
            );
        }
        $user->update([
            'is_suspended' => !$user->is_suspended
        ]);

        return back()->with(
            'success',
            $user->is_suspended
                ? 'User suspended successfully.'
                : 'User activated successfully.'
        );
    }
    public function toggleAdmin($id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() == $user->id) {

            return back()->with(
                'error',
                'You cannot change your own admin status.'
            );
        }

        $user->update([
            'is_admin' => !$user->is_admin
        ]);

        return back();
    }
    public function toggleEmailVerification($id)
    {
        $user = \App\Models\User::findOrFail($id);

        if (Auth::id() == $user->id && $user->email_verified_at) {
            return back()->with(
                'error',
                'You cannot remove verification from your own account.'
            );
        }

        $user->update([
            'email_verified_at' =>
            $user->email_verified_at
                ? null
                : now()
        ]);

        return back()->with(
            'success',
            $user->email_verified_at
                ? 'Email verified successfully.'
                : 'Email verification removed successfully.'
        );
    }
    public function sendPasswordResetLink($id)
    {
        $user = User::findOrFail($id);

        if (!$user->hasVerifiedEmail()) {

            return back()->with(
                'error',
                'Verify the email first before sending a password reset link.'
            );
        }

        Password::sendResetLink([
            'email' => $user->email,
        ]);

        return back()->with(
            'success',
            'Password reset link sent successfully.'
        );
    }
    public function updateCustomerLevel(Request $request, $id)
    {
        $request->validate([
            'customer_level_override' => 'nullable|in:Standard,Premium,VIP,Elite'
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'customer_level_override' =>
            $request->customer_level_override ?: null
        ]);

        return back()->with(
            'success',
            'Customer level updated successfully.'
        );
    }
    public function deleteUser($id)
    {
        $user = \App\Models\User::findOrFail($id);

        // Prevent deleting yourself
        if (Auth::id() == $user->id) {

            return back()->with(
                'error',
                'You cannot delete your own account.'
            );
        }

        // Prevent deleting other admins
        if ($user->is_admin) {

            return back()->with(
                'error',
                'Admin accounts cannot be deleted.'
            );
        }

        $user->delete();

        return redirect()
            ->route('admin.users')
            ->with(
                'success',
                'User deleted successfully.'
            );
    }
}
