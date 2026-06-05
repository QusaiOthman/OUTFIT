<x-app-layout>


    <div class="bg-[#f3f0f8] min-h-screen">

        <!-- HERO -->
        <section class="relative h-[500px] sm:h-[620px] lg:h-[650px] overflow-hidden">

            <!-- Background -->
            <img src="/images/products-hero.jpg"
                class="absolute inset-0 w-full h-full object-cover object-[68%_top] sm:object-top">

            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/20"></div>

            <!-- Content -->
            <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-6 lg:px-10 h-full flex items-center">

                <div class="max-w-xl">

                    <p class="uppercase tracking-[6px] text-white/70 text-sm mb-6">
                        MODERN FASHION COLLECTION
                    </p>

                    <h1 class="hero-title text-white text-5xl sm:text-6xl md:text-8xl leading-[0.95]">
                        Discover<br>Your Style
                    </h1>

                    <p
                        class="section-description-font text-white/75 text-base sm:text-lg md:text-xl leading-relaxed max-w-xl mt-8">
                        Explore curated fashion pieces crafted with elegance,
                        confidence and timeless aesthetics
                    </p>

                </div>

            </div>

        </section>

        <!-- FILTER BAR -->
        <div class="top-[90px] z-40 mt-5 mb-1">
            <form method="GET" action="{{ route('products.index') }}"
                class="max-w-4xl mx-auto flex flex-col sm:flex-row flex-wrap items-center gap-2 sm:gap-3 px-4 py-3 rounded-[24px] hero-title">

                <!-- Search -->
                <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                    class="w-full sm:w-[220px] md:w-[260px] h-[40px] rounded-xl border border-black/5 bg-white/70 px-4 text-sm placeholder:text-gray-400 focus:ring-0 focus:border-black/10">

                <!-- Category -->
                <select name="category"
                    class="w-full sm:w-[150px] h-[40px] rounded-xl border border-black/5 bg-white/70 px-4 text-sm focus:ring-0 focus:border-black/10 cursor-pointer">

                    <option value="">Category</option>

                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach

                </select>

                <!-- Sort By -->
                <select name="sort"
                    class="w-full sm:w-[170px] h-[40px] rounded-xl border border-black/5 bg-white/70 px-4 text-sm focus:ring-0 focus:border-black/10 cursor-pointer">

                    <option value="">Sort By</option>

                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>
                        Newest
                    </option>

                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                        Oldest
                    </option>

                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>
                        Price: Low to High
                    </option>

                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                        Price: High to Low
                    </option>

                </select>

                <!-- Price Range -->
                <div class="flex w-full sm:w-auto gap-2">
                    <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}"
                        class="w-full sm:w-[90px] h-[40px] rounded-xl border border-black/5 bg-white/70 px-4 text-sm focus:ring-0 focus:border-black/10">

                    <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}"
                        class="w-full sm:w-[90px] h-[40px] rounded-xl border border-black/5 bg-white/70 px-4 text-sm focus:ring-0 focus:border-black/10">
                </div>
                <!-- Gender -->
                <select name="gender"
                    class="w-full sm:w-[140px] h-[40px] rounded-xl border border-black/5 bg-white/70 px-4 text-sm focus:ring-0 focus:border-black/10 cursor-pointer">

                    <option value="">Gender</option>

                    <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>

                    <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>

                    <option value="unisex" {{ request('gender') == 'unisex' ? 'selected' : '' }}>Unisex</option>

                </select>

                <!-- Filter -->
                <button type="submit"
                    class="w-full sm:w-auto h-[40px] px-5 rounded-xl bg-black text-white text-sm font-medium hover:bg-neutral-800 transition">

                    Filter

                </button>

                <!-- Reset -->
                <a href="{{ route('products.index') }}"
                    class="text-sm text-[#6f675d] hover:text-black transition duration-300">

                    Reset

                </a>

            </form>

        </div>

        <!-- PRODUCTS SECTION -->
        <section class="max-w-7xl mx-auto px-6 lg:px-10 py-20">

            <!-- Products Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-8">

                @if ($products->count())
                    @foreach ($products as $product)
                        <div
                            class="group relative h-[260px] sm:h-[320px] rounded-[30px] overflow-hidden hover:-translate-y-2 hover:shadow-[0_25px_60px_rgba(0,0,0,0.18)] transition duration-500">

                            <!-- Product Link -->
                            <a href="{{ route('products.show', $product->id) }}" class="absolute inset-0 z-10">
                            </a>

                            <!-- Background Image -->
                            @if ($product->images->first())
                                <img src="{{ $product->images->first()->image_url }}"
                                    class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-1000 ease-out">
                            @endif
                            <!-- Overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent">
                            </div>

                            <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST"
                                class="absolute top-4 right-4 z-20">

                                @csrf

                                <button
                                    class="w-9 h-9 rounded-full bg-black/25 backdrop-blur-md border border-white/20 text-white hover:bg-white hover:text-black hover:scale-110 transition duration-300 flex items-center justify-center">

                                    @if (auth()->check() && auth()->user()->wishlistItems->where('product_id', $product->id)->count())
                                        ♥
                                    @else
                                        ♡
                                    @endif

                                </button>

                            </form>
                            <div
                                class="absolute inset-0 border border-white/0 group-hover:border-white/20 transition duration-500 rounded-[30px]">
                            </div>

                            <!-- Gender -->
                            @if ($product->gender)
                                <span
                                    class="absolute top-4 left-4 z-20 text-[10px] uppercase tracking-[2px] bg-black/25 backdrop-blur-md border border-white/20 text-white px-3 py-1 rounded-full">

                                    {{ $product->gender }}

                                </span>
                            @endif

                            <!-- Content -->
                            <div class="absolute bottom-0 left-0 w-full p-5 z-20">

                                <!-- Category -->
                                @if ($product->category)
                                    <p class="text-[10px] uppercase tracking-[3px] text-white/70 mb-2">

                                        {{ $product->category->name }}

                                    </p>
                                @endif

                                <!-- Name -->
                                <h3 class="text-[17px] sm:text-[21px] leading-tight font-bold text-white line-clamp-2">

                                    {{ $product->name }}

                                </h3>

                                <!-- Bottom -->
                                <div class="flex items-center justify-between mt-4">

                                    <!-- Price -->
                                    <span class="number-font text-lg font-semibold text-white">

                                        {{ $product->price }}<span class="text-[6px] sm:text-[8px]">SAR</span>

                                    </span>

                                    <!-- View -->
                                    <a href="{{ route('products.show', $product->id) }}"
                                        class="relative z-30 h-10 px-4 rounded-full bg-black/15 backdrop-blur-md border border-white/20 text-white text-sm flex items-center justify-center hover:bg-white hover:text-black transition duration-300 hover:scale-105 hero-title">

                                        View

                                    </a>

                                </div>

                            </div>

                        </div>
                    @endforeach
                @else
                    <div class="col-span-full flex flex-col items-center justify-center py-32 text-center">

                        <p class="uppercase tracking-[4px] text-[#8b8175] text-sm mb-4">

                            No Results

                        </p>

                        <h2 class="hero-title text-5xl text-[#1f1f1f] mb-6">

                            No Products Found

                        </h2>

                        <p class="section-description-font text-[#6f675d] text-lg max-w-md">

                            Try changing your filters or search keywords.

                        </p>

                    </div>

                @endif

            </div>

            <!-- Pagination -->
            <div class="mt-16">

                {{ $products->links() }}

            </div>

        </section>

    </div>
    @include('layouts.footer')

</x-app-layout>
