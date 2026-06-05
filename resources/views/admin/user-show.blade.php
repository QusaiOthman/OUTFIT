@extends('admin.layout')
@php

    use App\Models\Setting;

    $allItems = collect();

    foreach ($user->orders as $order) {
        foreach ($order->items as $item) {
            $allItems->push($item);
        }
    }

    // Total Items Bought
    $totalItemsBought = $allItems->sum('quantity');

    // Biggest Order
    $biggestOrder = $user->orders->max('total');

    // Average Order
    $averageOrder = $user->orders->count() ? $user->orders->avg('total') : 0;

    // Favorite Category
    $favoriteCategory = $allItems
        ->groupBy(fn($item) => $item->product->category->name ?? 'Unknown')
        ->map(fn($items) => $items->sum('quantity'))
        ->sortDesc()
        ->keys()
        ->first();

    // Customer Level Calculation
    $settings = Setting::getSettings();

    $totalSpent = $user->orders->sum('total');

    if ($user->customer_level_override) {
        $customerLevel = $user->customer_level_override;
    } else {
        if ($totalSpent >= $settings->elite_customer_minimum) {
            $customerLevel = 'Elite';
        } elseif ($totalSpent >= $settings->vip_customer_minimum) {
            $customerLevel = 'VIP';
        } elseif ($totalSpent >= $settings->premium_customer_minimum) {
            $customerLevel = 'Premium';
        } else {
            $customerLevel = 'Standard';
        }
    }

@endphp

@section('content')

    <div class="mb-10 flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">

        <div>

            <p class="uppercase tracking-[5px] text-[#b08b68] text-xs mb-3">
                User Details
            </p>

            <h1 class="hero-title text-4xl md:text-5xl xl:text-[70px] leading-none text-[#1a1a1a] break-words">

                {{ $user->name }}

            </h1>
            <div class="flex flex-wrap gap-3 mt-6">

                @if ($user->is_suspended)
                    <div class="px-5 py-3 rounded-2xl bg-red-100 text-red-700 text-sm uppercase tracking-[3px]">

                        Suspended

                    </div>
                @endif
                <!-- Customer Level -->
                <div class="px-5 py-3 rounded-2xl bg-black text-white text-sm uppercase tracking-[3px]">

                    {{ $customerLevel }}

                </div>

                <!-- Verified -->
                @if ($user->email_verified_at)
                    <div class="px-5 py-3 rounded-2xl bg-green-100 text-green-700 text-sm uppercase tracking-[3px]">

                        Verified

                    </div>
                @endif

                <!-- High Spender -->
                @if ($totalSpent >= 1000)
                    <div class="px-5 py-3 rounded-2xl bg-[#f8f4ef] text-[#1f1f1f] text-sm uppercase tracking-[3px]">

                        High Spender

                    </div>
                @endif

                <!-- Loyal Customer -->
                @if ($user->orders->count() >= 5)
                    <div class="px-5 py-3 rounded-2xl bg-[#f3f0ff] text-[#5b4b9a] text-sm uppercase tracking-[3px]">

                        Loyal Customer

                    </div>
                @endif

                <!-- Admin -->
                @if ($user->is_admin)
                    <div class="px-5 py-3 rounded-2xl bg-blue-800 text-white uppercase tracking-[3px] text-xs">

                        Admin

                    </div>
                @endif

            </div>

        </div>



    </div>

    @if (session('success'))
        <div class="mb-6 px-6 py-4 rounded-[24px] bg-green-50 border border-green-200 text-green-700">

            {{ session('success') }}

        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 px-6 py-4 rounded-[24px] bg-red-50 border border-red-200 text-red-700">

            {{ session('error') }}

        </div>
    @endif

    <!-- USER INFO -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">

        <!-- Email -->
        <div class="bg-white border border-[#ece5dc] rounded-[30px] p-6">

            <p class="text-xs uppercase tracking-[3px] text-[#b08b68] mb-3">
                Email
            </p>

            <h3 class="text-xl text-[#1f1f1f] break-all">

                {{ $user->email }}

            </h3>

        </div>

        <!-- Orders -->
        <div class="bg-white border border-[#ece5dc] rounded-[30px] p-6">

            <p class="text-xs uppercase tracking-[3px] text-[#b08b68] mb-3">
                Orders
            </p>

            <h3 class="number-font text-3xl md:text-4xl xl:text-5xl text-[#1f1f1f]">

                {{ $user->orders->count() }}

            </h3>

        </div>

        <!-- Total Spent -->
        <div class="bg-black rounded-[30px] p-6">

            <p class="text-xs uppercase tracking-[3px] text-white/60 mb-3">
                Total Spent
            </p>

            <h3 class="number-font text-3xl md:text-4xl xl:text-5xl text-white">

                {{ number_format($user->orders->sum('total'), 2) }}<span class="text-[8px] sm:text-[10px]">SAR</span>

            </h3>

        </div>

    </div>
    <!-- CUSTOMER ANALYTICS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

        <!-- Total Items Bought -->
        <div class="bg-white border border-[#ece5dc] rounded-[30px] p-6">

            <p class="text-xs uppercase tracking-[3px] text-[#b08b68] mb-3">
                Items Bought
            </p>

            <h3 class="number-font text-3xl md:text-4xl xl:text-5xl text-[#1f1f1f]">

                {{ $totalItemsBought }}

            </h3>

        </div>

        <!-- Biggest Order -->
        <div class="bg-white border border-[#ece5dc] rounded-[30px] p-6">

            <p class="text-xs uppercase tracking-[3px] text-[#b08b68] mb-3">
                Biggest Order
            </p>

            <h3 class="number-font text-3xl md:text-4xl xl:text-5xl text-[#1f1f1f]">

                {{ number_format($biggestOrder, 2) }}<span class="text-[8px] sm:text-[10px]">SAR</span>

            </h3>

        </div>

        <!-- Average Order -->
        <div class="bg-white border border-[#ece5dc] rounded-[30px] p-6">

            <p class="text-xs uppercase tracking-[3px] text-[#b08b68] mb-3">
                Average Order
            </p>

            <h3 class="number-font text-3xl md:text-4xl xl:text-5xl text-[#1f1f1f]">

                {{ number_format($averageOrder, 2) }}<span class="text-[8px] sm:text-[10px]">SAR</span>

            </h3>

        </div>

        <!-- Favorite Category -->
        <div class="bg-black rounded-[30px] p-6">

            <p class="text-xs uppercase tracking-[3px] text-white/60 mb-3">
                Favorite Category
            </p>

            <h3 class="hero-title text-2xl md:text-3xl xl:text-4xl text-white leading-tight break-words">

                {{ $favoriteCategory ?? 'None' }}

            </h3>

        </div>

    </div>
    <!-- ADMIN NOTES -->
    <div class="bg-white border border-[#ece5dc] rounded-[24px] md:rounded-[36px] p-5 md:p-8 mb-8">

        <div class="flex items-center justify-between mb-8">

            <div>

                <p class="uppercase tracking-[4px] text-[#b08b68] text-xs mb-3">
                    Internal Notes
                </p>

                <h2 class="hero-title text-2xl md:text-3xl xl:text-4xl text-[#1f1f1f]">
                    Admin Notes
                </h2>

            </div>

        </div>

        <form action="{{ route('admin.users.notes', $user->id) }}" method="POST">

            @csrf
            @method('PUT')

            <textarea name="admin_notes" rows="5" placeholder="Write private notes about this customer..."
                class="w-full rounded-[28px] border border-[#ece5dc] bg-[#faf7f3] px-6 py-5 text-[#1f1f1f] resize-none focus:ring-0 focus:border-black/20">{{ $user->admin_notes }}</textarea>

            <div class="flex justify-end mt-6">

                <button type="submit"
                    class="hero-title h-[54px] px-8 rounded-2xl bg-black text-white hover:bg-neutral-800 transition">

                    Save Notes

                </button>

            </div>

        </form>

    </div>

    <!-- ACCOUNT MANAGEMENT -->
    <div class="bg-white border border-[#ece5dc] rounded-[24px] md:rounded-[36px] p-5 md:p-8 mb-8">

        <p class="uppercase tracking-[4px] text-[#b08b68] text-xs mb-3">
            Account Management
        </p>

        <h2 class="hero-title text-2xl md:text-3xl xl:text-4xl text-[#1f1f1f] mb-8">
            Admin Actions
        </h2>

        <!-- Suspend/Activate Account -->
        <form action="{{ route('admin.users.suspend', $user->id) }}" method="POST">

            @csrf
            @method('PUT')

            @if (!$user->is_suspended)
                <button type="submit"
                    class="h-[54px] px-8 rounded-2xl bg-yellow-500 text-white hover:bg-yellow-600 transition">

                    Suspend Account

                </button>
            @else
                <button type="submit"
                    class="h-[54px] px-8 rounded-2xl bg-green-600 text-white hover:bg-green-700 transition">

                    Activate Account

                </button>
            @endif

        </form>

        <!-- Admin Role -->
        <form action="{{ route('admin.users.toggleAdmin', $user->id) }}" method="POST" class="mt-4">

            @csrf
            @method('PUT')

            @if (!$user->is_admin)
                <button type="submit"
                    class="h-[54px] px-8 rounded-2xl bg-black text-white hover:bg-neutral-800 transition">

                    Make Admin

                </button>
            @else
                <button type="submit"
                    class="h-[54px] px-8 rounded-2xl border border-black text-black hover:bg-black hover:text-white transition">

                    Remove Admin

                </button>
            @endif

        </form>

        <!-- Email Verification -->
        <form action="{{ route('admin.users.toggleVerification', $user->id) }}" method="POST" class="mt-4">

            @csrf
            @method('PUT')

            @if (!$user->email_verified_at)
                <button type="submit"
                    class="h-[54px] px-8 rounded-2xl bg-blue-600 text-white hover:bg-blue-700 transition">

                    Verify Email

                </button>
            @else
                <button type="submit"
                    class="h-[54px] px-8 rounded-2xl border border-blue-600 text-blue-600 hover:bg-blue-50 transition">

                    Remove Verification

                </button>
            @endif

        </form>

        <!-- Send Password Reset Link -->
        <form action="{{ route('admin.users.sendResetLink', $user->id) }}" method="POST" class="mt-4">

            @csrf

            <button type="submit" class="h-[54px] px-8 rounded-2xl bg-[#3b82f6] text-white hover:bg-[#2563eb] transition">

                Send Password Reset Link

            </button>

        </form>

        <!-- Customer Level Override -->
        <form action="{{ route('admin.users.customerLevel', $user->id) }}" method="POST" class="mt-8">

            @csrf
            @method('PUT')

            <label class="block text-sm tracking-[3px] uppercase text-[#8b8175] mb-3">
                Customer Level Override
            </label>

            <select name="customer_level_override"
                class="w-full max-w-sm h-[54px] rounded-2xl border border-[#ece5dc] bg-[#faf7f3] px-4">

                <option value="">
                    Auto
                </option>

                <option value="Standard" @selected($user->customer_level_override === 'Standard')>
                    Standard
                </option>

                <option value="Premium" @selected($user->customer_level_override === 'Premium')>
                    Premium
                </option>

                <option value="VIP" @selected($user->customer_level_override === 'VIP')>
                    VIP
                </option>

                <option value="Elite" @selected($user->customer_level_override === 'Elite')>
                    Elite
                </option>

            </select>

            <button type="submit"
                class="mt-4 h-[54px] px-8 rounded-2xl bg-black text-white hover:bg-neutral-800 transition">

                Save Level

            </button>

        </form>

        <!-- Delete Account -->
        <div class="mt-10 pt-8 border-t border-red-100">

            <p class="uppercase tracking-[3px] text-red-500 text-xs mb-3">

                Danger Zone

            </p>

            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to permanently delete this user?')">

                @csrf
                @method('DELETE')

                <button type="submit" class="h-[54px] px-8 rounded-2xl bg-red-600 text-white hover:bg-red-700 transition">

                    Delete User

                </button>

            </form>

        </div>

    </div>

    <!-- ACCOUNT DETAILS -->
    <div class="bg-white border border-[#ece5dc] rounded-[24px] md:rounded-[36px] p-5 md:p-8 mb-8">

        <div class="flex items-center justify-between mb-8">

            <h2 class="hero-title text-2xl md:text-3xl xl:text-4xl text-[#1f1f1f]">
                Account Details
            </h2>

            @if ($user->email_verified_at)
                <div class="px-4 py-2 rounded-2xl bg-green-100 text-green-700 text-sm">
                    Verified
                </div>
            @else
                <div class="px-4 py-2 rounded-2xl bg-red-100 text-red-700 text-sm">
                    Not Verified
                </div>
            @endif

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>

                <p class="text-xs uppercase tracking-[3px] text-[#b08b68] mb-2">
                    Created At
                </p>

                <h3 class="text-lg md:text-xl xl:text-2xl text-[#1f1f1f] break-words">

                    {{ $user->created_at->format('d M Y') }}

                </h3>

            </div>

            <div>

                <p class="text-xs uppercase tracking-[3px] text-[#b08b68] mb-2">
                    Wishlist Items
                </p>

                <h3 class="text-lg md:text-xl xl:text-2xl text-[#1f1f1f] break-words">

                    {{ $user->wishlistItems ? $user->wishlistItems->count() : 0 }}

                </h3>

            </div>

        </div>

    </div>
    <!-- CONTACT & SHIPPING -->
    <div class="bg-white border border-[#ece5dc] rounded-[24px] md:rounded-[36px] p-5 md:p-8 mb-8">

        <div class="mb-8">

            <p class="uppercase tracking-[4px] text-[#b08b68] text-xs mb-3">
                Contact Information
            </p>

            <h2 class="hero-title text-2xl md:text-3xl xl:text-4xl text-[#1f1f1f]">
                Shipping & Contact
            </h2>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Phone -->
            <div class="bg-[#faf7f3] rounded-[28px] p-6">

                <p class="uppercase tracking-[3px] text-[#b08b68] text-xs mb-3">
                    Phone Number
                </p>

                <h3 class="text-2xl text-[#1f1f1f] break-all">

                    {{ $user->phone ?: 'No phone added' }}

                </h3>

            </div>

            <!-- Address -->
            <div class="bg-[#faf7f3] rounded-[28px] p-6">

                <p class="uppercase tracking-[3px] text-[#b08b68] text-xs mb-3">
                    Shipping Address
                </p>

                <h3 class="text-lg md:text-2xl text-[#1f1f1f] leading-relaxed break-words">

                    {{ $user->address ?: 'No address added' }}

                </h3>

            </div>

        </div>

    </div>
    <!-- CURRENT CART -->
    <div class="bg-white border border-[#ece5dc] rounded-[36px] overflow-hidden mb-8">

        <div
            class="p-5 md:p-8 border-b border-[#f3eee8] flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>

                <p class="uppercase tracking-[4px] text-[#b08b68] text-xs mb-3">
                    Live Cart
                </p>

                <h2 class="hero-title text-2xl md:text-3xl xl:text-4xl text-[#1f1f1f]">
                    Current Cart
                </h2>

            </div>

            @php

                $cartTotal = 0;

                if ($user->cart) {
                    foreach ($user->cart->items as $item) {
                        $cartTotal += $item->product->price * $item->quantity;
                    }
                }

            @endphp

            <div class="text-right">

                <p class="uppercase tracking-[3px] text-[#b08b68] text-xs mb-2">
                    Cart Total
                </p>

                <h3 class="number-font text-2xl md:text-3xl xl:text-4xl text-[#1f1f1f]">

                    {{ number_format($cartTotal, 2) }}<span class="text-[8px] sm:text-[10px]">SAR</span>

                </h3>

            </div>

        </div>

        @if ($user->cart && $user->cart->items->count())
            <div class="p-8 space-y-5">

                @foreach ($user->cart->items as $item)
                    <div class="flex flex-col md:flex-row md:items-center gap-5 bg-[#faf7f3] rounded-[28px] p-5">

                        @if ($item->product->images->first())
                            <img src="{{ $item->product->images->first()->image_url }}"
                                class="w-20 h-20 md:w-24 md:h-24 rounded-[22px] object-cover">
                        @endif
                        <div class="flex-1">

                            <h3 class="text-lg md:text-xl xl:text-2xl text-[#1f1f1f] break-words">

                                {{ $item->product->name }}

                            </h3>

                            <div class="flex items-center gap-5 mt-3 text-[#8b8175]">

                                <p>
                                    Quantity: x{{ $item->quantity }}
                                </p>

                                @if ($item->size)
                                    <p>
                                        Size: {{ $item->size }}
                                    </p>
                                @endif

                            </div>

                        </div>

                        <h3 class="number-font text-lg md:text-xl xl:text-2xl text-[#1f1f1f]">

                            {{ number_format($item->product->price * $item->quantity, 2) }}<span class="text-[6px] sm:text-[8px]">SAR</span>

                        </h3>

                    </div>
                @endforeach

            </div>
        @else
            <div class="p-10 text-center text-[#8b8175]">

                Cart is currently empty.

            </div>
        @endif

    </div>

    <!-- WISHLIST -->
    <div class="bg-white border border-[#ece5dc] rounded-[36px] overflow-hidden mb-8">

        <div class="p-8 border-b border-[#f3eee8] flex items-center justify-between">

            <div>

                <p class="uppercase tracking-[4px] text-[#b08b68] text-xs mb-3">
                    Saved Products
                </p>

                <h2 class="hero-title text-2xl md:text-3xl xl:text-4xl text-[#1f1f1f]">
                    Wishlist
                </h2>

            </div>

            <div class="text-right">

                <p class="uppercase tracking-[3px] text-[#b08b68] text-xs mb-2">
                    Total Items
                </p>

                <h3 class="number-font text-2xl md:text-3xl xl:text-4xl text-[#1f1f1f]">

                    {{ $user->wishlistItems->count() }}

                </h3>

            </div>

        </div>

        @if ($user->wishlistItems->count())
            <div class="p-5 md:p-8 grid grid-cols-1 xl:grid-cols-2 gap-5">

                @foreach ($user->wishlistItems as $item)
                    <div class="flex flex-col md:flex-row md:items-center gap-5 bg-[#faf7f3] rounded-[28px] p-5">

                        @if ($item->product->images->first())
                            <img src="{{ $item->product->images->first()->image_url }}"
                                class="w-24 h-24 rounded-[22px] object-cover">
                        @endif
                        <div class="flex-1">

                            <h3 class="text-lg md:text-2xl text-[#1f1f1f] break-words">

                                {{ $item->product->name }}

                            </h3>

                            <p class="text-[#8b8175] mt-2">

                                {{ $item->product->category->name ?? 'No Category' }}

                            </p>

                        </div>

                        <h3 class="number-font text-lg md:text-xl xl:text-2xl text-[#1f1f1f]">

                            {{ number_format($item->product->price, 2) }}<span class="text-[6px] sm:text-[8px]">SAR</span>

                        </h3>

                    </div>
                @endforeach

            </div>
        @else
            <div class="p-10 text-center text-[#8b8175]">

                Wishlist is empty.

            </div>
        @endif

    </div>

    <!-- ORDERS -->
    <div class="bg-white border border-[#ece5dc] rounded-[36px] overflow-hidden">

        <div class="p-8 border-b border-[#f3eee8]">

            <h2 class="hero-title text-2xl md:text-3xl xl:text-4xl text-[#1f1f1f]">
                Orders
            </h2>

        </div>

        @forelse($user->orders as $order)
            <div class="p-8 border-b border-[#f3eee8]">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

                    <div>

                        <p class="text-xs uppercase tracking-[3px] text-[#b08b68] mb-2">
                            Order #{{ $order->id }}
                        </p>

                        <h3 class="number-font text-lg md:text-xl xl:text-2xl text-[#1f1f1f] break-words">

                            {{ number_format($order->total, 2) }}<span class="text-[8px] sm:text-[10px]">SAR</span>

                        </h3>

                    </div>

                    <div class="px-4 py-2 rounded-2xl bg-[#f8f4ef] text-[#1f1f1f] capitalize">

                        {{ $order->status }}

                    </div>

                </div>

                <div class="space-y-4">

                    @foreach ($order->items as $item)
                        <div class="flex flex-col md:flex-row md:items-center gap-5 bg-[#faf7f3] rounded-[24px] p-4">

                            @if ($item->product->images->first())
                                <img src="{{ $item->product->images->first()->image_url }}"
                                    class="w-20 h-20 rounded-2xl object-cover">
                            @endif
                            <div class="flex-1">

                                <h3 class="text-lg md:text-xl text-[#1f1f1f] break-words">

                                    {{ $item->product->name }}

                                </h3>

                                <p class="text-[#8b8175] mt-2">

                                    Quantity: x{{ $item->quantity }}

                                </p>

                            </div>

                            <h3 class="number-font text-lg md:text-xl xl:text-2xl text-[#1f1f1f]">

                                {{ number_format($item->price * $item->quantity, 2) }}<span class="text-[6px] sm:text-[8px]">SAR</span>

                            </h3>

                        </div>
                    @endforeach

                </div>

            </div>

        @empty

            <div class="p-10 text-center text-[#8b8175]">

                No orders yet.

            </div>
        @endforelse

    </div>

@endsection
