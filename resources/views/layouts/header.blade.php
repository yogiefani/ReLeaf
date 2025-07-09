<header class="bg-white font-playfair border-neutral-800 border- ">
    <div class="container mx-auto px-6 md:px-12 py-16 md:py-4">
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Airbook Logo" class="h-10">
                </a>
            </div>

            <nav class="hidden md:flex items-center space-x-8 text-sm">
                <a href="#" class="font-bold border-b-2 border-black text-black">Home</a>
                <a href="#" class="hover:text-black">Collection</a>
                <a href="#" class="hover:text-black">Contact Us</a>
                <a href="#" class="hover:text-black">About us</a>
            </nav>

            <div class="flex items-center space-x-5">
                <a href="#" class="hover:opacity-75">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </a>
                <a href="{{ route('cart') }}" class="hover:opacity-75">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </a>
                
                @auth
                    <a href="{{ url('/profile') }}" class="hover:opacity-75">
                         <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-black">Login</a>
                @endauth
            </div>
        </div>
    </div>
</header>