<x-app-layout>

    <div class="bg-[#f8f7f4] min-h-screen pt-32 pb-24">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">

            <!-- HERO -->
            <section class="relative overflow-hidden rounded-[40px] bg-[#1a1a1a] mb-14">

                <div
                    class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.12),transparent_35%)]">
                </div>

                <div
                    class="relative z-10 p-5 sm:p-8 lg:p-14 flex flex-col xl:flex-row xl:items-center xl:justify-between gap-8">

                    <!-- LEFT -->
                    <div class="flex flex-col sm:flex-row sm:items-center gap-6 text-center sm:text-left">

                        <!-- Avatar -->
                        <div class="relative">

                            @if (auth()->user()->image)
                                <img src="{{ auth()->user()->image }}"
                                    class="w-24 h-24 sm:w-28 sm:h-28 rounded-full object-cover border-4 border-white/10">
                            @else
                                <div
                                    class="w-24 h-24 sm:w-28 sm:h-28 rounded-full bg-white/10 border border-white/10 backdrop-blur-md flex items-center justify-center text-white text-2xl sm:text-3xl lg:text-4xl hero-title">

                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                                </div>
                            @endif

                            <!-- Upload -->
                            <form action="{{ route('profile.image') }}" method="POST" enctype="multipart/form-data"
                                class="absolute -bottom-2 -right-2">

                                @csrf

                                <label
                                    class="w-10 h-10 rounded-full bg-white text-black flex items-center justify-center cursor-pointer hover:scale-105 transition duration-300">

                                    +

                                    <input type="file" name="image" class="hidden" onchange="this.form.submit()">

                                </label>

                            </form>

                        </div>

                        <!-- Info -->
                        <div>

                            <p class="uppercase tracking-[4px] text-white/50 text-sm mb-3">
                                Your Profile
                            </p>

                            <h1 class="hero-title text-white text-3xl sm:text-4xl lg:text-5xl leading-tight mb-3">
                                {{ auth()->user()->name }}
                            </h1>

                            <p class="section-description-font text-white/70 text-lg">
                                {{ auth()->user()->email }}
                            </p>

                            <p class="text-white/40 text-sm mt-3">
                                Joined {{ auth()->user()->created_at->format('F Y') }}
                            </p>

                        </div>

                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 sm:flex sm:flex-wrap gap-4 w-full xl:w-auto">

                        <div
                            class="text-center w-full sm:min-w-[150px] h-[110px] sm:h-[120px] rounded-[28px] bg-white/10 backdrop-blur-md border border-white/10 p-6 flex flex-col justify-between">

                            <p class="uppercase tracking-[3px] text-white/50 text-xs">
                                Orders
                            </p>

                            <h2 class="hero-title  text-white text-2xl sm:text-3xl lg:text-4xl">
                                {{ auth()->user()->orders()->count() }}
                            </h2>

                        </div>

                        <div
                            class="text-center w-full sm:min-w-[150px] h-[110px] sm:h-[120px] rounded-[28px] bg-white/10 backdrop-blur-md border border-white/10 p-6 flex flex-col justify-between">

                            <p class="uppercase tracking-[3px] text-white/50 text-xs">
                                Wishlist
                            </p>

                            <h2 class="hero-title text-white text-2xl sm:text-3xl lg:text-4xl">
                                {{ auth()->user()->wishlistItems()->count() }}
                            </h2>

                        </div>

                    </div>

                </div>

            </section>

            <!-- GRID -->
            <div class="grid grid-cols-1 2xl:grid-cols-3 gap-6 lg:gap-8">

                <!-- LEFT -->
                <div class="xl:col-span-2 space-y-8">

                    <!-- ACCOUNT -->
                    <div x-data="{ editing: false }"
                        class="bg-white rounded-[32px] border border-black/5 p-5 sm:p-6 lg:p-8">

                        <div class="flex items-center justify-between mb-10">

                            <div>

                                <p class="uppercase tracking-[4px] text-[#8b8175] text-xs mb-3">
                                    Account
                                </p>

                                <h2 class="hero-title text-2xl sm:text-3xl lg:text-4xl text-[#1f1f1f]">
                                    Information
                                </h2>

                            </div>

                            <button @click="editing = !editing"
                                class="hero-title h-[50px] px-6 rounded-2xl border border-black/10 hover:bg-black hover:text-white transition duration-300">

                                <span x-show="!editing">Edit</span>
                                <span x-show="editing">Cancel</span>

                            </button>

                        </div>

                        <!-- VIEW -->
                        <div x-show="!editing" class="space-y-8">

                            <div>

                                <p class="uppercase tracking-[3px] text-[#8b8175] text-xs mb-3">
                                    Full Name
                                </p>

                                <div
                                    class="h-[58px] rounded-2xl bg-[#f3f1ec] px-5 flex items-center text-[#1f1f1f] text-lg">
                                    {{ auth()->user()->name }}
                                </div>

                            </div>

                            <div>

                                <p class="uppercase tracking-[3px] text-[#8b8175] text-xs mb-3">
                                    Email Address
                                </p>

                                <div
                                    class="h-[58px] rounded-2xl bg-[#f3f1ec] px-5 flex items-center text-[#1f1f1f] text-lg break-words">
                                    {{ auth()->user()->email }}
                                </div>

                            </div>
                            <div>

                                <p class="uppercase tracking-[3px] text-[#8b8175] text-xs mb-3">
                                    Phone Number
                                </p>

                                <div
                                    class="h-[58px] rounded-2xl bg-[#f3f1ec] px-5 flex items-center text-[#1f1f1f] text-lg">
                                    {{ auth()->user()->phone ?? 'N/A' }}
                                </div>

                            </div>
                            <div>

                                <p class="uppercase tracking-[3px] text-[#8b8175] text-xs mb-3">
                                    Address
                                </p>

                                <div
                                    class="h-[58px] rounded-2xl bg-[#f3f1ec] px-5 flex items-center text-[#1f1f1f] text-lg break-words">
                                    {{ auth()->user()->address ?? 'N/A' }}
                                </div>

                            </div>

                        </div>

                        <!-- EDIT -->
                        <form x-show="editing" action="{{ route('profile.update') }}" method="POST" class="space-y-6">

                            @csrf
                            @method('PATCH')

                            <div>

                                <p class="uppercase tracking-[3px] text-[#8b8175] text-xs mb-3">
                                    Full Name
                                </p>

                                <input type="text" name="name" value="{{ auth()->user()->name }}"
                                    class="text-sm sm:text-base w-full h-[58px] rounded-2xl border border-black/10 bg-[#f3f1ec] px-5 focus:ring-0 focus:border-black">

                            </div>

                            <div>

                                <p class="uppercase tracking-[3px] text-[#8b8175] text-xs mb-3">
                                    Email Address
                                </p>

                                <input type="email" name="email" value="{{ auth()->user()->email }}"
                                    class="text-sm sm:text-base w-full h-[58px] rounded-2xl border border-black/10 bg-[#f3f1ec] px-5 focus:ring-0 focus:border-black">

                            </div>
                            <div>

                                <p class="uppercase tracking-[3px] text-[#8b8175] text-xs mb-3">
                                    Phone Number
                                </p>

                                <input type="text" name="phone" value="{{ auth()->user()->phone }}"
                                    class="text-sm sm:text-base w-full h-[58px] rounded-2xl border border-black/10 bg-[#f3f1ec] px-5 focus:ring-0 focus:border-black">

                            </div>
                            <div>

                                <p class="uppercase tracking-[3px] text-[#8b8175] text-xs mb-3">
                                    Address
                                </p>

                                <input type="text" name="address" value="{{ auth()->user()->address }}"
                                    class="text-sm sm:text-base w-full h-[58px] rounded-2xl border border-black/10 bg-[#f3f1ec] px-5 focus:ring-0 focus:border-black">

                            </div>

                            <button type="submit"
                                class="hero-title h-[52px] sm:h-[56px] px-8 rounded-2xl bg-black text-white hover:bg-neutral-800 transition duration-300">

                                Save Changes

                            </button>

                        </form>

                    </div>

                    <!-- PASSWORD -->
                    <div x-data="{ password: false }"
                        class="bg-white rounded-[32px] border border-black/5 p-5 sm:p-6 lg:p-8">

                        <div class="flex items-center justify-between mb-10">

                            <div>

                                <p class="uppercase tracking-[4px] text-[#8b8175] text-xs mb-3">
                                    Security
                                </p>

                                <h2 class="hero-title text-2xl sm:text-3xl lg:text-4xl text-[#1f1f1f]">
                                    Password
                                </h2>

                            </div>

                            <button @click="password = !password"
                                class="hero-title h-[50px] px-6 rounded-2xl border border-black/10 hover:bg-black hover:text-white transition duration-300">

                                <span x-show="!password">Edit</span>
                                <span x-show="password">Cancel</span>

                            </button>

                        </div>

                        <div x-show="!password">

                            <p class="section-description-font text-[#6f675d] text-lg">
                                Keep your account secure with a strong password.
                            </p>

                        </div>

                        <form x-show="password" action="{{ route('profile.password') }}" method="POST"
                            class="space-y-6">

                            @csrf
                            @method('PATCH')

                            <input type="password" name="current_password" placeholder="Current Password"
                                class="text-sm sm:text-base w-full h-[58px] rounded-2xl border border-black/10 bg-[#f3f1ec] px-5 focus:ring-0 focus:border-black">

                            <input type="password" name="password" placeholder="New Password"
                                class="text-sm sm:text-base w-full h-[58px] rounded-2xl border border-black/10 bg-[#f3f1ec] px-5 focus:ring-0 focus:border-black">

                            <input type="password" name="password_confirmation" placeholder="Confirm Password"
                                class="text-sm sm:text-base w-full h-[58px] rounded-2xl border border-black/10 bg-[#f3f1ec] px-5 focus:ring-0 focus:border-black">

                            <button type="submit"
                                class="hero-title h-[52px] sm:h-[56px] px-8 rounded-2xl bg-black text-white hover:bg-neutral-800 transition duration-300">

                                Save Password

                            </button>

                        </form>

                    </div>

                    <!-- DELETE ACCOUNT -->
                    <div x-data="{ deleting: false }"
                        class="bg-white rounded-[32px] border border-red-200 p-5 sm:p-6 lg:p-8">

                        <div class="flex items-center justify-between mb-8">

                            <div>

                                <p class="uppercase tracking-[4px] text-red-500 text-xs mb-3">
                                    Danger Zone
                                </p>

                                <h2 class="hero-title text-2xl sm:text-3xl lg:text-4xl text-[#1f1f1f]">
                                    Delete Account
                                </h2>

                            </div>

                            <button type="button" @click="deleting = !deleting"
                                class="hero-title h-[50px] px-6 rounded-2xl bg-red-500 text-white hover:bg-red-600 transition duration-300">

                                <span x-show="!deleting">Delete</span>
                                <span x-show="deleting">Cancel</span>

                            </button>

                        </div>

                        <p class="section-description-font text-[#6f675d] text-lg mb-8">
                            Once your account is deleted, all your data will be permanently removed.
                        </p>

                        <form x-show="deleting" action="{{ route('profile.destroy') }}" method="POST"
                            class="space-y-6">

                            @csrf
                            @method('DELETE')

                            <input required type="password" name="password" placeholder="Confirm Your Password"
                                class="text-sm sm:text-base w-full h-[58px] rounded-2xl border border-red-200 bg-[#fff5f5] px-5 focus:ring-0 focus:border-red-500">

                            @error('password')
                                <p class="text-red-500 text-sm">
                                    {{ $message }}
                                </p>
                            @enderror
                            <button type="submit"
                                class="hero-title h-[52px] sm:h-[56px] px-8 rounded-2xl bg-red-500 text-white hover:bg-red-600 transition duration-300">

                                Permanently Delete Account

                            </button>

                        </form>

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="space-y-8">

                    <!-- QUICK ACTIONS -->
                    <div class="bg-white rounded-[32px] border border-black/5 p-5 sm:p-6 lg:p-8">

                        <p class="uppercase tracking-[4px] text-[#8b8175] text-xs mb-3">
                            Navigation
                        </p>

                        <h2 class="hero-title text-2xl sm:text-3xl lg:text-4xl text-[#1f1f1f] mb-10">
                            Quick Actions
                        </h2>

                        <div class="space-y-4 text-sm sm:text-base">

                            <a href="{{ route('orders.index') }}"
                                class="hero-title h-[58px] rounded-2xl bg-black text-white hover:bg-neutral-800 transition duration-300 flex items-center justify-center w-full">

                                View Orders

                            </a>

                            <a href="{{ route('wishlist') }}"
                                class="hero-title h-[58px] rounded-2xl border border-black/10 hover:bg-black hover:text-white transition duration-300 flex items-center justify-center w-full">

                                Wishlist

                            </a>

                            <a href="{{ route('products.index') }}"
                                class="hero-title h-[58px] rounded-2xl border border-black/10 hover:bg-black hover:text-white transition duration-300 flex items-center justify-center w-full">

                                Continue Shopping

                            </a>

                            <!--logout-->
                            <form method="POST" action="{{ route('logout') }}">

                                @csrf

                                <button type="submit"
                                    class="hero-title h-[58px] rounded-2xl bg-red-500 text-white hover:bg-red-600 transition duration-300 flex items-center justify-center w-full">

                                    Logout

                                </button>

                            </form>

                        </div>


                    </div>

                    <!-- ADMIN -->
                    @if (auth()->user()->is_admin)
                        <div class="bg-[#1a1a1a] rounded-[32px] overflow-hidden relative">

                            <div
                                class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.1),transparent_40%)]">
                            </div>

                            <div class="relative z-10 p-5 sm:p-6 lg:p-8">

                                <p class="uppercase tracking-[4px] text-white/40 text-xs mb-3">
                                    Administration
                                </p>

                                <h2 class="hero-title text-white text-2xl sm:text-3xl lg:text-4xl mb-5">
                                    Admin Dashboard
                                </h2>

                                <p class="section-description-font text-white/60 mb-8 leading-relaxed">
                                    Manage products, categories and customer orders.
                                </p>

                                <a href="{{ route('admin.dashboard') }}"
                                    class="hero-title h-[52px] sm:h-[56px] rounded-2xl bg-white text-black hover:bg-[#f3f1ec] transition duration-300 flex items-center justify-center w-full">

                                    Open Dashboard

                                </a>

                            </div>

                        </div>
                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
