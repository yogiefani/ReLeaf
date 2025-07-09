<x-app-layout>
    <div class="bg-white py-16 md:py-24">
        <div class="container mx-auto px-6 md:px-12">
            <div class="text-center">
                <h1 class="font-playfair text-5xl font-bold text-brand-dark">Koleksi Kami</h1>
                <p class="text-lg text-gray-600 mt-2">Temukan dunia cerita yang menanti Anda.</p>
            </div>

            {{-- Loop untuk menampilkan semua buku dari database --}}
            <div class="mt-16 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-x-6 gap-y-12">
                @forelse ($books as $book)
                    <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden">
                        <a href="{{ route('books.show', $book->slug) }}" class="group block">
                            <div class="aspect-[2/3] w-full overflow-hidden bg-gray-200 group-hover:opacity-75 transition-opacity">
                                <img src="{{ asset($book->cover_image) }}" alt="Sampul buku {{ $book->title }}" class="h-full w-full object-cover object-center">
                            </div>

                            <div class="p-4 font-oxygen">
                                <h3 class="text-base font-semibold text-brand-dark truncate">{{ $book->title }}</h3>
                                <p class="mt-1 text-sm text-gray-600 truncate">{{ $book->author }}</p>
                                <p class="mt-2 text-sm font-semibold text-brand-dark">Rp{{ number_format($book->price, 0, ',', '.') }}</p>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">Belum ada buku dalam koleksi.</p>
                @endforelse
            </div>

            {{-- Link Paginasi --}}
            <div class="mt-16">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
