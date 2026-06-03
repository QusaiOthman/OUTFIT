<x-guest-layout>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=BJCree:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@1,100..900&display=swap" rel="stylesheet">

    <div class="min-h-screen bg-[#cdb8a3] flex items-center justify-center px-4 sm:px-6">

        <div
            class="w-full max-w-md sm:max-w-lg bg-[#efe4d8] rounded-[40px] border border-[#e0d8ce] shadow-[0_25px_90px_rgba(0,0,0,0.12)] p-6 sm:p-10 md:p-12">

            <!-- Logo -->
            <div class="text-center mb-8">

                <a href="{{ route('home') }}"
                    class="hero-title text-4xl sm:text-5xl uppercase text-[#1f1f1f]">

                    Outfit

                </a>

            </div>

            <!-- Label -->
            <p class="uppercase tracking-[4px] text-[#8b8175] text-sm mb-4 text-center">

                Security Check

            </p>

            <!-- Title -->
            <h1 class="hero-title text-4xl sm:text-5xl text-[#1f1f1f] text-center mb-6">

                Confirm Password

            </h1>

            <!-- Description -->
            <p
                class="section-description-font text-[#6d5848] text-base sm:text-lg leading-relaxed text-center mb-10">

                Please confirm your password before continuing to this secure area.

            </p>

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">

                @csrf

                <!-- Password -->

                <div>

                    <label class="block uppercase tracking-[4px] text-[#8b8175] text-xs mb-4">

                        Password

                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="w-full h-[56px] sm:h-[64px] rounded-[22px] border border-black/5 bg-white/80 px-6 text-lg text-[#1f1f1f] focus:border-black focus:ring-0 transition duration-300">

                    <x-input-error :messages="$errors->get('password')" class="mt-3" />

                </div>

                <!-- Button -->

                <button
                    type="submit"
                    class="hero-title w-full h-[56px] sm:h-[64px] rounded-[22px] bg-black text-white text-lg sm:text-xl hover:bg-neutral-800 transition duration-300">

                    Confirm Password

                </button>

            </form>

        </div>

    </div>

</x-guest-layout>