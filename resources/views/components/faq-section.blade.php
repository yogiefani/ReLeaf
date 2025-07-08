<section class="bg-gray-50 py-16 md:py-24">
    <div class="container mx-auto px-6 md:px-12">
        
        <h2 class="font-playfair text-4xl md:text-5xl font-regular text-brand-dark text-center mb-12">
            Frequently Asked Question
        </h2>

        <div class="max-w-3xl mx-auto space-y-4">
            
            @foreach ($faqs as $faq)
                <div x-data="{ open: {{ $faq['open'] ? 'true' : 'false' }} }" class="bg-brand-beige rounded-2xl transition-all duration-300">
                    <div @click="open = !open" class="flex justify-between items-center p-6 cursor-pointer">
                        <h3 class="font-oxygen font-semibold text-brand-dark pr-4">
                            {{ $faq['question'] }}
                        </h3>
                        <div class="flex-shrink-0 text-2xl font-light text-brand-dark">
                            <span x-show="!open">+</span>
                            <span x-show="open" style="display: none;">−</span>
                        </div>
                    </div>
                    <div x-show="open" x-transition class="px-6 pb-6">
                        <p class="font-oxygen text-gray-700 leading-relaxed">
                            {{ $faq['answer'] }}
                        </p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>