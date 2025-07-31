<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Super Admin' }} - AirBook</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Oxygen:wght@400;700&family=Playfair+Display:wght@400;700;900&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="antialiased bg-gray-50">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-brand-dark text-white shadow-lg">
            <div class="p-6">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Airbook Logo"
                        class="h-8 mr-3 filter brightness-0 invert">
                    <span class="font-playfair text-xl font-bold">Super Admin</span>
                </div>
            </div>

            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-6 py-3 text-gray-300 hover:text-white hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 text-white border-r-4 border-amber-300' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.book-exchanges') }}"
                    class="flex items-center px-6 py-3 text-gray-300 hover:text-white hover:bg-gray-700 {{ request()->routeIs('admin.book-exchanges*') ? 'bg-gray-700 text-white border-r-4 border-amber-300' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                    Tukar Buku
                </a>

                <a href="{{ route('admin.users') }}"
                    class="flex items-center px-6 py-3 text-gray-300 hover:text-white hover:bg-gray-700 {{ request()->routeIs('admin.users*') ? 'bg-gray-700 text-white border-r-4 border-amber-300' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                        </path>
                    </svg>
                    Users
                </a>

                <a href="{{ route('admin.coin-transactions') }}"
                    class="flex items-center px-6 py-3 text-gray-300 hover:text-white hover:bg-gray-700 {{ request()->routeIs('admin.coin-transactions') ? 'bg-gray-700 text-white border-r-4 border-amber-300' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                        </path>
                    </svg>
                    Transaksi Koin
                </a>

                <div class="border-t border-gray-600 mt-6 pt-6">
                    <a href="{{ route('home') }}"
                        class="flex items-center px-6 py-3 text-gray-300 hover:text-white hover:bg-gray-700">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        Ke Website
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full px-6 py-3 text-gray-300 hover:text-white hover:bg-gray-700">
                            <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-6 py-4">
                    <div class="flex justify-between items-center">
                        <h1 class="font-playfair text-2xl font-bold text-brand-dark">{{ $title ?? 'Dashboard' }}</h1>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-600">Selamat datang, {{ Auth::user()->name }}</span>
                            <div class="w-8 h-8 bg-brand-dark rounded-full flex items-center justify-center">
                                <span
                                    class="text-white text-sm font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6 font-oxygen">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</body>

</html>
