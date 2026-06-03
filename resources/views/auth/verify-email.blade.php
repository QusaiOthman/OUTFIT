<x-guest-layout>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400..800&display=swap"
        rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=BJCree:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&display=swap"
        rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@1,100..900&display=swap"
        rel="stylesheet">

    <div class="min-h-screen bg-[#f8f7f4] flex items-center justify-center px-4 sm:px-6">

        <div class="w-full max-w-xl lg:max-w-2xl">

            <div
                class="bg-[#f5f2ec]/80 backdrop-blur-2xl rounded-[32px] sm:rounded-[40px] border border-white/40 shadow-[0_20px_80px_rgba(0,0,0,0.08)] p-6 sm:p-8 md:p-12 lg:p-14 text-center">

                <!-- Logo -->
                <a href="{{ route('home') }}"
                    class="hero-title text-3xl sm:text-4xl lg:text-5xl text-[#1f1f1f] uppercase inline-block mb-8 sm:mb-10">

                    Outfit

                </a>

                <!-- Heading -->
                <p class="uppercase tracking-[3px] sm:tracking-[4px] text-[#8b8175] text-xs sm:text-sm mb-4 sm:mb-5">

                    Verify Email

                </p>

                <h1
                    class="hero-title text-3xl sm:text-5xl lg:text-6xl text-[#1f1f1f] leading-tight mb-5 sm:mb-6">

                    Check Your Inbox

                </h1>

                <p
                    class="section-description-font text-[#6f675d] text-base sm:text-lg lg:text-xl leading-relaxed max-w-xl mx-auto mb-8 sm:mb-10">

                    We’ve sent a verification link to your email address.
                    Please verify your account before continuing.

                </p>

                @if (session('status') == 'verification-link-sent')
                    <div
                        class="mb-6 sm:mb-8 rounded-2xl bg-green-50 border border-green-100 p-4 sm:p-5 text-green-600 text-sm">

                        A new verification link has been sent to your email address.

                    </div>
                @endif

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center items-center">

                    <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">

                        @csrf

                        <button type="submit"
                            class="hero-title w-full sm:w-auto px-6 sm:px-8 h-[54px] sm:h-[60px] rounded-2xl bg-black text-white hover:bg-neutral-800 transition duration-300">

                            Resend Email

                        </button>

                    </form>

                    <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">

                        @csrf

                        <button type="submit"
                            class="hero-title w-full sm:w-auto px-6 sm:px-8 h-[54px] sm:h-[60px] rounded-2xl border border-black/10 text-[#1f1f1f] hover:bg-black/5 transition duration-300">

                            Logout

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-guest-layout>

