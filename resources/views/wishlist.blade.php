<x-app-layout>

    <div class="bg-[#f8f7f4] min-h-screen pt-24 sm:pt-32 pb-16 sm:pb-24">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">

            @if ($items->count())

                <!-- Header -->
                <div class="mb-10 sm:mb-16">

                    <p class="uppercase tracking-[4px] text-[#8b8175] text-sm mb-4">

                        Your Favorites

                    </p>

                    <h1 class="hero-title text-4xl sm:text-5xl lg:text-6xl text-[#1f1f1f] leading-none">

                        Wishlist

                    </h1>

                </div>

                <!-- Grid -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">

                    @foreach ($items as $item)
                        @php
                            $product = $item->product;
                        @endphp

                        <div
                            class="group relative h-[240px] sm:h-[300px] lg:h-[320px] rounded-[22px] sm:rounded-[30px] overflow-hidden hover:-translate-y-2 hover:shadow-[0_25px_60px_rgba(0,0,0,0.18)] transition duration-500">

                            <!-- Link -->
                            <a href="{{ route('products.show', $product->id) }}" class="absolute inset-0 z-10">
                            </a>

                            <!-- Image -->
                            @if ($product->images->first())
                                <img src="{{ asset('storage/' . $product->images->first()->image) }}"
                                    class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-1000 ease-out">
                            @endif

                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent">
                            </div>

                            <!-- Remove -->
                            <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST"
                                class="absolute top-4 right-4 z-20">

                                @csrf

                                <button
                                    class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-white text-black hover:scale-110 transition duration-300 flex items-center justify-center">

                                    ♥

                                </button>

                            </form>

                            <!-- Content -->
                            <div class="absolute bottom-0 left-0 w-full p-4 sm:p-5 z-20">

                                @if ($product->category)
                                    <p class="text-[9px] sm:text-[10px] uppercase tracking-[2px] sm:tracking-[3px] text-white/70 mb-2">

                                        {{ $product->category->name }}

                                    </p>
                                @endif

                                <h3 class="text-[16px] sm:text-[19px] lg:text-[21px] leading-tight font-bold text-white line-clamp-2">

                                    {{ $product->name }}

                                </h3>

                                <div class="flex items-center justify-between mt-3 sm:mt-4">

                                    <span class="number-font text-[15px] sm:text-[17px] lg:text-[18px] font-medium tracking-wide text-white">

                                        {{ $product->price }}<span class="text-[6px] sm:text-[8px]">SAR</span>

                                    </span>

                                    <a href="{{ route('products.show', $product->id) }}"
                                        class="relative z-30 h-8 sm:h-10 px-3 sm:px-4 rounded-full text-xs sm:text-sm bg-white/15 backdrop-blur-md border border-white/20 text-white text-sm flex items-center justify-center hover:bg-white hover:text-black hover:scale-105 transition duration-300">

                                        View

                                    </a>

                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>
            @else
                <!-- Empty -->
                <div class="min-h-[70vh] flex flex-col items-center justify-center text-center -mt-16">

                    <p class="uppercase tracking-[4px] text-[#8b8175] text-sm mb-4">

                        No Favorites Yet

                    </p>

                    <h2 class="hero-title text-3xl sm:text-4xl lg:text-5xl text-[#1f1f1f] mb-5 sm:mb-6">

                        Your Wishlist Is Empty

                    </h2>

                    <p class="section-description-font text-[15px] sm:text-lg text-[#6f675d] max-w-md mb-8 sm:mb-10 leading-relaxed">

                        Save your favorite pieces and come back to them anytime.

                    </p>

                    <a href="{{ route('products.index') }}"
                        class="h-[48px] sm:h-[58px] px-6 sm:px-8 rounded-xl sm:rounded-2xl bg-black text-white flex items-center justify-center hover:bg-neutral-800 transition duration-300 hero-title">

                        Explore Products

                    </a>

                </div>

            @endif

        </div>

    </div>
    @include('layouts.footer')

</x-app-layout>
