<header class="bg-white font-playfair border-b border-gray-100" x-data="{ open: false }">
    <div class="container mx-auto px-6 md:px-12 py-4">
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Airbook Logo" class="h-10">
                </a>
            </div>

            <nav class="hidden md:flex items-center space-x-8 text-sm">
                <a href="{{ route('home') }}"
                    class="hover:text-black {{ request()->routeIs('home') ? 'font-bold border-b-2 border-black text-black' : '' }}">Beranda</a>
                <a href="{{ route('collection') }}"
                    class="hover:text-black {{ request()->routeIs('collection') ? 'font-bold border-b-2 border-black text-black' : '' }}">Koleksi</a>
                <a href="{{ route('contact') }}"
                    class="hover:text-black {{ request()->routeIs('contact') ? 'font-bold border-b-2 border-black text-black' : '' }}">Hubungi
                    Kami</a>
                <a href="{{ route('about') }}"
                    class="hover:text-black {{ request()->routeIs('about') ? 'font-bold border-b-2 border-black text-black' : '' }}">Tentang
                    Kami</a>
            </nav>

            <div class="flex items-center space-x-5">
                <a href="#" class="hover:opacity-75">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </a>
                <a href="{{ route('cart.index') }}" class="hover:opacity-75">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </a>

                @auth
                    <!-- Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="hover:opacity-75 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z">
                                </path>
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 origin-top-right"
                            style="display: none;">

                            <a href="{{ route('profile.dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengaturan</a>

                            @if (Auth::user()->hasRole('Super Admin'))
                                <div class="border-t border-gray-100 my-1"></div>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 font-semibold">
                                    <span class="text-amber-600">🛡️ Super Admin</span>
                                </a>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Keluar
                                </a>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-black">Masuk</a>
                @endauth
            </div>
        </div>
    </div>
</header>
