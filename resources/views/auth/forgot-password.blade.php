<x-guest-layout>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=BJCree:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&display=swap"rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@1,100..900&display=swap" rel="stylesheet">


    <div class="min-h-screen bg-[#cdb8a3] lg:grid lg:grid-cols-2 relative overflow-hidden">

        <!-- LEFT SIDE -->
        <div class="relative hidden lg:flex overflow-hidden">

            <img src="{{ asset('images/forgotPass-hero.png') }}" class="absolute inset-0 w-full h-full object-cover">

            <div class="absolute inset-0 bg-black/25"></div>

            <div class="relative z-10 flex flex-col justify-between p-16 text-white w-full">

                <a href="/" class="hero-title text-4xl sm:text-6xl uppercase tracking-wide">
                    Outfit
                </a>

                <div class="max-w-xl">

                    <p class="uppercase tracking-[6px] text-sm mb-6 text-white/80">
                        Password Recovery
                    </p>

                    <h1 class="hero-title text-6xl xl:text-7xl leading-[0.95] mb-8">
                        Reset Your Password.
                    </h1>

                    <p class="section-description-font text-2xl text-white/85 leading-relaxed">
                        Enter your email address and we’ll send you a secure link to reset your password.
                    </p>

                </div>

            </div>

        </div>

        <!-- RIGHT SIDE -->
        <div class="relative z-10 flex items-center justify-center px-4 sm:px-6 py-6 sm:py-10">

            
            <div
                class="w-full max-w-md lg:max-w-[620px] bg-[#efe4d8]/95 backdrop-blur-2xl rounded-[40px] border border-[#e0d8ce] shadow-[0_25px_90px_rgba(0,0,0,0.12)] p-6 sm:p-10 md:p-14">

                <p class="uppercase tracking-[4px] text-[#8b8175] text-sm mb-4">
                    Account Recovery
                </p>

                <h1 class="hero-title text-4xl sm:text-6xl text-[#1f1f1f] leading-none mb-6">
                    Forgot Password
                </h1>

                <p class="section-description-font text-[#6d5848] text-base sm:text-xl leading-relaxed mb-10">
                    We’ll email you a password reset link that allows you to create a new password securely.
                </p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-6" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-7">

                    @csrf

                    <!-- EMAIL -->
                    <div>

                        <label class="block uppercase tracking-[4px] text-[#8b8175] text-xs mb-4">
                            Email Address
                        </label>

                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full h-[56px] sm:h-[64px] rounded-[22px] border border-black/5 bg-white/80 px-6 text-lg text-[#1f1f1f] placeholder:text-[#b0a79c] focus:border-black focus:ring-0 transition duration-300">

                        @error('email')
                            <p class="text-red-500 text-sm mt-3">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                        class="hero-title w-full h-[56px] sm:h-[64px] rounded-[22px] bg-black text-white text-xl hover:bg-neutral-800 transition duration-300">

                        Send Reset Link

                    </button>

                </form>

                <!-- BACK -->
                <div class="mt-10 text-center">

                    <a href="{{ route('login') }}"
                        class="section-description-font text-lg text-[#6d5848] hover:text-black transition duration-300">

                        Back To Login

                    </a>

                </div>

            </div>

        </div>

    </div>

</x-guest-layout>
