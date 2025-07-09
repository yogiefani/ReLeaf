<x-detail-layout>
    <div class="bg-white py-12 md:py-20">
        <div class="container mx-auto px-6 md:px-12">
            <div class="flex justify-between items-center mb-8">
                <div class="relative w-full max-w-xs">
                    <input type="text" placeholder="Search book name, author, and edition ..." class="w-full bg-white/50 border-none rounded-full pl-10 pr-4 py-2 focus:ring-2 focus:ring-brand-dark">
                    <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
                <div class="flex items-start gap-4">
                    <div class="w-full flex justify-center p-8 bg-gray-100 rounded-2xl">
                        {{-- Diubah dari Storage::url() menjadi asset() --}}
                        <img src="{{ asset($book->cover_image) }}" alt="Sampul buku {{ $book->title }}" class="w-2/3 drop-shadow-xl">
                    </div>
                </div>
                <div>
                    <h1 class="font-playfair text-5xl font-bold text-brand-dark">{{ $book->title }}</h1>
                    <p class="font-oxygen text-lg text-gray-700 mt-2">{{ $book->author }}</p>
                    
                    {{-- Menggunakan kolom description dari database --}}
                    <p class="font-oxygen text-base text-gray-600 mt-6 leading-relaxed">{{ $book->description }}</p>

                    <p class="font-playfair text-4xl font-bold text-brand-dark my-6">Rp{{ number_format($book->price, 0, ',', '.') }}</p>

                    <div class="flex items-center gap-4">
                        {{-- Form untuk menambahkan ke keranjang --}}
                        <form action="{{ route('cart.add', $book->slug) }}" method="POST">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="bg-slate-700 text-white font-bold py-3 px-10 rounded-lg hover:bg-slate-800 transition">Buy</button>
                        </form>
                        <button class="w-12 h-12 border-2 border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-100 transition">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12s-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.368a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path></svg>
                        </button>
                         <button class="w-12 h-12 border-2 border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-100 transition">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-20 space-y-16">
                <div>
                    <h2 class="font-playfair text-3xl font-bold text-brand-dark border-b-2 border-brand-beige pb-2">Synopsis</h2>
                    <p class="font-oxygen text-gray-700 mt-6 leading-loose">{{ $book->description }}</p>
                </div>
                {{-- Bagian Detail dan Review bisa ditambahkan nanti jika datanya sudah ada di database --}}
            </div>

        </div>
    </div>
</x-detail-layout>
