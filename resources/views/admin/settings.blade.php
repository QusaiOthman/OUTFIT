@extends('admin.layout')

@section('content')
    <div class="mb-10">

        <p class="uppercase tracking-[5px] text-[#b08b68] text-xs mb-3">
            Admin Settings
        </p>

        <h1 class="hero-title text-4xl md:text-5xl xl:text-[70px] leading-none text-[#1a1a1a]">
            Store Settings
        </h1>

    </div>

    @if (session('success'))
        <div class="mb-8 rounded-[24px] border border-green-200 bg-green-50 px-6 py-5 text-green-700">

            {{ session('success') }}

        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST"
        class="bg-white border border-[#ece5dc] rounded-[24px] md:rounded-[36px] p-5 md:p-8 lg:p-10">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Shipping Price -->
            <div>

                <label class="block text-sm tracking-[2px] md:tracking-[3px] uppercase text-[#8b8175] mb-4">

                    Shipping Price

                </label>

                <input type="number" step="0.01" name="shipping_price" value="{{ $settings->shipping_price }}"
                    class="w-full h-[54px] md:h-[58px] rounded-2xl border border-[#ece5dc] bg-[#f8f4ef] px-5 focus:ring-0 focus:border-black/20">

                <p class="text-xs md:text-sm text-[#8b8175] mt-3 leading-relaxed">

                    Standard shipping cost for orders below the minimum threshold.

                </p>

            </div>

            <!-- Free Shipping Minimum -->
            <div>

                <label class="block text-sm tracking-[2px] md:tracking-[3px] uppercase text-[#8b8175] mb-4">

                    Free Shipping Minimum

                </label>

                <input type="number" step="0.01" name="free_shipping_minimum"
                    value="{{ $settings->free_shipping_minimum }}"
                    class="w-full h-[54px] md:h-[58px] rounded-2xl border border-[#ece5dc] bg-[#f8f4ef] px-5 focus:ring-0 focus:border-black/20">

                <p class="text-xs md:text-sm text-[#8b8175] mt-3 leading-relaxed">

                    Orders above this amount will receive free shipping.

                </p>

            </div>

            <!-- Premium Customer Minimum -->
            <!-- Premium -->
            <div>

                <label class="block text-sm tracking-[2px] md:tracking-[3px] uppercase text-[#8b8175] mb-4">

                    Premium Customer Minimum

                </label>

                <input type="number" step="0.01" name="premium_customer_minimum"
                    value="{{ $settings->premium_customer_minimum }}"
                    class="w-full h-[54px] md:h-[58px] rounded-2xl border border-[#ece5dc] bg-[#f8f4ef] px-5 focus:ring-0 focus:border-black/20">

            </div>

            <!-- VIP -->
            <div>

                <label class="block text-sm tracking-[2px] md:tracking-[3px] uppercase text-[#8b8175] mb-4">

                    VIP Customer Minimum

                </label>

                <input type="number" step="0.01" name="vip_customer_minimum"
                    value="{{ $settings->vip_customer_minimum }}"
                    class="w-full h-[54px] md:h-[58px] rounded-2xl border border-[#ece5dc] bg-[#f8f4ef] px-5 focus:ring-0 focus:border-black/20">

            </div>

            <!-- Elite -->
            <div>

                <label class="block text-sm tracking-[2px] md:tracking-[3px] uppercase text-[#8b8175] mb-4">

                    Elite Customer Minimum

                </label>

                <input type="number" step="0.01" name="elite_customer_minimum"
                    value="{{ $settings->elite_customer_minimum }}"
                    class="w-full h-[54px] md:h-[58px] rounded-2xl border border-[#ece5dc] bg-[#f8f4ef] px-5 focus:ring-0 focus:border-black/20">

            </div>


        </div>

        <!-- Save -->
        <div class="mt-10 flex justify-stretch md:justify-end">

            <button type="submit"
                class="hero-title w-full md:w-auto h-[54px] md:h-[58px] px-8 md:px-10 rounded-[18px] md:rounded-[22px] bg-black text-white hover:bg-neutral-800 transition">

                Save Settings

            </button>

        </div>

    </form>
@endsection
