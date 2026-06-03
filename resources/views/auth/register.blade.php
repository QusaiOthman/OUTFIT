<x-guest-layout>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400..800&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=BJCree:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@1,100..900&display=swap" rel="stylesheet">

    <div class="min-h-screen bg-[#d4c2b1] lg:grid lg:grid-cols-2 relative overflow-hidden">

        <!-- Mobile & Tablet Background -->
        <div class="absolute inset-0 lg:hidden">

            <img src="{{ asset('images/auth-cover2.png') }}" class="w-full h-full object-cover">

            <div class="absolute inset-0 bg-black/20"></div>

        </div>

        <!-- LEFT -->
        <div class="relative hidden lg:block overflow-hidden">

            <!-- Image -->
            <img src="{{ asset('images/auth-cover2.png') }}"
                class="absolute inset-0 w-full h-full object-cover object-center">

            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/20"></div>

            <!-- Content -->
            <div class="relative z-10 h-full flex flex-col justify-between p-14">

                <!-- Logo -->
                <div>

                    <a href="{{ route('home') }}" class="hero-title uppercase text-white text-4xl">

                        Outfit

                    </a>

                </div>

                <!-- Text -->
                <div class="max-w-xl">

                    <p class="uppercase tracking-[6px] text-white/70 text-sm mb-6">
                        Join Outfit
                    </p>

                    <h1 class="hero-title text-white text-6xl leading-[0.95] mb-8">
                        Create Your Account
                    </h1>

                    <p class="section-description-font text-white/80 text-xl leading-relaxed max-w-lg">
                        Discover curated fashion collections and build your perfect wardrobe experience
                    </p>

                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="relative z-10 flex items-start justify-center px-4 sm:px-6 pt-6 sm:pt-10 pb-6">

            <div class="w-full max-w-md lg:max-w-lg">

                <!-- Mobile Logo -->
                <div class="lg:hidden mb-7 text-center">

                    <a href="{{ route('home') }}" class="hero-title uppercase text-4xl sm:text-5xl text-white">

                        Outfit

                    </a>

                </div>
                <div class="lg:hidden text-center mb-6">

                    <p class="uppercase tracking-[4px] text-white/70 text-sm">

                        Join Outfit

                    </p>

                </div>

                <!-- Form Card -->
                <div
                    class="bg-[#e6d7c8]/95 backdrop-blur-2xl rounded-[28px] sm:rounded-[40px] border border-[#cfb9a7] shadow-[0_30px_120px_rgba(71,44,20,0.16)] p-5 sm:p-7 md:p-8">

                    <!-- Heading -->
                    <div class="mb-7">

                        <p class="uppercase tracking-[4px] text-[#8b8175] text-sm mb-4">
                            New Account
                        </p>

                        <h2 class="hero-title text-3xl sm:text-4xl text-[#1f1f1f] mb-4">
                            Register
                        </h2>

                        <p class="section-description-font text-[#6a5648] text-sm sm:text-base">
                            Create your account and start shopping
                        </p>

                    </div>

                    <!-- Errors -->
                    @if ($errors->any())

                        <div class="text-red-500 text-sm">

                            <ul class="space-y-2">

                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <!-- Form -->
                    <form method="POST" action="{{ route('register') }}" class="space-y-4">

                        @csrf

                        <!-- Name -->
                        <div>

                            <p class="uppercase tracking-[2px] text-[#8b8175] text-xs mb-2">
                                Full Name
                            </p>

                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full h-[48px] sm:h-[50px] rounded-xl border border-black/5 bg-[#f4ece4] backdrop-blur-md px-5 focus:ring-0 focus:border-black/30 transition duration-300 focus:scale-[1.01]">

                        </div>

                        <!-- Email -->
                        <div>

                            <p class="uppercase tracking-[2px] text-[#8b8175] text-xs mb-2">
                                Email Address
                            </p>

                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="w-full h-[48px] sm:h-[50px] rounded-xl border border-black/5 bg-[#f4ece4] backdrop-blur-md px-5 focus:ring-0 focus:border-black/30 transition duration-300 focus:scale-[1.01]">

                        </div>

                        <!-- Password -->
                        <div>

                            <p class="uppercase tracking-[2px] text-[#8b8175] text-xs mb-2">
                                Password
                            </p>

                            <input type="password" name="password" required
                                class="w-full h-[48px] sm:h-[50px] rounded-xl border border-black/5 bg-[#f4ece4] backdrop-blur-md px-5 focus:ring-0 focus:border-black/30 transition duration-300 focus:scale-[1.01]">

                        </div>

                        <!-- Confirm Password -->
                        <div>

                            <p class="uppercase tracking-[2px] text-[#8b8175] text-xs mb-2">
                                Confirm Password
                            </p>

                            <input type="password" name="password_confirmation" required
                                class="w-full h-[48px] sm:h-[50px] rounded-xl border border-black/5 bg-[#f4ece4] backdrop-blur-md px-5 focus:ring-0 focus:border-black/30 transition duration-300 focus:scale-[1.01]">

                        </div>

                        <!-- Button -->
                        <button type="submit"
                            class="hero-title w-full h-[52px] sm:h-[56px] text-base sm:text-lg tracking-wide rounded-xl bg-[#111111] text-white hover:bg-black hover:scale-[1.01] active:scale-[0.99] transition duration-300 shadow-[0_10px_30px_rgba(0,0,0,0.15)]">

                            Create Account

                        </button>

                    </form>

                    <!-- Divider -->
                    <div class="my-8 h-px bg-black/5"></div>

                    <!-- Login -->
                    <div class="text-center">

                        <p class="hero-title text-[#6a5648]">

                            Already have an account?

                            <a href="{{ route('login') }}" class="text-black font-semibold hover:underline">

                                Login

                            </a>

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-guest-layout>
