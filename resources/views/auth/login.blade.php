<x-guest-layout>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=BJCree:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&display=swap"rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@1,100..900&display=swap" rel="stylesheet">



    <div class="min-h-screen bg-[#cdb8a3] lg:grid lg:grid-cols-2 relative overflow-hidden">

        <!-- Mobile & Tablet Background -->
        <div class="absolute inset-0 lg:hidden">

            <img src="{{ asset('images/auth-cover.png') }}" class="w-full h-full object-cover">

            <div class="absolute inset-0 bg-black/30"></div>

        </div>
        <!-- LEFT -->
        <div class="relative hidden lg:block overflow-hidden">

            <img src="{{ asset('images/auth-cover.png') }}" class="absolute inset-0 w-full h-full object-cover">

            <div class="absolute inset-0 bg-black/45"></div>

            <div class="relative z-10 h-full flex flex-col justify-between p-14">

                <div>

                    <a href="{{ route('home') }}" class="hero-title uppercase text-white text-3xl xl:text-4xl">

                        Outfit

                    </a>

                </div>

                <div>

                    <p class="uppercase tracking-[6px] text-white/60 text-sm mb-6">
                        Welcome Back
                    </p>

                    <h1 class="hero-title text-white text-6xl xl:text-7xl leading-none max-w-lg mb-8">
                        Style Starts Here
                    </h1>

                    <p class="section-description-font text-white/75 text-xl leading-relaxed max-w-lg">
                        Sign in to continue exploring curated fashion collections tailored for your style
                    </p>

                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="relative z-10 flex items-center justify-center px-4 sm:px-6 py-4 sm:py-8">

            <div class="w-full max-w-md lg:max-w-xl">

                <!-- Mobile Logo -->
                <div class="lg:hidden mb-10 text-center">

                    <a href="{{ route('home') }}" class="hero-title uppercase text-4xl sm:text-4xl sm:text-5xl text-white">

                        Outfit

                    </a>

                </div>
                

                <div
                    class="bg-[#e7d7c8] rounded-[40px] border border-[#d3bfae] shadow-[0_25px_100px_rgba(56,32,12,0.18)] p-6 sm:p-10 md:p-14">

                    <div class="mb-8">

                        <p class="uppercase tracking-[4px] text-[#8b8175] text-sm mb-4">
                            Account Access
                        </p>

                        <h2 class="hero-title text-5xl text-[#1f1f1f] mb-4">
                            Login
                        </h2>

                        <p class="section-description-font text-[#6b5647] text-base sm:text-lg">
                            Enter your details to access your account
                        </p>

                    </div>

                    <!-- Validation Errors -->
                    @if ($errors->any())

                        <div class="text-red-500 text-sm">

                            <ul class="space-y-2">

                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">

                        @csrf

                        <!-- Email -->
                        <div>

                            <p class="uppercase tracking-[3px] text-[#8b8175] text-xs mb-3">
                                Email Address
                            </p>

                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="w-full h-[52px] sm:h-[58px] rounded-2xl border border-black/10 bg-[#f6efe8] backdrop-blur-md px-5 focus:ring-0 focus:border-black transition duration-300 focus:scale-[1.01]">

                        </div>

                        <!-- Password -->
                        <div>

                            <div class="flex items-center justify-between mb-3">

                                <p class="uppercase tracking-[3px] text-[#8b8175] text-xs">
                                    Password
                                </p>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="text-sm text-[#6b5647] hover:text-black transition duration-300">

                                        Forgot Password?

                                    </a>
                                @endif

                            </div>

                            <input type="password" name="password" required
                                class="w-full h-[52px] sm:h-[58px] rounded-2xl border border-black/10 bg-[#f6efe8] backdrop-blur-md px-5 focus:ring-0 focus:border-black transition duration-300 focus:scale-[1.01]">

                        </div>

                        <!-- Remember -->
                        <label class="flex items-center gap-3 cursor-pointer">

                            <input type="checkbox" name="remember"
                                class="rounded border-black/20 text-black focus:ring-0">

                            <span class="text-[#6b5647] text-sm">
                                Remember Me
                            </span>

                        </label>

                        <!-- Button -->
                        <button type="submit"
                            class="hero-title w-full h-[52px] sm:h-[58px] rounded-2xl bg-black text-white hover:bg-neutral-800 transition duration-300">

                            Login

                        </button>

                    </form>

                    <!-- Register -->
                    <div class="mt-8 text-center">

                        <p class="text-[#6b5647]">

                            Don’t have an account?

                            <a href="{{ route('register') }}" class="text-black font-medium hover:underline">

                                Create Account

                            </a>

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-guest-layout>
