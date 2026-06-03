<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=BJCree:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&display=swap"rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@1,100..900&display=swap" rel="stylesheet">


</head>

<body class="font-sans antialiased">
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition
            class="fixed top-6 right-6 z-[9999]
               bg-black text-white
               px-6 py-4 rounded-2xl
               shadow-2xl
               backdrop-blur-xl">

            {{ session('success') }}

        </div>
    @endif
    <div class="min-h-screen bg-[#f5f3ff]">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const images = document.querySelectorAll('.fade-image');

            images.forEach(img => {

                if (img.complete) {

                    img.classList.add('loaded');

                } else {

                    img.addEventListener('load', () => {

                        img.classList.add('loaded');

                    });

                }

            });

        });
    </script>
</body>

</html>
