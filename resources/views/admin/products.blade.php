@extends('admin.layout')

@section('content')
    <div class="mb-10">

        <p class="uppercase tracking-[4px] text-[#9c8772] text-sm mb-3">
            Admin Products
        </p>

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <h1 class="hero-title text-4xl md:text-5xl xl:text-6xl text-[#1f1f1f]">
                Products
            </h1>

            <a href="{{ route('admin.products.create') }}"
                class="hero-title h-[50px] md:h-[58px] px-6 md:px-8 rounded-2xl bg-[#181818] text-white flex items-center justify-center hover:bg-black transition duration-300">

                Add Product

            </a>

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
    <!-- Analytics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

        <!-- Total Products -->
        <div class="bg-[#181818] rounded-[30px] p-8 text-white">

            <p class="uppercase tracking-[4px] text-gray-400 text-xs mb-4">
                Products
            </p>

            <h2 class="number-font text-5xl">

                {{ $totalProducts }}

            </h2>

        </div>

        <!-- Total Stock -->
        <div class="bg-white border border-[#ece5dc] rounded-[30px] p-8">

            <p class="uppercase tracking-[4px] text-[#9c8772] text-xs mb-4">
                Total Stock
            </p>

            <h2 class="number-font text-5xl text-[#1f1f1f]">

                {{ $totalStock }}

            </h2>

        </div>

        <!-- Total Sales -->
        <div class="bg-white border border-[#ece5dc] rounded-[30px] p-8">

            <p class="uppercase tracking-[4px] text-[#9c8772] text-xs mb-4">
                Total Sales
            </p>

            <h2 class="number-font text-5xl text-[#1f1f1f]">

                {{ $totalSales }}

            </h2>

        </div>

        <!-- Revenue -->
        <div class="bg-[#181818] rounded-[30px] p-8 text-white">

            <p class="uppercase tracking-[4px] text-gray-400 text-xs mb-4">
                Revenue
            </p>

            <h2 class="number-font text-5xl">

                {{ number_format($totalRevenue, 0) }}<span class="text-[8px] sm:text-[10px]">SAR</span>

            </h2>

        </div>

    </div>

    <!-- Second Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

        <!-- Low Stock -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-[30px] p-8">

            <p class="uppercase tracking-[4px] text-yellow-700 text-xs mb-4">
                Low Stock
            </p>

            <h2 class="number-font text-5xl text-yellow-700">

                {{ $lowStock }}

            </h2>

        </div>

        <!-- Out Of Stock -->
        <div class="bg-red-50 border border-red-200 rounded-[30px] p-8">

            <p class="uppercase tracking-[4px] text-red-700 text-xs mb-4">
                Out Of Stock
            </p>

            <h2 class="number-font text-5xl text-red-700">

                {{ $outOfStock }}

            </h2>

        </div>

        <!-- Categories -->
        <div class="bg-white border border-[#ece5dc] rounded-[30px] p-8">

            <p class="uppercase tracking-[4px] text-[#9c8772] text-xs mb-4">
                Categories
            </p>

            <h2 class="number-font text-5xl text-[#1f1f1f]">

                {{ $categoriesCount }}

            </h2>

        </div>

        <!-- Average Price -->
        <div class="bg-white border border-[#ece5dc] rounded-[30px] p-8">

            <p class="uppercase tracking-[4px] text-[#9c8772] text-xs mb-4">
                Avg Price
            </p>

            <h2 class="number-font text-5xl text-[#1f1f1f]">

                {{ number_format($averagePrice, 0) }}<span class="text-[8px] sm:text-[10px]">SAR</span>

            </h2>

        </div>

    </div>

    <!-- Best Seller -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-10">

        <!-- Best Seller -->
        <div class="bg-white border border-[#ece5dc] rounded-[30px] p-8">

            <p class="uppercase tracking-[4px] text-[#9c8772] text-xs mb-5">
                Best Seller
            </p>

            @if ($bestSeller)
                <div class="flex flex-col sm:flex-row sm:items-center gap-5">

                    @if ($bestSeller && $bestSeller->images->first())
                        <img src="{{ asset('storage/' . $bestSeller->images->first()->image) }}"
                            class="w-20 h-20 md:w-24 md:h-24 rounded-2xl object-cover">
                    @endif
                    <div>

                        <h2 class="hero-title text-3xl text-[#1f1f1f] mb-2">

                            {{ $bestSeller->name }}

                        </h2>

                        <p class="text-[#8b8175]">

                            {{ $bestSeller->order_items_count }} Sales

                        </p>

                    </div>

                </div>
            @endif

        </div>

        <!-- Highest Revenue -->
        <div class="bg-[#181818] rounded-[30px] p-8 text-white">

            <p class="uppercase tracking-[4px] text-gray-400 text-xs mb-5">
                Highest Revenue
            </p>

            @if ($highestRevenueProduct)
                <div class="flex flex-col sm:flex-row sm:items-center gap-5">

                    @if ($highestRevenueProduct && $highestRevenueProduct->images->first())
                        <img src="{{ asset('storage/' . $highestRevenueProduct->images->first()->image) }}"
                            class="w-20 h-20 md:w-24 md:h-24 rounded-2xl object-cover">
                    @endif

                    <div>

                        <h2 class="hero-title text-3xl mb-2">

                            {{ $highestRevenueProduct->name }}

                        </h2>

                        <p class="number-font text-gray-400">

                            
                            {{ number_format(
                                $highestRevenueProduct->orderItems->sum(function ($item) {
                                    return $item->price * $item->quantity;
                                }),
                                0,
                            ) }}<span class="text-[8px] sm:text-[10px]">SAR</span>

                        </p>

                    </div>

                </div>
            @endif

        </div>

    </div>

    <!-- FILTER BAR -->
    <div class="mt-5 mb-8">

        <form method="GET" action="{{ route('admin.products') }}"
            class="w-full flex flex-col lg:flex-row lg:flex-wrap gap-3 rounded-[24px] hero-title">

            <!-- Search -->
            <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                class="w-full lg:flex-1 min-w-0
                   h-[38px]
                   rounded-2xl
                   border border-black/5
                   bg-white/70
                   px-4
                   text-sm
                   placeholder:text-gray-400
                   focus:ring-0
                   focus:border-none">

            <!-- Category -->
            <select name="category"
                class="h-[38px]
                   rounded-2xl
                   border border-black/5
                   bg-white/70
                   px-4
                   text-sm
                   w-full lg:w-auto min-w-0
                   focus:ring-0
                   focus:border-none
                   cursor-pointer">

                <option value="">
                    Category
                </option>

                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>

                        {{ $cat->name }}

                    </option>
                @endforeach

            </select>

            <!-- Gender -->
            <select name="gender"
                class="h-[38px]
                   rounded-2xl
                   border border-black/5
                   bg-white/70
                   px-4
                   text-sm
                   min-w-[150px]
                   focus:ring-0
                   focus:border-none
                   cursor-pointer">

                <option value="">
                    Gender
                </option>

                <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>

                    Male

                </option>

                <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>

                    Female

                </option>

                <option value="unisex" {{ request('gender') == 'unisex' ? 'selected' : '' }}>

                    Unisex

                </option>

            </select>
            <!-- Stock -->
            <select name="stock"
                class="h-[38px] rounded-2xl border border-black/5 bg-white/70 px-4 text-sm w-full lg:w-auto min-w-0 focus:ring-0 focus:border-none cursor-pointer">

                <option value="">
                    Stock
                </option>

                <option value="in" {{ request('stock') == 'in' ? 'selected' : '' }}>

                    In Stock

                </option>

                <option value="low" {{ request('stock') == 'low' ? 'selected' : '' }}>

                    Low Stock

                </option>

                <option value="out" {{ request('stock') == 'out' ? 'selected' : '' }}>

                    Out Of Stock

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

            <!-- Price -->
            <select name="price"
                class="h-[38px] rounded-2xl border border-black/5 bg-white/70 px-4 text-sm w-full lg:w-auto min-w-0 focus:ring-0 focus:border-none cursor-pointer">

                <option value="">
                    Price
                </option>

                <option value="low-high" {{ request('price') == 'low-high' ? 'selected' : '' }}>

                    Low → High

                </option>

                <option value="high-low" {{ request('price') == 'high-low' ? 'selected' : '' }}>

                    High → Low

                </option>

            </select>

            <!-- Filter -->
            <button type="submit"
                class="h-[40px]
                   px-4
                   rounded-2xl
                   bg-black
                   text-white
                   text-sm
                   font-medium
                   hover:bg-neutral-800
                   transition">

                Filter

            </button>

            <!-- Reset -->
            <a href="{{ route('admin.products') }}"
                class="text-sm text-[#6f675d]
                   hover:text-black
                   transition duration-300">

                Reset

            </a>

        </form>

    </div>

    <!-- Table -->
    <div class="bg-white rounded-[32px] border border-[#ece5dc] overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full min-w-[1100px]">

                <thead class="bg-[#f8f4ef]">

                    <tr>

                        <th class="px-8 py-5 text-left text-sm uppercase tracking-[3px] text-[#9c8772]">
                            Product
                        </th>

                        <th class="px-8 py-5 text-left text-sm uppercase tracking-[3px] text-[#9c8772]">
                            Category
                        </th>

                        <th class="px-8 py-5 text-left text-sm uppercase tracking-[3px] text-[#9c8772]">
                            Gender
                        </th>

                        <th class="px-8 py-5 text-left text-sm uppercase tracking-[3px] text-[#9c8772]">
                            Stock
                        </th>
                        <th class="px-8 py-5 text-left text-sm uppercase tracking-[3px] text-[#9c8772]">
                            Sold
                        </th>

                        <th class="px-8 py-5 text-left text-sm uppercase tracking-[3px] text-[#9c8772]">
                            Price
                        </th>

                        <th class="px-8 py-5 text-left text-sm uppercase tracking-[3px] text-[#9c8772]">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($products as $product)
                        <tr
                            class="border-t border-[#f1ebe4] 
                            @if ($product->stock <= 0) bg-red-50
                            @elseif($product->stock <= 5) bg-yellow-50 @endif">

                            <!-- Product -->
                            <td class="px-8 py-6">

                                <div class="flex items-center gap-4 min-w-[250px]">
                                    @if ($product->images->first())
                                        <a href="{{ route('products.show', $product->id) }}">
                                            <img src="{{ asset('storage/' . $product->images->first()->image) }}"
                                                class="w-20 h-24 object-cover rounded-2xl">
                                        </a>
                                    @endif
                                    <div>

                                        <h3 class="text-[#1f1f1f] font-semibold text-lg mb-1">
                                            {{ $product->name }}
                                        </h3>

                                        <p class="text-[#8b8175] text-sm line-clamp-1 max-w-[180px]">
                                            {{ $product->description }}
                                        </p>

                                    </div>

                                </div>

                            </td>

                            <!-- Category -->
                            <td class="px-8 py-6 text-[#6f675d]">

                                {{ $product->category ? $product->category->name : 'No Category' }}

                            </td>

                            <!-- Gender -->
                            <td class="px-8 py-6">

                                <span class="px-4 py-2 rounded-full bg-[#f6f1ea] text-[#8b7355] text-sm">

                                    {{ ucfirst($product->gender) }}

                                </span>

                            </td>

                            <!-- Stock -->
                            <td>

                                @if ($product->stock <= 0)
                                    <span class="px-4 py-2 rounded-full bg-red-100 text-red-600 text-sm font-medium">

                                        Out Of Stock

                                    </span>
                                @elseif($product->stock <= 5)
                                    <span class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">

                                        Low ({{ $product->stock }})

                                    </span>
                                @else
                                    <span class="px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-medium">

                                        {{ $product->stock }} In Stock

                                    </span>
                                @endif

                            </td>

                            <!-- Sold -->
                            <td class="px-8 py-6">

                                <span class="number-font px-4 py-2 rounded-full bg-[#f6f1ea] text-[#8b7355] text-sm">

                                    {{ $product->orderItems->sum('quantity') }}

                                </span>

                            </td>



                            <!-- Price -->
                            <td class="number-font px-8 py-6 text-[#1f1f1f] font-semibold">

                                {{ number_format($product->price, 2) }}<span class="text-[8px] sm:text-[10px]">SAR</span>

                            </td>

                            <!-- Actions -->
                            <td class="px-8 py-6">

                                <div class="flex flex-col xl:flex-row gap-2">

                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                        class="h-[42px] px-5 rounded-xl bg-[#181818] text-white flex items-center justify-center hover:bg-black transition">

                                        Edit

                                    </a>

                                    <form action="{{ route('admin.products.delete', $product->id) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="h-[42px] px-5 rounded-xl border border-red-200 text-red-500 hover:bg-red-50 transition">

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>
@endsection
