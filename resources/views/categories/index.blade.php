<x-app-layout>

    <div class="bg-[#f8f7f4] min-h-screen pb-20 sm:pb-24">

        <!-- Hero -->
        <section class="relative w-full h-[320px] sm:h-[520px] lg:h-[760px] overflow-hidden mb-10 sm:mb-20">

            <!-- Background -->
            <img src="{{ asset('images/categories-hero.png') }}"
                class="absolute inset-0 w-full h-full object-cover object-[78%_center] sm:object-center">

            <!-- Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/35 to-transparent"></div>

            <!-- Glow -->
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_left,rgba(255,255,255,0.10),transparent_55%)]">
            </div>

            <!-- Content -->
            <div class="relative z-10 h-full max-w-7xl mx-auto px-5 sm:px-6 lg:px-10 flex items-center">

                <div class="max-w-[230px] sm:max-w-2xl">

                    <!-- Subtitle -->
                    <p
                        class="uppercase tracking-[3px] sm:tracking-[6px] text-white/70 text-[9px] sm:text-sm mb-2 sm:mb-6">

                        CURATED FASHION COLLECTIONS

                    </p>

                    <!-- Title -->
                    <h1 class="hero-title text-white text-[28px] sm:text-6xl md:text-8xl leading-[0.95]">

                        Find Your
                        Signature Style

                    </h1>

                    <!-- Description -->
                    <p
                        class="section-description-font text-white/75 text-[12px] sm:text-lg md:text-xl leading-relaxed mt-3 sm:mt-8">

                        Explore carefully selected categories crafted for every mood, season, and aesthetic

                    </p>

                    <!-- Button -->
                    <div class="mt-5 sm:mt-10">

                        <a href="#categories"
                            class="hero-title inline-flex items-center gap-2 px-4 sm:px-7 h-[40px] sm:h-[56px] rounded-xl sm:rounded-2xl bg-white text-black text-xs sm:text-lg hover:bg-neutral-200 transition duration-300">

                            Explore Categories

                        </a>

                    </div>

                </div>

            </div>

        </section>

        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-10">

            <!-- Header -->
            <div class="flex items-center justify-between mb-8 sm:mb-14">

                <div>

                    <p class="uppercase tracking-[4px] text-[#8b8175] text-[11px] sm:text-sm mb-3 sm:mb-4">

                        Shop By Category

                    </p>

                    <h2 class="hero-title text-3xl sm:text-4xl lg:text-5xl text-[#1f1f1f]">

                        Categories

                    </h2>

                </div>

            </div>

            <!-- Categories Grid -->
            <div id="categories" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 sm:gap-7 lg:gap-8">

                @foreach ($categories as $cat)
                    <a href="{{ route('products.index', ['category' => $cat->id]) }}"
                        class="group relative h-[380px] sm:h-[420px] lg:h-[460px] rounded-[26px] sm:rounded-[32px] overflow-hidden bg-[#f6f1eb] shadow-[0_15px_40px_rgba(0,0,0,0.06)]">

                        <!-- Background Image -->
                        <div class="absolute inset-0">

                            @if ($cat->image)
                                <img src="{{ asset('storage/' . $cat->image) }}"
                                    class="w-full h-full object-cover object-top sm:object-center transition duration-700 group-hover:scale-105">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-[#ece7df] via-[#f5f2ec] to-[#e9e4dc]">
                                </div>
                            @endif

                        </div>

                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/20 to-transparent"></div>

                        <!-- Content -->
                        <div class="absolute bottom-0 left-0 w-full p-5 sm:p-7 z-10">

                            <!-- Name -->
                            <h3 class="hero-title text-white text-3xl sm:text-4xl font-bold leading-none">

                                {{ $cat->name }}

                            </h3>

                            <!-- Products Count -->
                            <p class="section-description-font text-gray-200 text-sm sm:text-base mt-3">

                                {{ $cat->products_count }} Products

                            </p>

                            <!-- Button -->
                            <div class="mt-5">

                                <span
                                    class="hero-title inline-flex items-center gap-2 px-4 sm:px-5 py-2.5 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 text-white text-sm sm:text-base font-semibold group-hover:bg-white group-hover:text-black transition duration-300">

                                    Explore

                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
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

        </div>

    </div>

    @include('layouts.footer')

</x-app-layout>
