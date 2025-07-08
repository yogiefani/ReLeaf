<section class="bg-white py-16 md:py-24">
    <div class="mx-auto ">
        
        <h2 class="font-playfair text-4xl md:text-5xl font-regular text-brand-dark text-center mb-16 max-w-2xl mx-auto leading-tight">
            Yang Kamu Dapatkan Ketika Berbelanja di Toko Kami
        </h2>
        <div class="bg-brand-beige space-y-8 py-8 md:py-8 rounded-2xl shadow-lg">
            <div class="container px-6 md:px-12">
                @foreach ($benefits as $benefit)
                <div class="bg-white my-4  rounded-2xl shadow-lg p-8 max-w-3xl flex items-center gap-8 
                {{ $benefit['align'] === 'left' ? 'mr-auto' : 'ml-auto' }}">
                
                <div class="flex-shrink-0">
                    <img src="{{ asset($benefit['icon']) }}" alt="Ikon {{ $benefit['title'] }}" class="w-20 h-20">
                    </div>

                    <div>
                        <h3 class="font-oxygen font-bold text-lg text-brand-dark">{{ $benefit['title'] }}</h3>
                        <p class="font-oxygen text-gray-600 mt-2">{{ $benefit['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
            
        </div>
    </div>
</section>