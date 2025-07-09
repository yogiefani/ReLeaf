<x-app-layout>
    {{-- Menambahkan x-data untuk modal dan mengintegrasikannya dengan data yang sudah ada --}}
    <div class="bg-gray-50 font-oxygen min-h-screen" 
         x-data="{ 
            paymentMethod: 'bank_transfer', 
            shippingCost: 10000,
            subTotal: {{ $subTotal }},
            userCoins: {{ Auth::user()->coins }},
            isAddressModalOpen: false,
            get totalIDR() {
                return this.subTotal + this.shippingCost;
            },
            get requiredCoins() {
                return this.totalIDR;
            },
            get canPayWithCoins() {
                return this.userCoins >= this.requiredCoins;
            }
         }" 
         x-bind:class="{ 'overflow-hidden': isAddressModalOpen }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">

            <h1 class="font-playfair text-3xl md:text-4xl lg:text-5xl font-bold text-brand-dark mb-8 md:mb-10">Checkout</h1>

            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 xl:grid-cols-5 gap-6 md:gap-8 lg:gap-12">
                    <div class="xl:col-span-3 space-y-6">
                        <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm">
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2">
                                <h2 class="font-bold text-lg text-brand-dark">
                                    <svg class="inline-block w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                    Delivery Destination Address
                                </h2>
                                <button type="button" @click="isAddressModalOpen = true" class="text-sm text-gray-500 hover:text-black">Change Address</button>
                            </div>
                            <div class="border-t my-4"></div>
                            <div id="delivery-address">
                                @if($currentAddress)
                                    <p class="font-bold">{{ $currentAddress->label }}</p>
                                    <p class="text-gray-600">{{ $currentAddress->full_address }}. {{ $currentAddress->phone_number }}</p>
                                    <input type="hidden" name="user_address_id" value="{{ $currentAddress->id }}">
                                @else
                                    <p class="text-red-500">No delivery address selected. Please add or select an address.</p>
                                @endif
                            </div>
                        </div>

                        {{-- Order Items --}}
                        <div class="bg-white p-6 rounded-2xl shadow-sm">
                            <h2 class="font-bold text-lg text-brand-dark mb-6">Order Items</h2>
                            <div class="space-y-6">
                                @foreach($cartItems as $item)
                                <div class="flex items-center gap-6 p-4 bg-gray-50 rounded-lg">
                                    <div class="w-20 h-auto bg-gray-100 p-2 rounded-lg flex-shrink-0">
                                        <img src="{{ asset($item->book->cover_image) }}" alt="{{ $item->book->title }}" class="w-full h-full object-cover rounded">
                                    </div>
                                    <div class="flex-grow">
                                        <p class="font-bold text-brand-dark text-lg">{{ $item->book->title }}</p>
                                        <p class="text-sm text-gray-500 mb-2">{{ $item->quantity }} Item(s)</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-semibold text-brand-dark">Rp{{ number_format($item->book->price * $item->quantity, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Right Column --}}
                    <div class="xl:col-span-2 space-y-6">
                        <div class="bg-white p-6 rounded-2xl shadow-sm">
                            <h2 class="font-bold text-lg text-brand-dark mb-4">Choose Payment Method</h2>
                            <div class="space-y-3">
                                <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="payment_method" value="bank_transfer" class="form-radio text-brand-dark focus:ring-brand-dark" x-model="paymentMethod">
                                    <span class="ml-3">Transfer Bank</span>
                                </label>
                                <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="payment_method" value="coins" class="form-radio text-brand-dark focus:ring-brand-dark" x-model="paymentMethod">
                                    <span class="ml-3">Bayar dengan Koin</span>
                                </label>
                            </div>
                            
                            <div x-show="paymentMethod === 'coins'" x-transition class="mt-4">
                                <div class="border-t my-4"></div>
                                <div class="bg-amber-100/50 border border-amber-300/50 text-sm text-gray-700 p-3 rounded-lg space-y-2">
                                    <div class="flex justify-between">
                                        <span>Saldo Koin Anda:</span>
                                        <span class="font-bold bg-amber-200 px-2 py-1 rounded-md" x-text="`${userCoins} Koin`"></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Dibutuhkan:</span>
                                        <span class="font-bold" x-text="`${requiredCoins} Koin`"></span>
                                    </div>
                                </div>
                                <template x-if="canPayWithCoins">
                                    <p class="text-sm text-green-600 mt-3 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        Koin mencukupi untuk pembayaran ini.
                                    </p>
                                </template>
                                <template x-if="!canPayWithCoins">
                                    <p class="text-sm text-red-600 mt-3 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        Koin Anda tidak mencukupi.
                                    </p>
                                </template>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-2xl shadow-sm">
                            <h2 class="font-bold text-lg text-brand-dark mb-4">Order Details</h2>
                            <div class="space-y-3 text-sm text-gray-700">
                                <div class="flex justify-between">
                                    <span>Subtotal</span>
                                    <span class="font-semibold">Rp{{ number_format($subTotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Shipping Cost</span>
                                    <span class="font-semibold" x-text="`Rp${new Intl.NumberFormat('id-ID').format(shippingCost)}`"></span>
                                </div>
                            </div>
                            <div class="border-t my-4"></div>
                            <div class="flex justify-between font-bold text-lg">
                                <span>Total Payment</span>
                                <div class="text-right">
                                    <p x-text="`Rp${new Intl.NumberFormat('id-ID').format(totalIDR)}`"></p>
                                    <p x-show="paymentMethod === 'coins'" class="text-amber-600 text-sm font-normal" x-text="`(${requiredCoins} Koin)`"></p>
                                </div>
                            </div>
                            <button type="submit" 
                                    class="w-full bg-amber-300 text-brand-dark font-bold py-3 rounded-lg mt-6 hover:bg-amber-400 transition-colors disabled:bg-gray-300 disabled:cursor-not-allowed"
                                    :disabled="paymentMethod === 'coins' && !canPayWithCoins">
                                Proceed to Payment
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Change Address Modal -->
    <div x-show="isAddressModalOpen" 
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;" {{-- Mencegah FOUC (Flash of Unstyled Content) --}}
         class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
         @keydown.escape.window="isAddressModalOpen = false">
        
        <div @click.away="isAddressModalOpen = false" 
             x-show="isAddressModalOpen"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-brand-dark">Change Delivery Address</h2>
                    <button type="button" @click="isAddressModalOpen = false" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <!-- Saved Addresses -->
                <div class="mb-6">
                    <h3 class="font-semibold text-lg mb-4">Saved Addresses</h3>
                    <div class="space-y-3">
                        @foreach($addresses as $address)
                        <form action="{{ route('address.set-current', $address->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left flex items-start p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="font-semibold">{{ $address->label }}</span>
                                        @if($address->is_current)
                                            <span class="text-sm bg-green-100 text-green-800 px-2 py-1 rounded">Current</span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-600">{{ $address->full_address }}</p>
                                    <p class="text-sm text-gray-500">{{ $address->phone_number }}</p>
                                </div>
                            </button>
                        </form>
                        @endforeach
                    </div>
                </div>

                <!-- Add New Address -->
                <div class="border-t pt-6">
                    <h3 class="font-semibold text-lg mb-4">Add New Address</h3>
                    <form action="{{ route('address.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Label</label>
                            <input name="label" type="text" placeholder="e.g., Home, Office" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-dark" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Complete Address</label>
                            <textarea name="full_address" placeholder="Street address, building, floor, etc." rows="3" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-dark" required></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <input name="phone_number" type="tel" placeholder="+62 812 3456 7890" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-dark" required>
                        </div>
                        <div class="flex gap-3 pt-4">
                            <button type="button" @click="isAddressModalOpen = false" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Cancel</button>
                            <button type="submit" class="flex-1 px-4 py-2 bg-amber-300 text-brand-dark font-semibold rounded-lg hover:bg-amber-400 transition-colors">Save Address</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
