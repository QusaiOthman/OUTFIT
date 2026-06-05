<x-app-layout>

    <div class="bg-[#f8f7f4] min-h-screen pt-24 sm:pt-32 pb-16 sm:pb-24">

        @if ($cart && $cart->items->count())



            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">

                <div class="grid grid-cols-1 xl:grid-cols-[1fr_300px] gap-10 items-start">

                    <!-- Left Side -->
                    <div>

                        <!-- Header -->
                        <div class="mb-8">

                            <h1 class="hero-title text-[32px] sm:text-[42px] text-[#1f1f1f] leading-none mb-3">

                                Your Cart

                            </h1>

                            <p class="text-[#8b8175] text-sm">

                                Home / Cart

                            </p>
                            @if (session('error'))
                                <br>
                                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-6 py-5 text-red-700">

                                    {{ session('error') }}

                                </div>
                            @endif

                        </div>

                        <!-- Cart Card -->
                        <div class="bg-white rounded-[28px] border border-black/5 overflow-hidden">

                            <!-- Header -->
                            <div
                                class="hidden md:grid md:grid-cols-[1.8fr_120px_180px_140px] px-10 py-6 border-b border-black/5 text-[12px] uppercase tracking-[3px] text-[#8b8175]">

                                <span>Product</span>
                                <span>Price</span>
                                <span>Quantity</span>
                                <span>Total</span>

                            </div>

                            @foreach ($cart->items as $item)
                                <!-- Item -->
                                <div
                                    class="grid grid-cols-1 md:grid-cols-[1.8fr_120px_180px_140px] gap-5 md:gap-6 items-start md:items-center px-4 sm:px-6 lg:px-10 py-6 sm:py-8 border-b border-black/5 last:border-none">

                                    <!-- Product -->
                                    <div class="flex items-start sm:items-center gap-4 sm:gap-6 min-w-0">

                                        <!-- Image -->
                                        <a href="{{ route('products.show', $item->product->id) }}"
                                            class="w-20 h-20 sm:w-24 sm:h-24 rounded-[18px] sm:rounded-[22px] overflow-hidden bg-[#f3f1ec] flex-shrink-0">

                                            @if ($item->product->images->first())
                                                <img src="{{ $item->product->images->first()->image_url }}"
                                                    class="w-full h-full object-cover">
                                            @endif

                                        </a>

                                        <!-- Info -->
                                        <div class="min-w-0 flex-1">

                                            <h2
                                                class="text-[17px] sm:text-[20px] leading-tight text-[#1f1f1f] font-medium mb-3 sm:mb-4">

                                                {{ $item->product->name }}

                                            </h2>

                                            <!-- Size -->
                                            <span
                                                class="inline-flex items-center justify-center min-w-[42px] h-8 px-3 rounded-full bg-[#f6f4ee] text-xs font-medium text-gray-700">

                                                {{ $item->size }}

                                            </span>

                                        </div>

                                    </div>
                                    <div class="flex items-center justify-between md:contents mt-3 md:mt-0">

                                        <!-- Price -->
                                        <div
                                            class="flex justify-center text-[16px] sm:text-[20px] text-[#1f1f1f] number-font">

                                            <span>{{ number_format($item->product->price, 2) }}<span class="text-[6px] sm:text-[8px] text-[#6f675d]">SAR</span>
                                            </span>


                                        </div>

                                        <!-- Quantity -->
                                        <div class="flex items-center">

                                            <div
                                                class="flex items-center rounded-full border border-black/10 overflow-hidden">

                                                <!-- Minus -->
                                                <form action="{{ route('cart.decrease', $item->id) }}" method="POST">

                                                    @csrf

                                                    <button type="submit"
                                                        class="w-8 h-8 flex items-center justify-center text-[#8b8175] hover:bg-black hover:text-white transition duration-300">

                                                        −

                                                    </button>

                                                </form>

                                                <!-- Qty -->
                                                <div class="w-8 text-center text-lg font-medium">

                                                    {{ $item->quantity }}

                                                </div>

                                                <!-- Plus -->
                                                <form action="{{ route('cart.increase', $item->id) }}" method="POST">

                                                    @csrf

                                                    <button type="submit"
                                                        class="w-8 h-8 flex items-center justify-center bg-[#0f1020] text-white hover:bg-black transition duration-300">

                                                        +

                                                    </button>

                                                </form>

                                            </div>

                                        </div>

                                        <!-- Total -->
                                        <div class="flex items-center gap-6">

                                            <span
                                                class="text-[16px] sm:text-[20px] text-[#1f1f1f] number-font whitespace-nowrap">

                                                {{ number_format($item->product->price * $item->quantity, 2) }}<span class="text-[6px] sm:text-[8px] text-[#6f675d]">SAR</span>

                                            </span>

                                            <!-- Remove -->
                                            <form action="/cart/remove/{{ $item->id }}" method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="text-[#b3b3b3] hover:text-black transition duration-300">

                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-5">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />

                                                    </svg>

                                                </button>

                                            </form>

                                        </div>
                                    </div>

                                </div>
                            @endforeach

                        </div>

                        <!-- Empty Style Box -->
                        @if ($total < $freeShippingGoal)
                            <div
                                class="mt-8 bg-[#f7f5ff] border border-[#ece8ff] rounded-[28px] min-h-[220px] flex flex-col items-center justify-center text-center px-6">
                                <br>

                                <div
                                    class="w-16 h-16 rounded-full bg-[#ece8ff] flex items-center justify-center text-2xl mb-6">

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>


                                </div>

                                <h3 class="hero-title text-[34px] text-[#1f1f1f] mb-3">

                                    Your cart is looking a little light

                                </h3>

                                <p class="section-description-font text-[#7c7c88] text-lg mb-8">

                                    Discover more pieces that match your style
                                </p>

                                <a href="{{ route('products.index') }}"
                                    class="hero-title h-12 px-8 rounded-2xl bg-[#0f1020] text-white hover:bg-black transition duration-300 flex items-center justify-center">

                                    Continue Shopping

                                </a>
                                <br>

                            </div>
                        @endif

                    </div>

                    <!-- Summary -->
                    <div
                        class="bg-white rounded-[24px] sm:rounded-[28px] border border-black/5 p-5 sm:p-8 xl:sticky xl:top-24">



                        <h2 class="hero-title text-[24px] sm:text-[28px] text-[#1f1f1f] mb-6 sm:mb-8 leading-none">

                            Cart Summary

                        </h2>

                        <!-- Shipping -->
                        <div class="section-description-font mb-8 p-5 rounded-[24px] bg-[#f7f5ff]">

                            <p class="text-sm text-[#4b5563] mb-4">

                                @if ($remaining > 0)
                                    You're
                                    <span class="font-bold">
                                        {{ number_format($remaining, 2) }}<span class="text-[6px] sm:text-[8px] text-[#6f675d]">SAR</span>

                                    </span>

                                    away from free shipping!
                                @else
                                    Your order qualifies for free shipping!!
                                @endif

                            </p>

                            <div class="w-full h-2 bg-black/10 rounded-full overflow-hidden">

                                <div class="h-full bg-black rounded-full" style="width: {{ $progress }}%">

                                </div>

                            </div>

                            <p class="number-font text-sm text-[#6b7280] mt-3">

                                {{ number_format($total, 2) }}<span class="text-[6px] sm:text-[8px] text-[#6f675d]">SAR</span>

                                /
                                {{ number_format($freeShippingGoal, 2) }}<span class="text-[6px] sm:text-[8px] text-[#6f675d]">SAR</span>

                            </p>

                        </div>

                        <!-- Totals -->
                        <div class="space-y-6">

                            <div class="flex items-center justify-between text-[18px]">

                                <span class="text-[#6f675d]">
                                    Subtotal
                                </span>

                                <span class="number-font">
                                    {{ number_format($total, 2) }}<span class="text-[6px] sm:text-[8px] text-[#6f675d]">SAR</span>
                                </span>

                            </div>

                            <div class="flex items-center justify-between text-[18px]">

                                <span class="text-[#6f675d]">
                                    Shipping
                                </span>

                                <span class="number-font">
                                    @if ($total >= $freeShippingGoal)
                                        Free
                                    @else
                                        {{ number_format($shippingPrice, 2) }}<span class="text-[6px] sm:text-[8px] text-[#6f675d]">SAR</span>
                                    @endif
                                </span>

                            </div>

                        </div>

                        <!-- Divider -->
                        <div class="border-t border-black/10 my-8"></div>

                        <!-- Total -->
                        <div class="flex items-center justify-between mb-8">

                            <span class="hero-title text-[26px] text-[#1f1f1f] leading-none">

                                Total

                            </span>

                            <span class="number-font text-[26px] text-[#1f1f1f] leading-none">

                                {{ number_format($finalTotal, 2) }}<span class="text-[8px] sm:text-[10px] text-[#6f675d]">SAR</span>
                            </span>

                        </div>

                        <!-- Checkout -->
                        <a href="{{ route('payment') }}"
                            class="hero-title h-[46px] sm:h-[50px] rounded-2xl bg-[#0f1020] text-white hover:bg-black transition duration-300 flex items-center justify-center text-m font-medium w-full">

                            Proceed To Checkout

                        </a>

                        <!-- Continue -->
                        <a href="{{ route('products.index') }}"
                            class="hero-title h-[46px] sm:h-[50px] rounded-2xl border border-black/10 hover:bg-black hover:text-white transition duration-300 flex items-center justify-center text-m font-medium w-full mt-5">

                            Continue Shopping

                        </a>

                        <!-- Secure -->
                        <div class="flex items-center justify-center gap-2 mt-8 text-[#8b8175] text-sm">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                            Secure Checkout

                        </div>

                    </div>

                </div>

                <!-- Recommended Products -->
                <section class="mt-24">

                    <!-- Header -->
                    <div class="flex items-end justify-between mb-12">

                        <div>

                            <p class="uppercase tracking-[4px] text-[#8b8175] text-sm mb-4">

                                Complete Your Look

                            </p>

                            <h2 class="hero-title text-[32px] sm:text-[42px] text-[#1f1f1f] leading-none mb-3">

                                Recommended For You

                            </h2>

                        </div>

                    </div>

                    <!-- Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">

                        @foreach ($recommendedProducts as $product)
                            <div
                                class="group relative h-[240px] sm:h-[300px] lg:h-[320px] rounded-[30px] overflow-hidden hover:-translate-y-2 hover:shadow-[0_25px_60px_rgba(0,0,0,0.18)] transition duration-500">

                                <!-- Link -->
                                <a href="{{ route('products.show', $product->id) }}" class="absolute inset-0 z-10">
                                </a>

                                <!-- Image -->
                                @if ($product->images->first())
                                    <img src="{{ $product->images->first()->image_url }}"
                                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-1000 ease-out">
                                @endif

                                <!-- Overlay -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent">
                                </div>

                                <!-- Wishlist -->
                                <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST"
                                    class="absolute top-4 right-4 z-20">

                                    @csrf

                                    <button
                                        class="w-9 h-9 rounded-full bg-white/15 backdrop-blur-md border border-white/20 text-white hover:bg-white hover:text-black hover:scale-110 transition duration-300 flex items-center justify-center">

                                        @if (in_array($product->id, $wishlistProductIds))
                                            ♥
                                        @else
                                            ♡
                                        @endif

                                    </button>

                                </form>

                                <!-- Content -->
                                <div class="absolute bottom-0 left-0 w-full p-5 z-20">

                                    @if ($product->category)
                                        <p class="text-[10px] uppercase tracking-[3px] text-white/70 mb-2">

                                            {{ $product->category->name }}

                                        </p>
                                    @endif

                                    <h3 class="text-[21px] leading-tight font-bold text-white line-clamp-2">

                                        {{ $product->name }}

                                    </h3>

                                    <div class="flex items-center justify-between mt-4">

                                        <span class="number-font text-[18px] font-medium tracking-wide text-white">

                                            {{ $product->price }}<span class="text-[6px] sm:text-[8px]">SAR</span>


                                        </span>

                                        <a href="{{ route('products.show', $product->id) }}"
                                            class="hero-title relative z-30 h-10 px-4 rounded-full bg-white/15 backdrop-blur-md border border-white/20 text-white text-sm flex items-center justify-center hover:bg-white hover:text-black hover:scale-105 transition duration-300">

                                            View

                                        </a>

                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>

                </section>

            </div>
        @else
            <!-- Empty Cart -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">

                <div class="min-h-[70vh] flex flex-col items-center justify-center text-center">

                    <div
                        class="w-24 h-24 rounded-full bg-white/70 backdrop-blur-md border border-white/60 flex items-center justify-center text-4xl mb-8">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-10">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>

                    </div>

                    <p class="uppercase tracking-[4px] text-[#8b8175] text-sm mb-4">

                        Your Cart Is Empty

                    </p>

                    <h1 class="hero-title text-4xl sm:text-5xl lg:text-6xl text-[#1f1f1f] mb-6">

                        Start Shopping

                    </h1>

                    <p class="section-description-font text-[#6f675d] text-lg max-w-lg mb-10">

                        Looks like you haven’t added anything yet.
                        Discover our latest collection and find something you love.

                    </p>

                    <a href="{{ route('products.index') }}"
                        class="hero-title inline-flex items-center justify-center h-[58px] px-8 rounded-2xl bg-black text-white text-lg font-medium hover:bg-neutral-800 transition duration-300">

                        Explore Products

                    </a>

                </div>

            </div>

        @endif

    </div>

    @include('layouts.footer')
</x-app-layout>
