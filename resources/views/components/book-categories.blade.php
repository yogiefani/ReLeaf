<section class="bg-white py-16 md:py-24">
    <div class="container mx-auto px-6 md:px-12">
        
        <div class="flex justify-between items-center mb-10">
            <h2 class="font-playfair text-4xl font-bold text-brand-dark">Featured Books</h2>
            <a href="#" class="font-oxygen text-sm text-brand-dark hover:underline">View All →</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-x-6 gap-y-12">
            @foreach ($featuredBooks as $book)
            <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden">
                <a href="#" class="group block">
                    <div class="aspect-[2/3] w-full overflow-hidden bg-gray-200 group-hover:opacity-75 transition-opacity">
                        <img src="{{ asset($book['image']) }}" alt="Sampul buku {{ $book['title'] }}" class="h-full w-full object-cover object-center">
                    </div>

                    <div class="p-4 font-oxygen">
                        <h3 class="text-base font-semibold text-brand-dark truncate">{{ $book['title'] }}</h3>
                        <p class="mt-1 text-sm text-gray-600 truncate">{{ $book['author'] }}</p>
                        <p class="mt-2 text-sm font-semibold text-brand-dark">{{ $book['price'] }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <div class="mt-12 text-center">
            <a href="#" class="inline-block bg-slate-600 text-white font-oxygen font-bold px-8 py-3 rounded-lg shadow-md hover:bg-slate-700 transition-colors duration-300">
                See More
            </a>
        </div>

    </div>
</section>