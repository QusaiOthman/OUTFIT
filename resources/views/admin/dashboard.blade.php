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

        <p class="uppercase tracking-[4px] text-[#9c8772] text-sm mb-3">
            Admin Dashboard
        </p>

        <h1 class="hero-title text-4xl md:text-5xl xl:text-6xl leading-none text-[#1f1f1f] break-words">
            Welcome Back,
            {{ Auth::user()->name }}
        </h1>

    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

        <!-- Products -->
        <div class="bg-white rounded-[30px] p-5 md:p-6 xl:p-8 border border-[#ece5dc]">

            <p class="uppercase tracking-[4px] text-[#9c8772] text-xs mb-5">
                Products
            </p>

            <h2 class="number-font text-3xl md:text-4xl xl:text-5xl text-[#1f1f1f]">
                {{ $productsCount }}
            </h2>

        </div>

        <!-- Categories -->
        <div class="bg-white rounded-[30px] p-5 md:p-6 xl:p-8 border border-[#ece5dc]">

            <p class="uppercase tracking-[4px] text-[#9c8772] text-xs mb-5">
                Categories
            </p>

            <h2 class="number-font text-3xl md:text-4xl xl:text-5xl text-[#1f1f1f]">
                {{ $categoriesCount }}
            </h2>

        </div>

        <!-- Orders -->
        <div class="bg-white rounded-[30px] p-5 md:p-6 xl:p-8 border border-[#ece5dc]">

            <p class="uppercase tracking-[4px] text-[#9c8772] text-xs mb-5">
                Orders
            </p>

            <h2 class="number-font text-3xl md:text-4xl xl:text-5xl text-[#1f1f1f]">
                {{ $ordersCount }}
            </h2>

        </div>

        <!-- Users -->
        <div class="bg-[#181818] rounded-[30px] p-5 md:p-6 xl:p-8 text-white">

            <p class="uppercase tracking-[4px] text-gray-400 text-xs mb-5">
                Users
            </p>

            <h2 class="number-font text-3xl md:text-4xl xl:text-5xl">
                {{ $usersCount }}
            </h2>

        </div>

    </div>

    <!-- Revenue Stats -->
    <div class="grid grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10 gap-6 mb-10">

        <!-- Total Revenue -->
        <div class="bg-[#181818] rounded-[30px] p-5 md:p-6 xl:p-8 text-white">

            <p class="uppercase tracking-[4px] text-gray-400 text-xs mb-5">
                Total Revenue
            </p>

            <h2 class="number-font text-3xl md:text-4xl xl:text-5xl">

                {{ number_format($totalRevenue, 2) }}<span class="text-[8px] sm:text-[10px]">SAR</span>

            </h2>

        </div>

        <!-- Monthly Revenue -->
        <div class="bg-white rounded-[30px] p-5 md:p-6 xl:p-8 border border-[#ece5dc]">

            <p class="uppercase tracking-[4px] text-[#9c8772] text-xs mb-5">
                Monthly Revenue
            </p>

            <h2 class="number-font text-3xl md:text-4xl xl:text-5xl text-[#1f1f1f]">

                {{ number_format($monthlyRevenue, 2) }}<span class="text-[8px] sm:text-[10px]">SAR</span>

            </h2>

        </div>

        <!-- Today Revenue -->
        <div class="bg-white rounded-[30px] p-5 md:p-6 xl:p-8 border border-[#ece5dc]">

            <p class="uppercase tracking-[4px] text-[#9c8772] text-xs mb-5">
                Today Revenue
            </p>

            <h2 class="number-font text-3xl md:text-4xl xl:text-5xl text-[#1f1f1f]">

                {{ number_format($todayRevenue, 2) }}<span class="text-[8px] sm:text-[10px]">SAR</span>

            </h2>

        </div>

    </div>
    <!-- Revenue Chart -->
    <div class="bg-white border border-[#ece5dc] rounded-[32px] p-5 md:p-6 xl:p-8 mb-10">

        <div class="mb-8">

            <p class="uppercase tracking-[4px] text-[#9c8772] text-xs mb-3">

                Analytics

            </p>

            <h2 class="hero-title text-2xl md:text-3xl xl:text-4xl text-[#1f1f1f]">

                Monthly Revenue

            </h2>

        </div>

        <div class="relative h-[250px] md:h-[400px]">
            <canvas id="revenueChart"></canvas>
        </div>

    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">

        <a href="{{ route('admin.products.create') }}"
            class="bg-white rounded-[30px] p-5 md:p-6 xl:p-8 border border-[#ece5dc] hover:-translate-y-1 transition duration-300">

            <p class="uppercase tracking-[4px] text-[#9c8772] text-xs mb-3">
                Products
            </p>

            <h2 class="hero-title text-2xl md:text-3xl xl:text-4xl text-[#1f1f1f] mb-3">
                Add Product
            </h2>

            <p class="section-description-font text-[#6f675d]">
                Create and publish a new fashion product
            </p>

        </a>

        <a href="{{ route('categories.create') }}"
            class="bg-white rounded-[30px] p-5 md:p-6 xl:p-8 border border-[#ece5dc] hover:-translate-y-1 transition duration-300">

            <p class="uppercase tracking-[4px] text-[#9c8772] text-xs mb-3">
                Categories
            </p>

            <h2 class="hero-title text-2xl md:text-3xl xl:text-4xl text-[#1f1f1f] mb-3">
                Add Category
            </h2>

            <p class="section-description-font text-[#6f675d]">
                Organize products into collections
            </p>

        </a>

        <a href="{{ route('admin.orders') }}"
            class="bg-[#181818] rounded-[30px] p-5 md:p-6 xl:p-8 text-white hover:-translate-y-1 transition duration-300">

            <p class="uppercase tracking-[4px] text-gray-400 text-xs mb-3">
                Orders
            </p>

            <h2 class="hero-title text-2xl md:text-3xl xl:text-4xl mb-3">
                Manage Orders
            </h2>

            <p class="section-description-font text-gray-300">
                Review customer purchases and status
            </p>

        </a>

    </div>
    <!-- Latest Users -->
    <div class="bg-white rounded-[32px] border border-[#ece5dc] overflow-hidden mb-10">

        <div class="px-8 py-6 border-b border-[#ece5dc]">

            <p class="uppercase tracking-[4px] text-[#9c8772] text-xs mb-3">
                Community
            </p>

            <h2 class="hero-title text-2xl md:text-3xl xl:text-4xl text-[#1f1f1f]">

                Latest Users

            </h2>

        </div>

        <div class="divide-y divide-[#f1ebe4]">

            @forelse ($latestUsers as $user)
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 px-6 md:px-8 py-6">

                    <div class="flex items-center gap-4">

                        <div
                            class="w-16 h-16 rounded-full bg-black text-white flex items-center justify-center text-xl font-semibold">

                            {{ strtoupper(substr($user->name, 0, 1)) }}

                        </div>

                        <div class="min-w-0">

                            <h3 class="text-xl text-[#1f1f1f] font-semibold">

                                {{ $user->name }}

                            </h3>

                            <p class="text-[#8b8175] mt-1 truncate">

                                {{ $user->email }}

                            </p>

                        </div>

                    </div>

                    <div class="text-right">

                        <p class="text-[#8b8175] text-sm mb-1">

                            Joined

                        </p>

                        <h3 class="text-lg text-[#1f1f1f]">

                            {{ $user->created_at->format('d M Y') }}

                        </h3>

                    </div>

                </div>

            @empty

                <div class="px-8 py-16 text-center text-[#8b8175]">

                    No users yet

                </div>
            @endforelse

        </div>

    </div>
    <!-- Orders Analytics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

        <!-- Pending -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-[30px] p-5 md:p-6 xl:p-8">

            <p class="uppercase tracking-[4px] text-yellow-600 text-xs mb-5">
                Pending
            </p>

            <h2 class="number-font text-3xl md:text-4xl xl:text-5xl text-yellow-700">

                {{ $pendingOrders }}

            </h2>

        </div>

        <!-- Paid -->
        <div class="bg-blue-50 border border-blue-200 rounded-[30px] p-5 md:p-6 xl:p-8">

            <p class="uppercase tracking-[4px] text-blue-600 text-xs mb-5">
                Paid
            </p>

            <h2 class="number-font text-3xl md:text-4xl xl:text-5xl text-blue-700">

                {{ $paidOrders }}

            </h2>

        </div>

        <!-- Delivered -->
        <div class="bg-green-50 border border-green-200 rounded-[30px] p-5 md:p-6 xl:p-8">

            <p class="uppercase tracking-[4px] text-green-600 text-xs mb-5">
                Delivered
            </p>

            <h2 class="number-font text-3xl md:text-4xl xl:text-5xl text-green-700">

                {{ $deliveredOrders }}

            </h2>

        </div>

        <!-- Cancelled -->
        <div class="bg-red-50 border border-red-200 rounded-[30px] p-5 md:p-6 xl:p-8">

            <p class="uppercase tracking-[4px] text-red-600 text-xs mb-5">
                Cancelled
            </p>

            <h2 class="number-font text-3xl md:text-4xl xl:text-5xl text-red-700">

                {{ $cancelledOrders }}

            </h2>

        </div>

    </div>

    <!-- Low Stock Products -->
    <div class="bg-white rounded-[32px] border border-[#ece5dc] overflow-hidden mb-10">

        <div class="px-8 py-6 border-b border-[#ece5dc] flex items-center justify-between">

            <div>

                <p class="uppercase tracking-[4px] text-[#9c8772] text-xs mb-3">
                    Inventory Alerts
                </p>

                <h2 class="hero-title text-2xl md:text-3xl xl:text-4xl text-[#1f1f1f]">

                    Low Stock Products

                </h2>

            </div>

            <div class="w-4 h-4 rounded-full bg-red-500 animate-pulse"></div>

        </div>

        <div class="divide-y divide-[#f1ebe4]">

            @forelse ($lowStockProducts as $product)
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 px-6 md:px-8 py-6">

                    <div class="flex items-center gap-5">

                        @if ($product->images->first())
                            <img src="{{ asset('storage/' . $product->images->first()->image) }}"
                                class="w-16 h-16 md:w-20 md:h-20 rounded-2xl object-cover">
                        @endif

                        <div>

                            <h3 class="text-xl text-[#1f1f1f] font-semibold">

                                {{ $product->name }}

                            </h3>

                            <p class="text-[#8b8175] mt-1">

                                {{ $product->category->name ?? 'No Category' }}

                            </p>

                        </div>

                    </div>

                    @if ($product->stock <= 0)
                        <span class="px-5 py-2 rounded-full bg-red-100 text-red-600 text-sm font-medium">

                            Out Of Stock

                        </span>
                    @else
                        <span class="px-5 py-2 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">

                            {{ $product->stock }} Left

                        </span>
                    @endif

                </div>

            @empty

                <div class="px-8 py-16 text-center text-[#8b8175]">

                    No low stock products

                </div>
            @endforelse

        </div>

    </div>
    <!-- Top Selling Products -->
    <div class="bg-[#181818] rounded-[32px] overflow-hidden mb-10">

        <div class="px-8 py-6 border-b border-white/10">

            <p class="uppercase tracking-[4px] text-gray-500 text-xs mb-3">
                Best Performance
            </p>

            <h2 class="hero-title text-2xl md:text-3xl xl:text-4xl text-white">

                Top Selling Products

            </h2>

        </div>

        <div class="divide-y divide-white/10">

            @forelse ($topProducts as $product)
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 px-6 md:px-8 py-6">

                    <div class="flex items-center gap-5">

                        @if ($product->images->first())
                            <img src="{{ asset('storage/' . $product->images->first()->image) }}"
                                class="w-16 h-16 md:w-20 md:h-20 rounded-2xl object-cover">
                        @endif

                        <div>

                            <h3 class="text-xl text-white font-semibold">

                                {{ $product->name }}

                            </h3>

                            <p class="text-gray-400 mt-1">

                                {{ $product->category->name ?? 'No Category' }}

                            </p>

                        </div>

                    </div>

                    <div class="text-right">

                        <p class="text-gray-400 text-sm mb-1">
                            Orders
                        </p>

                        <h3 class="text-3xl text-white hero-title">

                            {{ $product->order_items_sum_quantity ?? 0 }}

                        </h3>

                    </div>

                </div>

            @empty

                <div class="px-8 py-16 text-center text-gray-500">

                    No sales yet

                </div>
            @endforelse

        </div>

    </div>




    <!-- Recent Orders -->
    <div class="bg-white rounded-[32px] border border-[#ece5dc] overflow-hidden">

        <div class="px-8 py-6 border-b border-[#ece5dc]">

            <h2 class="hero-title text-2xl md:text-3xl xl:text-4xl text-[#1f1f1f]">
                Recent Orders
            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full min-w-[600px]">

                <thead class="bg-[#f8f4ef]">

                    <tr>

                        <th class="text-left px-8 py-5 text-sm tracking-[3px] uppercase text-[#9c8772]">
                            Customer
                        </th>

                        <th class="text-left px-8 py-5 text-sm tracking-[3px] uppercase text-[#9c8772]">
                            Total
                        </th>

                        <th class="text-left px-8 py-5 text-sm tracking-[3px] uppercase text-[#9c8772]">
                            Status
                        </th>

                        <th class="text-left px-8 py-5 text-sm tracking-[3px] uppercase text-[#9c8772]">
                            Date
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($recentOrders as $order)
                        <tr class="border-t border-[#f1ebe4]">

                            <td class="px-8 py-6 text-[#1f1f1f] font-medium">
                                {{ $order->user->name }}
                            </td>

                            <td class="px-8 py-6 text-[#6f675d]">
                                {{ number_format($order->total, 2) }}<span class="text-[6px] sm:text-[8px]">SAR</span>
                            </td>

                            <td class="px-8 py-6">

                                <span class="px-4 py-2 rounded-full bg-[#f6f1ea] text-[#8b7355] text-sm">

                                    {{ $order->status }}

                                </span>

                            </td>

                            <td class="px-8 py-6 text-[#6f675d]">
                                {{ $order->created_at->format('d M Y') }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="text-center py-16 text-[#8b8175]">

                                No orders yet

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const ctx = document.getElementById('revenueChart');

            if (!ctx) return;

            new Chart(ctx, {

                type: 'line',

                data: {

                    labels: @json($months),

                    datasets: [{

                        label: 'Revenue',

                        data: @json($monthlyRevenueChart),

                        borderColor: '#111111',

                        backgroundColor: 'rgba(17,17,17,0.08)',

                        borderWidth: 3,

                        tension: 0.4,

                        fill: true,

                        pointBackgroundColor: '#111111',

                        pointRadius: 5

                    }]

                },

                options: {

                    responsive: true,
                    maintainAspectRatio: false,

                    plugins: {

                        legend: {

                            display: false

                        }

                    },

                    scales: {

                        y: {

                            beginAtZero: true

                        }

                    }

                }

            });

        });
    </script>
@endsection
