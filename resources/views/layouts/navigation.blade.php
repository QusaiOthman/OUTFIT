<nav x-data="{ open: false }" class="bg-white/70 backdrop-blur-xl border-b border-black/5 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20 sm:h-24">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">

                        <img src="{{ asset('images/logo.png') }}" alt="Outfit Logo"
                            class="h-12 w-12 sm:h-16 sm:w-16 object-contain transition hover:scale-105">

                        <span class="text-2xl sm:text-3xl font-extrabold tracking-wide text-neutral-900 hero-title">
                            OUTFIT
                        </span>

                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center gap-8 lg:gap-10 ms-10">

                    <a href="{{ route('products.index') }}"
                        class="text-neutral-700 hover:text-black text-neutral-700 hover:text-black font-semibold transition duration-200">
                        PRODUCTS
                    </a>

                    <a href="{{ route('categories.index') }}"
                        class="text-neutral-700 hover:text-black text-neutral-700 hover:text-black font-semibold transition duration-200">
                        CATEGORIES
                    </a>

                    @auth


                        <a href="{{ route('orders.index') }}"
                            class="text-neutral-700 hover:text-black text-neutral-700 hover:text-black font-semibold transition duration-200">
                            ORDERS
                        </a>
                        <a href="{{ route('cart.index') }}" class="relative">

                            <!-- Cart Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386a1.125 1.125 0 0 1 1.11.98l.383 2.681M7.5 14.25a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm9 0a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-9-3h9.75a1.125 1.125 0 0 0 1.102-.904l1.35-6.75a1.125 1.125 0 0 0-1.102-1.346H5.106" />

                            </svg>

                            <!-- Counter -->
                            @auth
                                @php
                                    $cartCount = auth()->user()->cart?->items()->sum('quantity') ?? 0;
                                @endphp

                                @if ($cartCount > 0)
                                    <span
                                        class="absolute -top-2 -right-2 min-w-[18px] h-[18px] px-1 rounded-full bg-black text-white text-[10px] flex items-center justify-center font-medium">

                                        {{ $cartCount }}

                                    </span>
                                @endif

                            @endauth

                        </a>
                        <a href="{{ route('wishlist') }}"
                            class="relative flex items-center justify-center w-11 h-11 rounded-full border border-black/10 hover:bg-black hover:text-white transition duration-300">
                            ♥
                            @auth
                                @php
                                    $wishlistCount = auth()->user()->wishlistItems()->count();
                                @endphp
                                @if ($wishlistCount > 0)
                                    <span
                                        class="absolute -top-1 -right-1 w-5 h-5 rounded-full bg-black text-white text-[10px] flex items-center justify-center">

                                        {{ $wishlistCount }}

                                    </span>
                                @endif
                            @endauth
                        </a>


                        @if (auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}"
                                class="hidden lg:block text-red-600 hover:text-red-800 font-semibold transition whitespace-nowrap">
                                ADMIN
                            </a>
                        @endif
                    @endauth

                </div>
            </div>

            @auth

                <!-- Profile Dropdown -->
                <div class="relative">

                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-2 lg:gap-3 px-2 lg:px-4 py-2 rounded-2xl transition">

                        <!-- Avatar -->
                        <div class="w-9 h-9 lg:w-10 lg:h-10 rounded-full overflow-hidden shadow">

                            @if (Auth::user()->image)
                                <img src="{{ Auth::user()->image }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-black text-white flex items-center justify-center font-bold">

                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                                </div>
                            @endif

                        </div>

                        <!-- Name -->
                        <div class="hidden xl:block text-left">

                            <p class="text-sm font-semibold text-gray-800 leading-none">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-xs text-gray-500 mt-1">
                                Account
                            </p>

                        </div>

                    </a>

                </div>
            @else
                <!-- Guest Buttons -->
                <div class="hidden sm:flex items-center gap-3">

                    <a href="{{ route('login') }}"
                        class="px-5 py-2 rounded-xl text-gray-700 hover:text-black transition font-medium">

                        Login

                    </a>


                    <a href="{{ route('register') }}"
                        class="px-5 py-2 rounded-xl text-gray-700 hover:text-black transition font-medium">

                        Register

                    </a>

                </div>

            @endauth

            <!-- Hamburger -->
            <div class="-me-2 flex items-center md:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-neutral-700 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden">
        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link :href="route('products.index')">
                Products
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('categories.index')">
                Categories
            </x-responsive-nav-link>

            @auth

                <x-responsive-nav-link :href="route('cart.index')">
                    Cart
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('orders.index')">
                    Orders
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('wishlist')">
                    Wishlist
                </x-responsive-nav-link>

                @if (auth()->user()->is_admin)
                    <x-responsive-nav-link :href="route('admin.dashboard')">
                        Admin
                    </x-responsive-nav-link>
                @endif

            @endauth

        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            @auth

                <div class="px-4">

                    <div class="font-medium text-base text-gray-800">
                        {{ Auth::user()->name }}
                    </div>

                    <div class="font-medium text-sm text-gray-500">
                        {{ Auth::user()->email }}
                    </div>

                </div>

            @endauth
            @guest

                <div class="pt-4 pb-3 border-t border-gray-200">

                    <div class="flex flex-col gap-3 px-4">

                        <a href="{{ route('login') }}"
                            class="w-full text-center py-3 rounded-xl border border-black/10 text-black font-semibold">

                            Login

                        </a>

                        <a href="{{ route('register') }}"
                            class="w-full text-center py-3 rounded-xl bg-black hover:bg-neutral-800 text-white font-semibold">

                            Register

                        </a>

                    </div>

                </div>

            @endguest
            @auth



                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>
