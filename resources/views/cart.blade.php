<x-app-layout>
    {{-- Pastikan Anda memiliki tag ini di layout utama (app.blade.php) untuk AJAX: <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <div class="bg-gray-50 font-oxygen min-h-screen" 
         x-data="{
            items: {{ Js::from($cartItems) }},
            get subtotal() {
                return this.items.reduce((acc, item) => acc + (item.book.price * item.quantity), 0);
            },
            formatCurrency(amount) {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(amount);
            },
            updateQuantity(itemId, newQuantity) {
                if (newQuantity < 1) {
                    // Jika kuantitas < 1, hapus item
                    document.getElementById(`remove-form-${itemId}`).submit();
                    return;
                };

                let item = this.items.find(i => i.id === itemId);
                if (item) {
                    item.quantity = newQuantity;
                }

                fetch(`/cart/update/${itemId}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content')
                    },
                    body: JSON.stringify({ quantity: newQuantity })
                }).then(res => res.json()).then(data => {
                    if (!data.success) {
                        console.error('Gagal memperbarui kuantitas.');
                    }
                });
            }
         }">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12 max-w-7xl">

            <h1 class="font-playfair text-3xl sm:text-4xl lg:text-5xl font-bold text-brand-dark mb-8 lg:mb-10">Shopping Bag</h1>

            <div class="flex flex-col lg:flex-row gap-6 lg:gap-8">
                <div class="flex-1 lg:w-2/3">
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                        <div class="p-6 space-y-6">
                            @if($cartItems->isNotEmpty())
                                <template x-for="item in items" :key="item.id">
                                    <div class="flex items-start sm:items-center gap-4 pb-6 border-b border-gray-100 last:border-b-0 last:pb-0">
                                        <div class="flex-shrink-0 pt-1 sm:pt-0">
                                            <input type="checkbox" class="form-checkbox h-5 w-5 rounded text-brand-dark focus:ring-brand-dark/50 border-gray-300" checked>
                                        </div>
                                        <div class="flex-shrink-0 w-16 sm:w-20 h-20 sm:h-24 bg-gray-100 rounded-lg overflow-hidden">
                                            <img :src="'/' + item.book.cover_image" :alt="item.book.title" class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h3 class="font-bold text-brand-dark text-base sm:text-lg leading-tight" x-text="item.book.title"></h3>
                                            <p class="text-sm text-gray-500 mt-1" x-text="item.book.author"></p>
                                            <p class="text-lg sm:text-xl font-semibold text-brand-dark mt-2" x-text="formatCurrency(item.book.price)"></p>
                                        </div>
                                        <div class="flex-shrink-0 flex items-center gap-4">
                                            <div class="flex items-center gap-2 sm:gap-3 bg-gray-50 rounded-lg p-1">
                                                <button @click="updateQuantity(item.id, item.quantity - 1)" 
                                                        class="w-8 h-8 rounded-full bg-white hover:bg-gray-100 shadow-sm flex items-center justify-center text-gray-600 hover:text-brand-dark transition-colors">
                                                    <span class="text-sm font-medium">−</span>
                                                </button>
                                                <span class="font-semibold w-8 text-center text-brand-dark" x-text="item.quantity"></span>
                                                <button @click="updateQuantity(item.id, item.quantity + 1)" 
                                                        class="w-8 h-8 rounded-full bg-white hover:bg-gray-100 shadow-sm flex items-center justify-center text-gray-600 hover:text-brand-dark transition-colors">
                                                    <span class="text-sm font-medium">+</span>
                                                </button>
                                            </div>
                                            <form :id="`remove-form-${item.id}`" :action="`/cart/remove/${item.id}`" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </template>
                            @else
                                <p class="text-center text-gray-500 py-8">Your shopping bag is empty.</p>
                            @endif
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
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
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
