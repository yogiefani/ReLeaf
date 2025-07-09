<section class="bg-gray-50 py-16 md:py-24">
    <div class="container mx-auto px-6 md:px-12">
        <h2 class="font-playfair text-4xl md:text-5xl font-bold text-brand-dark text-center mb-12">
            Apa Kata Mereka?
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @for ($i = 0; $i < 3; $i++)
            <div class="bg-white p-6 rounded-2xl shadow-lg flex flex-col">
                <div class="flex items-center">
                    <img class="h-14 w-14 rounded-full object-cover" src="{{ asset('images/profile-paskal.png') }}" alt="Foto profil Paskal P">
                    <div class="ml-4">
                        <p class="font-oxygen font-bold text-brand-dark">Paskal P</p>
                        <p class="font-oxygen text-sm text-gray-500">Semarang, Jawa</p>
                        <div class="flex items-center mt-1">
                            @for ($s = 0; $s < 5; $s++)
                                <svg class="w-4 h-4 text-amber-500 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            @endfor
                        </div>
                    </div>
                </div>

                <div class="relative mt-4 bg-brand-beige p-6 rounded-2xl font-oxygen text-gray-700 leading-relaxed flex-grow">
                    <p>We are more than just an online bookstore. We are a community of readers, writers, and literature enthusiasts who share a common love for the beauty and power of words.</p>
                    <p class="text-right text-xs text-gray-500 mt-4">Desember 2024</p>
                    <div class="absolute top-0 left-8 -translate-y-2 w-4 h-4 bg-brand-beige transform rotate-45"></div>
                </div>
            </div>
            @endfor
            
        </div>
    </div>
</section>