<x-app-layout>

    <div class="bg-[#f8f7f4] min-h-screen pt-24 sm:pt-32 pb-16 sm:pb-24">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">



            @if ($orders->count())
                <!-- Header -->
                <div class="mb-10 sm:mb-16">

                    <p class="uppercase tracking-[4px] text-[#8b8175] text-sm mb-4">
                        Your Orders
                    </p>

                    <h1 class="hero-title text-4xl sm:text-5xl lg:text-6xl text-[#1f1f1f] leading-none">
                        Order History
                    </h1>

                </div>

                <!-- Orders Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">

                    @foreach ($orders as $order)
                        <div
                            class="group relative h-[340px] sm:h-[420px] rounded-[24px] sm:rounded-[32px] overflow-hidden">

                            <!-- Background -->
                            @if ($order->items->first()?->product?->images->first())
                                <img src="{{ asset('storage/' . $order->items->first()->product->images->first()->image) }}"
                                    class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-700">
                            @endif

                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/70 to-black/50"></div>

                            <!-- Glow -->
                            <div
                                class="absolute inset-0 opacity-0 group-hover:opacity-100 bg-black/30 transition duration-500">
                            </div>

                            <!-- Content -->
                            <div class="absolute inset-0 z-10 p-5 sm:p-7 flex flex-col justify-between">

                                <!-- Top -->
                                <div>

                                    <div class="flex items-center justify-between">

                                        <span
                                            class="inline-flex items-center justify-center h-8 sm:h-10 px-4 sm:px-5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-sm font-medium">
                                            {{ ucfirst($order->status) }}
                                        </span>

                                        <p class="text-white/70 text-xs tracking-[2px] uppercase">
                                            {{ $order->created_at->format('d M Y') }}
                                        </p>

                                    </div>

                                </div>

                                <!-- Bottom -->
                                <div>

                                    <!-- Order ID -->
                                    <p class="uppercase tracking-[3px] text-white/60 text-sm mb-3">
                                        Order #{{ $order->id }}
                                    </p>

                                    <!-- Total -->
                                    <h2 class="hero-title text-white text-4xl sm:text-5xl leading-none mb-3 sm:mb-4">
                                        {{ number_format($order->total, 2) }}<span class="text-[8px] sm:text-[10px]">SAR</span>
                                    </h2>

                                    <!-- Items Count -->
                                    <p class="section-description-font text-white/75 text-sm sm:text-lg mb-5 sm:mb-6">
                                        {{ $order->items->count() }} Items
                                    </p>

                                    <!-- Preview Images -->
                                    <div class="flex items-center gap-3 mb-8">

                                        @foreach ($order->items->take(3) as $item)
                                            <div
                                                class="w-12 h-12 sm:w-14 sm:h-14 rounded-[14px] sm:rounded-[16px] overflow-hidden border border-white/10 bg-white/10 backdrop-blur-md">

                                                @if ($item->product && $item->product->images->first())
                                                    <img src="{{ asset('storage/' . $item->product->images->first()->image) }}"
                                                        class="w-full h-full object-cover">
                                                @endif

                                            </div>
                                        @endforeach

                                        @if ($order->items->count() > 3)
                                            <div
                                                class="w-12 h-12 sm:w-14 sm:h-14 rounded-[14px] sm:rounded-[16px] border border-white/10 bg-white/10 backdrop-blur-md flex items-center justify-center text-white text-sm font-medium">
                                                +{{ $order->items->count() - 3 }}
                                            </div>
                                        @endif

                                    </div>

                                    <!-- Button -->
                                    <a href="{{ route('orders.show', $order->id) }}"
                                        class="hero-title inline-flex items-center gap-2 sm:gap-3 px-4 sm:px-5 py-2.5 sm:py-3 rounded-xl sm:rounded-2xl text-sm sm:text-lg bg-white/10 backdrop-blur-md border border-white/20 text-white text-lg font-semibold hover:bg-white hover:text-neutral-800 transition duration-300">

                                        View Details

                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">

                                            <path d="M5 12h14" />
                                            <path d="m12 5 7 7-7 7" />

                                        </svg>

                                    </a>

                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>
            @else
                <!-- Empty -->
                <div class="min-h-[75vh] -mt-16 flex flex-col items-center justify-center text-center">

                    <p class="uppercase tracking-[4px] text-[#8b8175] text-sm mb-4">
                        No Orders Yet
                    </p>

                    <h2 class="hero-title text-3xl sm:text-4xl lg:text-5xl text-[#1f1f1f] mb-5 sm:mb-6">
                        Your Orders List Is Empty
                    </h2>

                    <p
                        class="section-description-font text-[15px] sm:text-lg text-[#6f675d] max-w-md mb-8 sm:mb-10 leading-relaxed">
                        Start shopping and your orders will appear here.
                    </p>

                    <a href="{{ route('products.index') }}"
                        class="hero-title h-[48px] sm:h-[58px] px-6 sm:px-8 rounded-xl sm:rounded-2xl bg-black text-white hover:bg-neutral-800 transition duration-300 flex items-center justify-center">

                        Explore Products

                    </a>

                </div>

            @endif

        </div>

    </div>
    @include('layouts.footer')

</x-app-layout>
