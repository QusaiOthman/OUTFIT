<x-app-layout>


    <!-- HERO -->
    <section class="relative overflow-hidden">

        <!-- Background Image -->
        <div class="absolute inset-0">

            <img src="{{ asset('images/hero-fashion3.png') }}" alt=""
                class="w-full h-full object-cover object-[72%_center] sm:object-center">

        </div>

        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/15"></div>

        <!-- Left Gradient -->
        <div
            class="absolute inset-0
        bg-gradient-to-r
        from-black/60
        via-black/25
        to-transparent">
        </div>

        <!-- Content -->
        <div
            class="relative z-10
        max-w-7xl mx-auto
        px-5 sm:px-8 lg:px-20
        min-h-[620px] sm:min-h-[700px] lg:min-h-[780px]
        flex items-center">

            <div class="max-w-2xl">

                <!-- Small -->
                <span
                    class="uppercase tracking-[7px]
                text-white/70
                font-semibold
                text-sm">

                    New Collection 2026

                </span>

                <!-- Title -->
                <h1
                    class="hero-title
                mt-8
                text-white
                text-5xl sm:text-6xl lg:text-[90px]
                leading-[0.95]
                font-black">

                    Elevate Your
                    <br>

                    <span class="italic text-black/90">

                        Style.

                    </span>

                </h1>

                <!-- Description -->
                <p
                    class="section-description-font
                mt-10
                text-base sm:text-lg lg:text-xl
                text-white/80
                leading-relaxed
                max-w-xl">

                    Premium fashion pieces crafted to help
                    you express your unique style with
                    confidence and elegance.

                </p>

                <!-- Buttons -->
                <div class="hero-title flex flex-col sm:flex-row items-start gap-3 sm:gap-5 mt-8 sm:mt-10">

                    <!-- Primary -->
                    <a href="{{ route('products.index') }}"
                        class="inline-flex w-fit px-6 sm:px-8 py-3 sm:py-4 rounded-xl bg-white text-black text-base sm:text-lg font-semibold hover:bg-gray-200 transition duration-300">

                        Shop Now

                    </a>

                    <!-- Secondary -->
                    <a href="{{ route('categories.index') }}"
                        class="inline-flex w-fit px-6 sm:px-8 py-3 sm:py-4 rounded-xl border border-white/20 bg-white/10 backdrop-blur-md text-white text-base sm:text-lg font-semibold hover:bg-white hover:text-black transition duration-300">

                        Explore Categories

                    </a>

                </div>

                <!-- Features -->
                <div class="flex flex-wrap gap-5 sm:gap-10 mt-8 sm:mt-10 text-gray-200">

                    <div class="flex items-center gap-3">

                        <span class="text-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                            </svg>

                        </span>

                        <span class="hero-title text-sm sm:text-base font-semibold">
                            Premium Quality
                        </span>

                    </div>

                    <div class="flex items-center gap-3">

                        <span class="text-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="5." stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                            </svg>
                        </span>

                        <span class="hero-title text-sm sm:text-base font-semibold">
                            Easy Returns
                        </span>

                    </div>

                    <div class="flex items-center gap-3 ">

                        <span class="text-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-truck-delivery">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 17a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M15 17a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" />
                                <path d="M3 9l4 0" />
                            </svg>
                        </span>

                        <span class="hero-title text-sm sm:text-base font-semibold">
                            Fast Delivery
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- FEATURED PRODUCTS -->
    <section class="max-w-7xl mx-auto px-6 py-24 ">

        <!-- Header -->
        <div class="flex items-end justify-between mb-14">

            <div>

                <h2 class="text-5xl font-black text-gray-900 section-title">

                    Featured Products

                </h2>

                <p class="section-description-font text-gray-500 text-xl mt-4">

                    Discover our newest fashion arrivals

                </p>

            </div>

            <a href="{{ route('products.index') }}"
                class="hero-title text-neutral-900 hover:text-neutral-500 font-semibold text-lg transition">

                View All Products →

            </a>

        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

            @foreach ($products as $product)
                <div
                    class="group relative h-[320px]
                   rounded-[30px]
                   overflow-hidden
                   hover:-translate-y-2
                   hover:shadow-[0_25px_60px_rgba(0,0,0,0.18)]
                   transition duration-500">

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
                        class="absolute inset-0
                       bg-gradient-to-t
                       from-black/70
                       via-black/10
                       to-transparent">
                    </div>

                    <!-- Border Hover -->
                    <div
                        class="absolute inset-0
                       border border-white/0
                       group-hover:border-white/20
                       transition duration-500
                       rounded-[30px]">
                    </div>

                    <!-- Favorite -->
                    <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST"
                        class="absolute top-4 right-4 z-20">

                        @csrf

                        <button
                            class="w-9 h-9 rounded-full
               bg-white/15 backdrop-blur-md
               border border-white/20
               text-white
               hover:bg-white
               hover:text-black
               hover:scale-110
               transition duration-300
               flex items-center justify-center">

                            @if (auth()->check() && auth()->user()->wishlistItems->where('product_id', $product->id)->count())
                                ♥
                            @else
                                ♡
                            @endif

                        </button>

                    </form>

                    <!-- Gender -->
                    @if ($product->gender)
                        <span
                            class="absolute top-4 left-4 z-20
                           text-[10px]
                           uppercase tracking-[2px]
                           bg-white/15 backdrop-blur-md
                           border border-white/20
                           text-white
                           px-3 py-1 rounded-full">

                            {{ $product->gender }}

                        </span>
                    @endif

                    <!-- Content -->
                    <div class="absolute bottom-0 left-0 w-full p-5 z-20">

                        <!-- Category -->
                        @if ($product->category)
                            <p
                                class="text-[10px]
                               uppercase tracking-[3px]
                               text-white/70 mb-2">

                                {{ $product->category->name }}

                            </p>
                        @endif

                        <!-- Name -->
                        <h3
                            class="text-[21px]
                           leading-tight
                           font-bold
                           text-white
                           line-clamp-2">

                            {{ $product->name }}

                        </h3>

                        <!-- Bottom -->
                        <div class="flex items-center justify-between mt-4">

                            <!-- Price -->
                            <span
                                class="number-font text-[18px]
                               font-medium
                               tracking-wide
                               text-white">

                                {{ $product->price }}<span class="text-[6px] sm:text-[8px]">SAR</span>

                            </span>

                            <!-- View -->
                            <a href="{{ route('products.show', $product->id) }}"
                                class="relative z-30
                               h-10 px-4 rounded-full
                               bg-white/15 backdrop-blur-md
                               border border-white/20
                               text-white text-sm
                               flex items-center justify-center
                               hover:bg-white
                               hover:text-black
                               hover:scale-105
                               transition duration-300 hero-title">

                                View

                            </a>

                        </div>

                    </div>

                </div>
            @endforeach

        </div>

    </section>

    <!-- CATEGORIES -->
    <section class="max-w-7xl mx-auto px-6 py-24">

        <!-- Header -->
        <div class="flex items-end justify-between mb-14">

            <div>

                <h2 class="section-title text-5xl font-black text-[#111827]">

                    Shop By Category

                </h2>

                <p class="section-description-font text-xl text-gray-500 mt-4">

                    Explore styles made for every occasion

                </p>

            </div>

            <a href="{{ route('categories.index') }}"
                class="hero-title text-neutral-900 hover:text-neutral-500 font-semibold text-lg transition">

                Browse Categories →

            </a>

        </div>


        <!-- Categories Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-8">

            @foreach ($categories as $cat)
                <a href="{{ route('products.index', ['category' => $cat->id]) }}"
                    class="group relative h-[420px] rounded-[32px]
                overflow-hidden">

                    <!-- Background Image -->
                    <div class="absolute inset-0">
                        <img src="{{ $cat->image_url }}" alt=""
                            class="w-full h-full object-cover">

                    </div>
                    <!-- Overlay -->
                    <div
                        class="absolute inset-0
                    bg-gradient-to-t from-black/70 via-black/20 to-transparent">
                    </div>

                    <!-- Glow -->
                    <div
                        class="absolute inset-0 opacity-0 group-hover:opacity-100
                    bg-black/10 transition duration-500">
                    </div>

                    <!-- Content -->
                    <div class="absolute bottom-0 left-0 w-full p-7 z-10">

                        <!-- Name -->
                        <h3 class="hero-title text-white text-4xl font-bold">

                            {{ $cat->name }}

                        </h3>

                        <!-- Products Count -->
                        <p class="section-description-font text-gray-200 text-lg mt-2">

                            {{ $cat->products_count }} Products

                        </p>

                        <!-- Button -->
                        <div class="mt-6">

                            <span
                                class="hero-title inline-flex items-center gap-3
                            px-5 py-3 rounded-2xl
                            bg-white/10 backdrop-blur-md
                            border border-white/20
                            text-white text-lg font-semibold
                            group-hover:bg-white
                            group-hover:text-neutral-800
                            transition duration-300">

                                Explore

                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">

                                    <path d="M5 12h14" />
                                    <path d="m12 5 7 7-7 7" />

                                </svg>

                            </span>

                        </div>

                    </div>

                </a>
            @endforeach

        </div>

    </section>

    <!-- EDITORIAL SECTION -->
    <section class="max-w-7xl mx-auto px-6 py-32">

        <div class="grid lg:grid-cols-2 gap-16 items-center">

            <!-- Image -->
            <div class="overflow-hidden rounded-[32px]">

                <img src="{{ asset('images/editorial3.jpg') }}" alt=""
                    class="w-full h-[580px] object-cover">

            </div>

            <!-- Content -->
            <div>

                <p class="uppercase tracking-[6px]
                text-neutral-400 text-sm mb-6">

                    Editorial Choice

                </p>

                <h2
                    class="section-title
                text-5xl lg:text-7xl
                leading-[1.05]
                text-neutral-900">

                    Crafted For
                    Modern Elegance

                </h2>

                <p
                    class="section-description-font
                text-neutral-500
                text-xl leading-[1.9]
                mt-10 max-w-xl">

                    Discover timeless fashion pieces
                    designed with simplicity,
                    confidence and modern aesthetics.

                </p>

                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center gap-3
                mt-12 px-8 py-4
                rounded-2xl bg-neutral-900
                text-white
                text-lg font-semibold
                hover:bg-neutral-700
                transition duration-300 hero-title">

                    Discover Collection →

                </a>

            </div>

        </div>

    </section>
    <!-- NEWSLETTER -->
    <section class="max-w-5xl mx-auto px-6 pb-32">

        <div class="
        px-8 py-20 text-center">

            <p class="uppercase tracking-[6px]
            text-neutral-400 text-sm mb-5">

                Stay Updated

            </p>

            <h2 class="section-title
            text-5xl text-neutral-900">

                Join Our Newsletter

            </h2>

            <p
                class="section-description-font
            text-neutral-500
            text-lg mt-6 max-w-2xl mx-auto">

                Get updates about new collections,
                exclusive offers and fashion inspiration.

            </p>
            @if (session('success'))
                <p class="text-green-600 mb-4">
                    {{ session('success') }}
                </p>
            @elseif (session('error'))
                <p class="text-red-600 mb-4">
                    {{ session('error') }}
                </p>
            @endif

            <!-- Form -->
            <form action="{{ route('newsletter.store') }}" method="POST"
                class="flex flex-col sm:flex-row justify-center gap-4 mt-10">

                @csrf

                <input type="email" name="email" placeholder="Enter your email"
                    class="px-6 py-4 rounded-2xl
                border border-neutral-200
                bg-white
                w-full sm:w-[400px]
                focus:outline-none">

                <button type="submit"
                    class="px-8 py-4 rounded-2xl
                bg-black text-white
                font-semibold
                hover:bg-neutral-800
                transition duration-300 hero-title">

                    Subscribe

                </button>

            </form>

        </div>

    </section>
    @include('layouts.footer')

</x-app-layout>
