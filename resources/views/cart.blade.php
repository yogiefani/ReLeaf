<x-app-layout>
    @php
    $cartItems = [
        [
            'id' => 1,
            'image' => 'images/picks/little-women.jpg',
            'title' => 'Little Women',
            'author' => 'Louisa May Alcott',
            'price' => 75000,
            'quantity' => 1,
        ],
        [
            'id' => 2,
            'image' => 'images/picks/they-both-die.jpg',
            'title' => 'They Both Die at the End',
            'author' => 'Adam Silvera',
            'price' => 95000,
            'quantity' => 1,
        ],
        [
            'id' => 3,
            'image' => 'images/books/laut-bercerita.jpg', 
            'title' => 'Laut Bercerita',
            'author' => 'Leila S. Chudori',
            'price' => 85000,
            'quantity' => 1,
        ],
    ];
    @endphp

    <div class="bg-gray-50 font-oxygen min-h-screen" 
         x-data="{ 
            items: {{ json_encode($cartItems) }},
            get subtotal() {
                return this.items.reduce((acc, item) => acc + (item.price * item.quantity), 0);
            },
            formatCurrency(amount) {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(amount);
            }
         }">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12 max-w-7xl">

            <h1 class="font-playfair text-3xl sm:text-4xl lg:text-5xl font-bold text-brand-dark mb-8 lg:mb-10">Shopping Bag</h1>

            <div class="flex flex-col lg:flex-row gap-6 lg:gap-8">
                <div class="flex-1 lg:w-2/3">
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                        <div class="p-6 space-y-6">
                            <template x-for="item in items" :key="item.id">
                                <div class="flex items-start sm:items-center gap-4 pb-6 border-b border-gray-100 last:border-b-0 last:pb-0">
                                    <div class="flex-shrink-0 pt-1 sm:pt-0">
                                        <input type="checkbox" class="form-checkbox h-5 w-5 rounded text-brand-dark focus:ring-brand-dark/50 border-gray-300">
                                    </div>
                                    <div class="flex-shrink-0 w-16 sm:w-20 h-20 sm:h-24 bg-gray-100 rounded-lg overflow-hidden">
                                        <img :src="'/' + item.image" :alt="item.title" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-bold text-brand-dark text-base sm:text-lg leading-tight" x-text="item.title"></h3>
                                        <p class="text-sm text-gray-500 mt-1" x-text="item.author"></p>
                                        <p class="text-lg sm:text-xl font-semibold text-brand-dark mt-2" x-text="formatCurrency(item.price)"></p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center gap-2 sm:gap-3 bg-gray-50 rounded-lg p-1">
                                            <button @click="if(item.quantity > 1) item.quantity--" 
                                                    class="w-8 h-8 rounded-full bg-white hover:bg-gray-100 shadow-sm flex items-center justify-center text-gray-600 hover:text-brand-dark transition-colors">
                                                <span class="text-sm font-medium">−</span>
                                            </button>
                                            <span class="font-semibold w-8 text-center text-brand-dark" x-text="item.quantity"></span>
                                            <button @click="item.quantity++" 
                                                    class="w-8 h-8 rounded-full bg-white hover:bg-gray-100 shadow-sm flex items-center justify-center text-gray-600 hover:text-brand-dark transition-colors">
                                                <span class="text-sm font-medium">+</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/3 lg:max-w-sm">
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden sticky top-6">
                        <div class="p-6">
                            <h2 class="font-bold text-xl text-brand-dark mb-6">Order Summary</h2>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center text-gray-700">
                                    <span class="text-base">Sub-Total</span>
                                    <span class="font-semibold text-lg" x-text="formatCurrency(subtotal)"></span>
                                </div>
                                
                                <div class="flex justify-between items-center text-gray-700">
                                    <span class="text-base">Shipping</span>
                                    <span class="text-sm text-green-600 font-medium">Free</span>
                                </div>
                            </div>
                            
                            <div class="border-t border-gray-200 my-6"></div>
                            
                            <div class="flex justify-between items-center mb-6">
                                <span class="font-bold text-xl text-brand-dark">Total</span>
                                <span class="font-bold text-xl text-brand-dark" x-text="formatCurrency(subtotal)"></span>
                            </div>
                            
                            <a href="{{ route('checkout') }}" 
                               class="block w-full bg-amber-300 hover:bg-amber-400 text-brand-dark font-bold py-4 px-6 rounded-xl text-center text-lg transition-colors duration-200 shadow-sm hover:shadow-md">
                                Continue to Payment
                            </a>
                            
                            <div class="mt-4 text-center">
                                <p class="text-sm text-gray-500">
                                    <span class="inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        Secure Checkout
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>