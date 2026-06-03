<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Panel | OUTFIT</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&display=swap"
        rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        .hero-title {
            font-family: 'Cormorant Garamond', serif;
        }

        .body-font {
            font-family: 'Manrope', sans-serif;
        }

        @media (max-width: 1023px) {

            #sidebar {
                position: fixed;
            }

        }

        @media (min-width: 1024px) {

            #sidebar {
                position: sticky;
                transform: translateX(0) !important;
            }

        }
    </style>

</head>

<body class="bg-[#f6f1ea] body-font">

    <!-- Mobile Header -->
    <div class="lg:hidden flex items-center justify-between p-4 bg-[#181818] text-white">

        <h1 class="hero-title text-3xl">
            OUTFIT
        </h1>

        <button id="menuBtn" class="text-3xl">
            ☰
        </button>

    </div>

    <div class="flex min-h-screen">

        <!-- Overlay -->
        <div id="overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden">
        </div>

        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed lg:sticky top-0 left-0 z-50
           w-[250px] xl:w-[270px] h-screen
           bg-[#181818] text-white
           px-6 py-8
           flex flex-col justify-between
           -translate-x-full lg:translate-x-0
           transition-transform duration-300">
            <div>

                <!-- Logo -->
                <div class="mb-16">

                    <a href="{{ route('home') }}">
                        <h1 class="hero-title text-4xl xl:text-5xl tracking-wide">
                            OUTFIT
                        </h1>
                    </a>

                    <p class="text-sm text-gray-400 mt-3 tracking-[4px] uppercase">
                        Admin Panel
                    </p>

                </div>

                <!-- Navigation -->
                <nav class="space-y-3">

                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 px-5 py-4 rounded-2xl transition
                        {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'hover:bg-white/10 text-gray-300' }}">

                        <span>Dashboard</span>

                    </a>

                    <!-- Products -->
                    <a href="{{ route('admin.products') }}"
                        class="flex items-center gap-3 px-5 py-4 rounded-2xl transition
                        {{ request()->routeIs('admin.products*') ? 'bg-white/10 text-white' : 'hover:bg-white/10 text-gray-300' }}">

                        <span>Products</span>

                    </a>

                    <!-- Categories -->
                    <a href="{{ route('admin.categories') }}"
                        class="flex items-center gap-3 px-5 py-4 rounded-2xl transition
                        {{ request()->routeIs('admin.categories*') || request()->routeIs('categories.*')
                            ? 'bg-white/10 text-white'
                            : 'hover:bg-white/10 text-gray-300' }}">

                        <span>Categories</span>

                    </a>

                    <!-- Orders -->
                    <a href="{{ route('admin.orders') }}"
                        class="flex items-center gap-3 px-5 py-4 rounded-2xl transition
                        {{ request()->routeIs('admin.orders*') ? 'bg-white/10 text-white' : 'hover:bg-white/10 text-gray-300' }}">

                        <span>Orders</span>

                    </a>
                    <a href="{{ route('admin.users') }}"
                        class="flex items-center gap-3 px-5 py-4 rounded-2xl transition
                        {{ request()->routeIs('admin.users*') ? 'bg-white/10 text-white' : 'hover:bg-white/10 text-gray-300' }}">

                        <span>Users</span>

                    </a>
                    <!-- Settings-->
                    <a href="{{ route('admin.settings') }}"
                        class="flex items-center gap-3 px-5 py-4 rounded-2xl transition
                        {{ request()->routeIs('admin.settings*') ? 'bg-white/10 text-white' : 'hover:bg-white/10 text-gray-300' }}">

                        <span>Settings</span>

                    </a>

                </nav>

            </div>

            <!-- Bottom -->
            <div>

                <div class="bg-white/5 rounded-3xl p-4 mb-4">

                    <p class="text-sm text-gray-400 mb-2">
                        Logged in as
                    </p>

                    <h3 class="text-lg font-semibold">
                        {{ Auth::user()->name }}
                    </h3>

                </div>

                <form action="{{ route('logout') }}" method="POST">

                    @csrf

                    <button type="submit"
                        class="w-full h-[55px] rounded-2xl bg-white text-black font-semibold hover:bg-[#e8dfd1] transition">

                        Logout

                    </button>

                </form>

            </div>

        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-4 md:p-6 lg:p-10 overflow-hidden lg:ml-0">

            @yield('content')

        </main>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const menuBtn = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        if (menuBtn) {

            menuBtn.addEventListener('click', () => {

                sidebar.classList.toggle('-translate-x-full');

                overlay.classList.toggle('hidden');

            });

            overlay.addEventListener('click', () => {

                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');

            });

        }
    </script>

</body>

</html>
