@extends('admin.layout')

@section('content')
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=BJCree:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&display=swap"rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@1,100..900&display=swap" rel="stylesheet">


    <div class="mb-10">

        <p class="uppercase tracking-[5px] text-[#b08b68] text-xs mb-3">
            Admin Orders
        </p>

        <h1 class="hero-title text-4xl md:text-5xl xl:text-[70px] leading-none text-[#1a1a1a]">
            Orders
        </h1>

    </div>


    <!-- Analytics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

        <!-- Total Orders -->
        <div class="bg-[#181818] rounded-[30px] p-5 md:p-6 xl:p-8 text-white">

            <p class="uppercase tracking-[4px] text-gray-400 text-xs mb-4">
                Orders
            </p>

            <h2 class="number-font text-3xl md:text-4xl xl:text-5xl">

                {{ $totalOrders }}

            </h2>

        </div>

        <!-- Revenue -->
        <div class="bg-[#181818] rounded-[30px] p-5 md:p-6 xl:p-8 text-white">

            <p class="uppercase tracking-[4px] text-gray-400 text-xs mb-4">
                Revenue
            </p>

            <h2 class="number-font text-3xl md:text-4xl xl:text-5xl">

                {{ number_format($totalRevenue, 0) }}<span class="text-[8px] sm:text-[10px]">SAR</span>

            </h2>

        </div>

        <!-- Average -->
        <div class="bg-white border border-[#ece5dc] rounded-[30px] p-5 md:p-6 xl:p-8">

            <p class="uppercase tracking-[4px] text-[#9c8772] text-xs mb-4">
                Avg Order
            </p>

            <h2 class="number-font text-3xl md:text-4xl xl:text-5xl text-[#1f1f1f]">

                {{ number_format($averageOrder, 0) }}<span class="text-[8px] sm:text-[10px]">SAR</span>

            </h2>

        </div>

        <!-- Pending -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-[30px] p-5 md:p-6 xl:p-8">

            <p class="uppercase tracking-[4px] text-yellow-700 text-xs mb-4">
                Pending
            </p>

            <h2 class="number-font text-3xl md:text-4xl xl:text-5xl text-yellow-700">

                {{ $pendingOrders }}

            </h2>

        </div>

    </div>



    <!-- Second Row Analytics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

        <!-- Paid -->
        <div class="bg-blue-50 border border-blue-200 rounded-[30px] p-5 md:p-6 xl:p-8">

            <p class="uppercase tracking-[4px] text-blue-700 text-xs mb-4">
                Paid
            </p>

            <h2 class="number-font text-3xl md:text-4xl xl:text-5xl text-blue-700">

                {{ $paidOrders }}

            </h2>

        </div>

        <!-- Shipped -->
        <div class="bg-purple-50 border border-purple-200 rounded-[30px] p-5 md:p-6 xl:p-8">

            <p class="uppercase tracking-[4px] text-purple-700 text-xs mb-4">
                Shipped
            </p>

            <h2 class="number-font text-3xl md:text-4xl xl:text-5xl text-purple-700">

                {{ $shippedOrders }}

            </h2>

        </div>

        <!-- Delivered -->
        <div class="bg-green-50 border border-green-200 rounded-[30px] p-5 md:p-6 xl:p-8">

            <p class="uppercase tracking-[4px] text-green-700 text-xs mb-4">
                Delivered
            </p>

            <h2 class="number-font text-3xl md:text-4xl xl:text-5xl text-green-700">

                {{ $deliveredOrders }}

            </h2>

        </div>

        <!-- Cancelled -->
        <div class="bg-red-50 border border-red-200 rounded-[30px] p-5 md:p-6 xl:p-8">

            <p class="uppercase tracking-[4px] text-red-700 text-xs mb-4">
                Cancelled
            </p>

            <h2 class="number-font text-3xl md:text-4xl xl:text-5xl text-red-700">

                {{ $cancelledOrders }}

            </h2>

        </div>

    </div>

    <!-- FILTER BAR -->
    <div class="mt-5 mb-8">

        <form method="GET" action="{{ route('admin.orders') }}"
            class="w-full flex flex-col lg:flex-row lg:flex-wrap gap-3 rounded-[24px] hero-title">

            <!-- Search -->
            <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                class="w-full lg:flex-1 min-w-0 h-[38px] rounded-2xl border border-black/5 bg-white/70 px-4 text-sm placeholder:text-gray-400 focus:ring-0 focus:border-none">

            <!-- Status -->
            <select name="status"
                class="h-[38px] rounded-2xl border border-black/5 bg-white/70 px-4 text-sm w-full lg:w-auto min-w-0 focus:ring-0 focus:border-none cursor-pointer">

                <option value="">
                    Status
                </option>

                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>
                    Paid
                </option>

                <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>
                    Shipped
                </option>

                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>
                    Delivered
                </option>

                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                    Cancelled
                </option>

            </select>

            <!-- Date -->
            <select name="date"
                class="h-[38px] rounded-2xl border border-black/5 bg-white/70 px-4 text-sm w-full lg:w-auto min-w-0 focus:ring-0 focus:border-none cursor-pointer">

                <option value="">
                    Date
                </option>

                <option value="newest" {{ request('date') == 'newest' ? 'selected' : '' }}>
                    Newest
                </option>

                <option value="oldest" {{ request('date') == 'oldest' ? 'selected' : '' }}>
                    Oldest
                </option>

            </select>

            <!-- Total -->
            <select name="total"
                class="h-[38px] rounded-2xl border border-black/5 bg-white/70 px-4 text-sm w-full lg:w-auto min-w-0 focus:ring-0 focus:border-none cursor-pointer">

                <option value="">
                    Total
                </option>

                <option value="high-low" {{ request('total') == 'high-low' ? 'selected' : '' }}>
                    High → Low
                </option>

                <option value="low-high" {{ request('total') == 'low-high' ? 'selected' : '' }}>
                    Low → High
                </option>

            </select>

            <!-- Filter -->
            <button type="submit"
                class="h-[40px] px-4 rounded-2xl bg-black text-white text-sm font-medium hover:bg-neutral-800 transition">

                Filter

            </button>

            <!-- Reset -->
            <a href="{{ route('admin.orders') }}" class="text-sm text-[#6f675d] hover:text-black transition duration-300">

                Reset

            </a>

        </form>

    </div>

    <div class="space-y-8">

        @foreach ($orders as $order)
            <div class="bg-white border border-[#ece5dc] rounded-[24px] md:rounded-[36px] overflow-hidden">

                <!-- Header -->
                <div
                    class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 p-5 md:p-8 border-b border-[#f1ebe4]">

                    <!-- Order Info -->
                    <div>

                        <p class="uppercase tracking-[4px] text-[#9c8772] text-xs mb-3">
                            Order #{{ $order->id }}
                        </p>

                        <h2 class="hero-title text-2xl md:text-3xl xl:text-4xl text-[#1f1f1f] mb-4">
                            {{ $order->user->name }}
                        </h2>

                        <p class="text-[#6f675d] break-all">
                            {{ $order->user->email }}
                        </p>
                        <div class="mt-5">

                            @if ($order->status == 'pending')
                                <span class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">

                                    Pending

                                </span>
                            @elseif($order->status == 'paid')
                                <span class="px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-sm font-medium">

                                    Paid

                                </span>
                            @elseif($order->status == 'shipped')
                                <span class="px-4 py-2 rounded-full bg-purple-100 text-purple-700 text-sm font-medium">

                                    Shipped

                                </span>
                            @elseif($order->status == 'delivered')
                                <span class="px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-medium">

                                    Delivered

                                </span>
                            @elseif($order->status == 'cancelled')
                                <span class="px-4 py-2 rounded-full bg-red-100 text-red-700 text-sm font-medium">

                                    Cancelled

                                </span>
                            @endif

                        </div>

                    </div>


                    <!-- Status -->
                    <form action="{{ route('admin.orders.status', $order->id) }}" method="POST"
                        class="flex flex-col sm:flex-row gap-3">

                        @csrf

                        <select name="status"
                            class="h-[52px] rounded-2xl border border-[#ece5dc] bg-[#f8f4ef] px-5 focus:ring-0 focus:border-black/20">

                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>

                                Pending

                            </option>

                            <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>

                                Paid

                            </option>

                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>

                                Shipped

                            </option>

                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>

                                Delivered

                            </option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>

                                Cancelled

                            </option>

                        </select>

                        <button type="submit"
                            class="h-[52px] px-6 rounded-2xl bg-black text-white hover:bg-neutral-800 transition">

                            Update

                        </button>


                    </form>

                    <form action="{{ route('admin.orders.delete', $order->id) }}" method="POST"
                        onsubmit="return confirmDelete(event)">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="h-[52px] px-6 rounded-2xl bg-red-600 text-white hover:bg-red-700 transition">

                            Delete Order

                        </button>

                    </form>


                </div>


                <!-- Items -->
                <div class="p-5 md:p-6 xl:p-8">

                    <div class="grid gap-5">
                        <!-- Order Details -->
                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-5 p-5 md:p-8 border-b border-[#f1ebe4]">
                            <!-- Items Count -->
                            <div class="bg-[#f8f4ef] rounded-3xl p-5">

                                <p class="text-xs uppercase tracking-[3px] text-[#9c8772] mb-3">
                                    Items
                                </p>

                                <h3 class="hero-title text-3xl text-[#1f1f1f]">

                                    {{ $order->items->sum('quantity') }}

                                </h3>

                            </div>

                            <!-- Subtotal -->
                            <div class="bg-[#f8f4ef] rounded-3xl p-5">

                                <p class="text-xs uppercase tracking-[3px] text-[#9c8772] mb-3">
                                    Subtotal
                                </p>

                                <h3 class="number-font text-2xl md:text-3xl text-[#1f1f1f]">

                                    {{ number_format($order->subtotal, 2) }}<span class="text-[6px] sm:text-[8px]">SAR</span>

                                </h3>

                            </div>

                            <!-- Shipping -->
                            <div class="bg-[#f8f4ef] rounded-3xl p-5">

                                <p class="text-xs uppercase tracking-[3px] text-[#9c8772] mb-3">
                                    Shipping
                                </p>

                                <h3 class="number-font text-2xl md:text-3xl text-[#1f1f1f]">

                                    @if ($order->shipping == 0)
                                        Free
                                    @else
                                        {{ number_format($order->shipping, 2) }}<span class="text-[6px] sm:text-[8px]">SAR</span>
                                    @endif

                                </h3>

                            </div>

                            <!-- Total -->
                            <div class="bg-[#111111] rounded-3xl p-5">

                                <p class="text-xs uppercase tracking-[3px] text-white/60 mb-3">
                                    Total
                                </p>

                                <h3 class="number-font text-3xl text-white">

                                    {{ number_format($order->total, 2) }}<span class="text-[8px] sm:text-[10px]">SAR</span>

                                </h3>

                            </div>

                            <!-- Date -->
                            <div class="bg-[#f8f4ef] rounded-3xl p-5">

                                <p class="text-xs uppercase tracking-[3px] text-[#9c8772] mb-3">
                                    Date
                                </p>

                                <h3 class="number-font text-xl text-black">
                                    {{ $order->created_at->format('d M Y') }}

                                </h3>

                            </div>

                        </div>

                        @foreach ($order->items as $item)
                            <div
                                class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-[#f8f4ef] rounded-[28px] p-5">

                                <!-- Product -->
                                <div class="flex items-center gap-5">

                                    @if ($item->product && $item->product->images->first())
                                        <img src="{{ asset('storage/' . $item->product->images->first()->image) }}"
                                            class="w-16 h-20 md:w-20 md:h-24 rounded-2xl object-cover">
                                    @endif

                                    <div>

                                        <h3 class="text-lg font-semibold text-[#1f1f1f] mb-2 break-words">

                                            {{ $item->product->name ?? 'Deleted Product' }}

                                        </h3>

                                        <p class="text-[#8b8175] text-sm">

                                            Quantity: x{{ $item->quantity }}

                                        </p>

                                    </div>

                                </div>

                                <!-- Price -->
                                <div class="text-right">

                                    <p class="text-sm text-[#8b8175] mb-2">
                                        Total
                                    </p>

                                    <h3 class="number-font text-2xl md:text-3xl text-[#1f1f1f]">

                                        {{ number_format($item->price * $item->quantity, 2) }}<span class="text-[6px] sm:text-[8px]">SAR</span>

                                    </h3>

                                </div>

                            </div>
                        @endforeach

                    </div>

                </div>

            </div>
        @endforeach

    </div>
    <script>
        function confirmDelete(event) {

            event.preventDefault();

            let confirmAction = confirm(

                "Are you sure you want to delete this order?"

            );

            if (confirmAction) {

                event.target.submit();
            }

            return false;
        }
    </script>
@endsection
