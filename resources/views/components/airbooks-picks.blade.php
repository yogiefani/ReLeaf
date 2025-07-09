<section class="bg-gray-50 py-16 md:py-24">
    <div class="container mx-auto px-6 md:px-12">
        <h2 class="font-playfair text-4xl md:text-5xl font-regular text-brand-dark text-center mb-16">
            AIRBook's Picks
        </h2>
        <div class="space-y-10">
            @foreach ($bookPicks as $pick)
                <div class="w-full flex {{ $loop->iteration % 2 === 0 ? 'justify-end' : 'justify-start' }}">
                    <div class="bg-white rounded-2xl shadow-lg p-10 max-w-5xl flex flex-col md:flex-row items-center gap-12 
                                {{ $loop->iteration % 2 === 0 ? 'md:flex-row-reverse' : '' }}">
                        <div class="flex-shrink-0 w-2/3 md:w-1/5">
                            <img src="{{ asset($pick['image']) }}" alt="Sampul buku {{ $pick['title'] }}" class="w-full h-auto object-contain drop-shadow-lg">
                        </div>
                        <div class="flex-grow flex flex-col {{ $loop->iteration % 2 === 0 ? 'md:text-right md:items-end' : 'md:text-left md:items-start' }}">
                            <div class="flex-grow">
                                <h3 class="font-playfair text-3xl font-bold text-brand-dark">{{ $pick['title'] }}</h3>
                                <p class="font-oxygen text-gray-600 mt-4 leading-relaxed">{{ $pick['description'] }}</p>
                            </div>
                            <div class="mt-6">
                                <span class="inline-block bg-brand-beige text-brand-dark font-semibold text-xs px-4 py-2 rounded-full">
                                    WEEK {{ $pick['week'] }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-16 max-w-2xl mx-auto">
            <p class="font-oxygen text-gray-600">
                AIRBook's Picks adalah rekomendasi buku mingguan dari tim kami. 
                Tiap buku disertai ulasan untuk pembaca yang ingin lebih dari sekadar cerita.
            </p>
        </div>
    </div>
</section>