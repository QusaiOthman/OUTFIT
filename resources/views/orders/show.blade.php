<x-app-layout>

    <div class="bg-[#f8f7f4] min-h-screen pt-16 sm:pt-20 pb-16 sm:pb-24">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">

            <!-- Header -->
            <div class="mb-10 sm:mb-16">

                <p class="uppercase tracking-[4px] text-[#8b8175] text-sm mb-4">
                    Order #{{ $order->id }}
                </p>

                <h1 class="hero-title text-4xl sm:text-5xl lg:text-6xl text-[#1f1f1f] mb-3 sm:mb-4 leading-none">
                    Order Details
                </h1>

            </div>
            <!-- Hero -->
            <section
                class="relative h-[250px] sm:h-[340px] rounded-[24px] sm:rounded-[40px] overflow-hidden mb-8 sm:mb-12">

                <!-- Background -->
                @if ($order->items->first()?->product?->images->first())
                    <img src="{{ asset('storage/' . $order->items->first()->product->images->first()->image) }}"
                        class="absolute inset-0 w-full h-full object-cover">
                @endif

                <!-- Overlay -->
                <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/55 to-black/40"></div>

                <!-- Content -->
                <div class="relative z-10 h-full flex flex-col justify-between p-5 sm:p-10">

                    <!-- Top -->
                    <div class="flex flex-wrap items-center gap-4">

                        <span
                            class="inline-flex items-center justify-center h-11 px-5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-sm font-medium">
                            {{ ucfirst($order->status) }}
                        </span>

                        <span class="w-1.5 h-1.5 rounded-full bg-white/30"></span>

                        <p class="text-white/70 text-sm">
                            {{ $order->created_at->format('d M Y - h:i A') }}
                        </p>

                    </div>

                    <!-- Bottom -->
                    <div>

                        <p class="uppercase tracking-[4px] text-white/60 text-sm mb-4">
                            Order #{{ $order->id }}
                        </p>

                        <h1 class="number-font text-white text-4xl sm:text-5xl lg:text-6xl leading-none mb-3 sm:mb-5">
                            {{ number_format($order->total, 2) }}<span class="text-[8px] sm:text-[10px]">SAR</span>
                        </h1>

                        <p class="section-description-font text-white/75 text-sm sm:text-lg lg:text-xl">
                            {{ $order->items->count() }} Items Purchased
                        </p>

                    </div>

                </div>

            </section>

            <!-- Main -->
            <div class="grid grid-cols-1 xl:grid-cols-[1fr_360px] gap-6 lg:gap-10">

                <!-- Products -->
                <div class="space-y-6">

                    @foreach ($order->items as $item)
                        <div
                            class="bg-white rounded-[22px] sm:rounded-[30px] p-4 sm:p-6 border border-black/5 flex flex-col sm:flex-row gap-4 sm:gap-6 hover:shadow-[0_20px_50px_rgba(0,0,0,0.06)] transition duration-500">

                            <!-- Image -->
                            <div class="w-full sm:w-[170px] flex items-center justify-center shrink-0">

                                @if ($item->product && $item->product->images->first())
                                    <img src="{{ asset('storage/' . $item->product->images->first()->image) }}"
                                        class="w-full sm:w-[170px] h-[240px] sm:h-[190px] rounded-[18px] sm:rounded-[24px] object-cover bg-[#f3f1ec]">
                                @endif

                            </div>

                            <!-- Info -->
                            <div class="flex-1 flex flex-col justify-between">

                                <div>

                                    @if ($item->product)
                                        @if ($item->product->category)
                                            <p class="uppercase tracking-[3px] text-[#8b8175] text-xs mb-3">
                                                {{ $item->product->category->name }}
                                            </p>
                                        @endif

                                        <h2
                                            class="hero-title text-2xl sm:text-3xl lg:text-4xl text-[#1f1f1f] leading-tight mb-3 sm:mb-4">
                                            {{ $item->product->name }}
                                        </h2>

                                        <!-- Description -->
                                        <p
                                            class="section-description-font text-[#6f675d] text-[14px] sm:text-[16px] lg:text-[17px] leading-relaxed max-w-2xl mb-6">
                                            {{ $item->product->description }}
                                        </p>
                                    @else
                                        <h2
                                            class="hero-title text-2xl sm:text-3xl lg:text-4xl text-[#1f1f1f] leading-tight mb-3 sm:mb-4">
                                            Product Unavailable
                                        </h2>
                                        <p
                                            class="section-description-font text-[#6f675d] text-[14px] sm:text-[16px] lg:text-[17px] leading-relaxed max-w-2xl mb-6">
                                            This product has been removed.
                                        </p>
                                    @endif

                                    <!-- Meta -->
                                    <div class="flex flex-wrap items-center gap-3">

                                        @if ($item->size)
                                            <span
                                                class="h-10 px-5 rounded-full bg-[#f3f1ec] text-[#1f1f1f] text-sm flex items-center justify-center">
                                                Size {{ $item->size }}
                                            </span>
                                        @endif

                                        <span
                                            class="h-10 px-5 rounded-full bg-[#f3f1ec] text-[#1f1f1f] text-sm flex items-center justify-center">
                                            Qty {{ $item->quantity }}
                                        </span>

                                    </div>

                                </div>

                                <!-- Price -->
                                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mt-6 sm:mt-8">

                                    <p class="number-font text-3xl sm:text-4xl text-[#1f1f1f]">
                                        {{ number_format($item->price * $item->quantity, 2) }}<span class="text-[8px] sm:text-[10px]">SAR</span>
                                    </p>

                                    @if ($item->product)
                                        <a href="{{ route('products.show', $item->product->id) }}"
                                            class="hero-title w-full sm:w-auto h-[46px] sm:h-[50px] px-5 sm:px-6 rounded-xl sm:rounded-2xl border border-black/10 hover:bg-black hover:text-white transition duration-300 flex items-center justify-center">
                                            View Product
                                        </a>
                                    @endif

                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>

                <!-- Summary -->
                <div>

                    <div
                        class="bg-white rounded-[24px] sm:rounded-[32px] border border-black/5 p-5 sm:p-8 xl:sticky xl:top-28">

                        <h2 class="hero-title text-3xl sm:text-4xl text-[#1f1f1f] mb-6 sm:mb-10">
                            Summary
                        </h2>

                        <!-- Totals -->
                        <div class="space-y-6">

                            <div class="flex items-center justify-between">

                                <span class="text-[#8b8175] text-lg">
                                    Subtotal
                                </span>

                                <span class="number-font text-[#1f1f1f] text-lg">
                                    {{ number_format($order->subtotal, 2) }}<span class="text-[6px] sm:text-[8px]">SAR</span>
                                </span>

                            </div>

                            <div class="flex items-center justify-between">

                                <span class="text-[#8b8175] text-lg">
                                    Shipping
                                </span>

                                @if ($order->shipping == 0)
                                    <span class="hero-title text-[#1f1f1f] text-lg">
                                        Free
                                    </span>
                                @else
                                    <span class="number-font text-[#1f1f1f] text-lg">
                                        {{ number_format($order->shipping, 2) }}<span class="text-[6px] sm:text-[8px]">SAR</span>
                                    </span>
                                @endif

                            </div>

                            <div class="w-full h-px bg-black/10"></div>

                            <div class="flex items-center justify-between">

                                <span class="hero-title text-2xl text-[#1f1f1f]">
                                    Total
                                </span>

                                <span class="number-font text-3xl text-[#1f1f1f]">
                                    {{ number_format($order->total, 2) }}<span class="text-[6px] sm:text-[8px]">SAR</span>
                                </span>

                            </div>

                        </div>

                        <!-- Status -->
                        <div class="mt-12">

                            <p class="uppercase tracking-[3px] text-[#8b8175] text-xs mb-4">
                                Payment Status
                            </p>

                            <div
                                class="h-12 px-5 rounded-2xl bg-[#eef2ff] text-[#3150d8] text-sm font-medium inline-flex items-center">
                                {{ ucfirst($order->status) }}
                            </div>

                        </div>

                        <!-- Actions -->
                        <div class="mt-12 space-y-4">

                            <a href="{{ route('products.index') }}"
                                class="hero-title h-[48px] sm:h-[56px] rounded-2xl bg-black text-white hover:bg-neutral-800 transition duration-300 flex items-center justify-center w-full">

                                Continue Shopping

                            </a>

                            <a href="{{ route('orders.index') }}"
                                class="hero-title h-[48px] sm:h-[56px] rounded-2xl border border-black/10 hover:bg-black hover:text-white transition duration-300 flex items-center justify-center w-full">

                                Back To Orders

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    @include('layouts.footer')

</x-app-layout>
