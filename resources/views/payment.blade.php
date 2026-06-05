<x-app-layout>

    <div class="bg-[#f8f7f4] min-h-screen pt-24 sm:pt-32 pb-16 sm:pb-24">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">

            <!-- Header -->
            <div class="mb-10 sm:mb-14">

                <p class="uppercase tracking-[4px] text-[#8b8175] text-sm mb-4">

                    Secure Checkout

                </p>

                <h1 class="hero-title text-4xl sm:text-5xl lg:text-6xl text-[#1f1f1f] mb-4 sm:mb-5 leading-none">

                    Complete Your Order

                </h1>

                <p class="section-description-font text-[15px] sm:text-lg text-[#6f675d] max-w-2xl leading-relaxed">

                    Review your details and finalize your purchase securely

                </p>

            </div>
            @if (session('error'))
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-6 py-5 text-red-700">

                    {{ session('error') }}

                </div>
            @endif

            <div class="grid grid-cols-1 xl:grid-cols-[1fr_380px] gap-6 lg:gap-10 items-start">


                <!-- Left Side -->
                <div class="bg-white rounded-[24px] sm:rounded-[32px] border border-black/5 p-5 sm:p-8 lg:p-10">


                    <form action="{{ route('payment.process') }}" method="POST" class="space-y-10">

                        @csrf

                        <!-- Contact -->
                        <div>

                            <h2 class="hero-title text-[24px] sm:text-[32px] text-[#1f1f1f] mb-6 sm:mb-8">

                                Contact Information

                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <!-- Phone -->
                                <div>

                                    <label class="hero-title block text-sm text-[#6f675d] mb-3">

                                        Phone Number

                                    </label>

                                    <input type="text" name="phone" value="{{ auth()->user()->phone }}" required
                                        class="w-full h-[50px] sm:h-[56px] rounded-2xl border border-black/10 bg-[#f8f7f4] px-5 text-[#1f1f1f] placeholder:text-[#9ca3af] focus:border-black focus:ring-0">

                                </div>

                                <!-- Email -->
                                <div>

                                    <label class="block text-sm text-[#6f675d] mb-3">

                                        Email Address

                                    </label>

                                    <input type="email" value="{{ auth()->user()->email }}" required
                                        class="w-full h-[50px] sm:h-[56px] rounded-2xl border border-black/10 bg-[#f8f7f4] px-5 text-[#1f1f1f] placeholder:text-[#9ca3af] focus:border-black focus:ring-0">

                                </div>

                            </div>

                        </div>

                        <!-- Shipping -->
                        <div>

                            <h2 class="hero-title text-[24px] sm:text-[32px] text-[#1f1f1f] mb-6 sm:mb-8">

                                Shipping Address

                            </h2>

                            <div class="space-y-6">

                                <!-- Address -->
                                <div>

                                    <label class="block text-sm text-[#6f675d] mb-3">

                                        Address

                                    </label>

                                    <input type="text" name="address" value="{{ auth()->user()->address }}" required
                                        class="w-full h-[50px] sm:h-[56px] rounded-2xl border border-black/10 bg-[#f8f7f4] px-5 text-[#1f1f1f] placeholder:text-[#9ca3af] focus:border-black focus:ring-0">

                                </div>

                                <!-- Notes -->
                                <div>

                                    <label class="block text-sm text-[#6f675d] mb-3">

                                        Order Notes (Optional)

                                    </label>

                                    <textarea rows="3" name="notes"
                                        class="w-full rounded-2xl border border-black/10 bg-[#f8f7f4] px-5 py-4 text-[#1f1f1f] placeholder:text-[#9ca3af] focus:border-black focus:ring-0 resize-none"
                                        placeholder="Add delivery instructions or special requests..."></textarea>

                                </div>

                            </div>

                        </div>

                        <!-- Payment -->
                        <div>

                            <h2 class="hero-title text-[24px] sm:text-[32px] text-[#1f1f1f] mb-6 sm:mb-8">

                                Card Details

                            </h2>

                            <!-- Secure Box -->
                            <div
                                class="flex items-start sm:items-center gap-3 rounded-[18px] sm:rounded-[22px] bg-[#f8f7f4] border border-black/10 px-5 py-4 mb-6">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[#1f1f1f]">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />

                                </svg>

                                <p class="text-sm text-[#6f675d]">

                                    Secure SSL Encrypted Payment

                                </p>

                            </div>

                            <div class="space-y-6">

                                <!-- Card Holder -->
                                <div>

                                    <label class="block text-sm text-[#6f675d] mb-3">

                                        Card Holder Name

                                    </label>

                                    <input type="text" name="card_holder" required
                                        class="w-full h-[50px] sm:h-[56px] rounded-2xl border border-black/10 bg-[#f8f7f4] px-5 text-[#1f1f1f] placeholder:text-[#9ca3af] focus:border-black focus:ring-0"
                                        placeholder="">

                                    @error('card_holder')
                                        <p class="text-red-500 text-sm mt-2">

                                            {{ $message }}

                                        </p>
                                    @enderror

                                </div>

                                <!-- Card Number -->
                                <div>

                                    <label class="block text-sm text-[#6f675d] mb-3">

                                        Card Number

                                    </label>

                                    <input type="text" name="card_number" required maxlength="19"
                                        class="w-full h-[50px] sm:h-[56px] rounded-2xl border border-black/10 bg-[#f8f7f4] px-5 text-[#1f1f1f] placeholder:text-[#9ca3af] focus:border-black focus:ring-0"
                                        placeholder="1234 5678 9012 3456" oninput="formatCardNumber(this)">

                                    @error('card_number')
                                        <p class="text-red-500 text-sm mt-2">

                                            {{ $message }}

                                        </p>
                                    @enderror

                                </div>

                                <!-- Expiry + CVV -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                    <!-- Expiry -->
                                    <div>

                                        <label class="block text-sm text-[#6f675d] mb-3">

                                            Expiry Date

                                        </label>

                                        <input type="text" name="expiry_date" required maxlength="5"
                                            class="w-full h-[50px] sm:h-[56px] rounded-2xl border border-black/10 bg-[#f8f7f4] px-5 text-[#1f1f1f] placeholder:text-[#9ca3af] focus:border-black focus:ring-0"
                                            placeholder="MM/YY" oninput="formatExpiryDate(this)">

                                        @error('expiry_date')
                                            <p class="text-red-500 text-sm mt-2">

                                                {{ $message }}

                                            </p>
                                        @enderror

                                    </div>

                                    <!-- CVV -->
                                    <div>

                                        <label class="block text-sm text-[#6f675d] mb-3">

                                            CVV

                                        </label>

                                        <input type="password" name="cvv" required maxlength="3"
                                            class="w-full h-[50px] sm:h-[56px] rounded-2xl border border-black/10 bg-[#f8f7f4] px-5 text-[#1f1f1f] placeholder:text-[#9ca3af] focus:border-black focus:ring-0"
                                            placeholder="123">

                                        @error('cvv')
                                            <p class="text-red-500 text-sm mt-2">

                                                {{ $message }}

                                            </p>
                                        @enderror

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Save -->
                        <div class="flex items-start sm:items-center gap-3">

                            <input type="checkbox" name="save_info"
                                class="w-5 h-5 rounded border-black/20 text-black focus:ring-0">

                            <label class="text-[#6f675d]">

                                Save this information for next time

                            </label>

                        </div>

                        <!-- Buttons -->
                        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 pt-2 sm:pt-4">

                            <a href="{{ route('cart.index') }}"
                                class="hero-title w-full sm:w-auto h-[48px] sm:h-[56px] px-6 sm:px-8 rounded-xl sm:rounded-2xl border border-black/10 hover:bg-black hover:text-white transition duration-300 flex items-center justify-center">

                                ← Back To Cart

                            </a>

                            <button type="submit"
                                class="hero-title w-full sm:w-auto h-[48px] sm:h-[56px] px-6 sm:px-10 rounded-xl sm:rounded-2xl bg-black text-white hover:bg-neutral-800 transition duration-300 flex items-center justify-center">

                                Complete Purchase

                            </button>

                        </div>

                    </form>

                </div>

                <!-- Summary -->
                <div class="bg-white rounded-[24px] sm:rounded-[32px] border border-black/5 p-5 sm:p-8 xl:sticky xl:top-24">

                    <h2 class="hero-title text-[24px] sm:text-[32px] text-[#1f1f1f] mb-6 sm:mb-8">

                        Order Summary

                    </h2>

                    @php

                        $settings = \App\Models\Setting::getSettings();
                        $subtotal = 0;

                        $cartItems = auth()->user()->cart?->items ?? collect();

                        foreach ($cartItems as $item) {
                            $subtotal += ($item->product->price ?? 0) * $item->quantity;
                        }

                        $shipping = $subtotal >= $settings->free_shipping_minimum ? 0 : $settings->shipping_price;

                        $total = $subtotal + $shipping;

                    @endphp

                    <!-- Items -->
                    <div class="space-y-5 mb-8">

                        @foreach ($cartItems as $item)
                            <div class="flex items-center justify-between gap-4">

                                <div class="flex items-center gap-4 min-w-0">

                                    <!-- Image -->
                                    <div class="w-16 h-16 rounded-[18px] overflow-hidden bg-[#f3f1ec] flex-shrink-0">

                                        @if ($item->product->images->first())
                                            <img src="{{ $item->product->images->first()->image_url) }}"
                                                class="w-full h-full object-cover">
                                        @endif

                                    </div>

                                    <!-- Info -->
                                    <div class="min-w-0">

                                        <h3 class="text-[15px] font-semibold text-[#1f1f1f] line-clamp-1">

                                            {{ $item->product->name }}

                                        </h3>

                                        <p class="text-sm text-[#8b8175] mt-1">

                                            Qty: {{ $item->quantity }}

                                        </p>

                                    </div>

                                </div>

                                <!-- Price -->
                                <span class="number-font text-[18px] text-[#1f1f1f]">

                                    {{ number_format($item->product->price * $item->quantity, 2) }}<span class="text-[6px] sm:text-[8px]">SAR</span>

                                </span>

                            </div>
                        @endforeach

                    </div>

                    <!-- Totals -->
                    <div class="space-y-5 border-t border-black/10 pt-6">

                        <div class="flex items-center justify-between text-[17px]">

                            <span class="text-[#6f675d]">

                                Subtotal

                            </span>

                            <span class="number-font text-[#1f1f1f]">

                                {{ number_format($subtotal, 2) }}<span class="text-[6px] sm:text-[8px]">SAR</span>

                            </span>

                        </div>

                        <div class="flex items-center justify-between text-[17px]">

                            <span class="text-[#6f675d]">

                                Shipping

                            </span>

                            <span class="number-font text-[#1f1f1f]">

                                @if ($shipping == 0)
                                    Free
                                @else
                                    {{ number_format($shipping, 2) }}<span class="text-[6px] sm:text-[8px]">SAR</span>
                                @endif

                            </span>

                        </div>

                        <div class="border-t border-black/10 pt-5 flex items-center justify-between">

                            <span class="hero-title text-[28px] text-[#1f1f1f]">

                                Total

                            </span>

                            <span class="number-font text-[24px] sm:text-[30px] text-[#1f1f1f]">

                                {{ number_format($total, 2) }}<span class="text-[8px] sm:text-[10px]">SAR</span>

                            </span>

                        </div>

                    </div>

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

        </div>

    </div>

    <script>
        function formatCardNumber(input) {

            let value = input.value.replace(/\D/g, '').substring(0, 16);

            value = value.replace(/(.{4})/g, '$1 ').trim();

            input.value = value;
        }

        function formatExpiryDate(input) {

            let value = input.value.replace(/\D/g, '').substring(0, 4);

            if (value.length >= 2) {

                value = value.substring(0, 2) + '/' + value.substring(2);
            }

            input.value = value;
        }
    </script>

</x-app-layout>
