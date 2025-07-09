<x-app-layout>
    <div class="bg-gray-50 font-oxygen min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">

            <h1 class="font-playfair text-3xl md:text-4xl lg:text-5xl font-bold text-brand-dark mb-8 md:mb-10">Checkout</h1>

            <div class="grid grid-cols-1 xl:grid-cols-5 gap-6 md:gap-8 lg:gap-12">
                <div class="xl:col-span-3 space-y-6">
                    <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2">
                            <h2 class="font-bold text-lg text-brand-dark">
                                <svg class="inline-block w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                Delivery Destination Address
                            </h2>
                            <button onclick="openAddressModal()" class="text-sm text-gray-500 hover:text-black">Change Address</button>
                        </div>
                        <div class="border-t my-4"></div>
                        <div id="delivery-address">
                            <p class="font-bold">Home - Nanami</p>
                            <p class="text-gray-600">Jl. Raya Rambutan, Condong Catur, Depok, Sleman, Yogyakarta. +62 8127898752</p>
                        </div>
                    </div>

                    <!-- Order Items - Extended -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm">
                        <h2 class="font-bold text-lg text-brand-dark mb-6">Order Items</h2>
                        <div class="space-y-6">
                            <div class="flex items-center gap-6 p-4 bg-gray-50 rounded-lg">
                                <div class="w-20 h-auto bg-gray-100 p-2 rounded-lg flex-shrink-0">
                                    <img src="{{ asset('images/picks/little-women.jpg') }}" alt="Little Women" class="w-full h-full object-cover rounded">
                                </div>
                                <div class="flex-grow">
                                    <p class="font-bold text-brand-dark text-lg">Little Women</p>
                                    <p class="text-sm text-gray-500 mb-2">1 Items (0.6 kg)</p>
                                    <p class="text-sm text-gray-600">Classic novel by Louisa May Alcott</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-semibold text-brand-dark">Rp 75.000</p>
                                    <p class="text-sm text-gray-500 line-through">Rp 95.000</p>
                                    <p class="text-xs text-green-600 mt-1">21% OFF</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-6 p-4 bg-gray-50 rounded-lg">
                                <div class="w-20 h-auto bg-gray-100 p-2 rounded-lg flex-shrink-0">
                                    <img src="{{ asset('images/picks/they-both-die.jpg') }}" alt="They Both Die at the End" class="w-full h-full object-cover rounded">
                                </div>
                                <div class="flex-grow">
                                    <p class="font-bold text-brand-dark text-lg">They Both Die at the End</p>
                                    <p class="text-sm text-gray-500 mb-2">1 Items (0.6 kg)</p>
                                    <p class="text-sm text-gray-600">Young adult fiction by Adam Silvera</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-semibold text-brand-dark">Rp 95.000</p>
                                    <p class="text-xs text-blue-600 mt-1">Regular Price</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Additional Order Summary in Left Column -->
                        <div class="border-t my-6"></div>
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h3 class="font-semibold text-brand-dark mb-3">Order Summary</h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span>Total Items:</span>
                                    <span class="font-semibold">2 Books</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Total Weight:</span>
                                    <span class="font-semibold">1.2 kg</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Estimated Delivery:</span>
                                    <span class="font-semibold text-green-600">2-3 Days</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Options -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm">
                        <h2 class="font-bold text-lg text-brand-dark mb-4">Shipping Options</h2>
                        <div class="space-y-3">
                            <label class="flex items-center justify-between p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <div class="flex items-center">
                                    <input type="radio" name="shipping" class="form-radio text-brand-dark focus:ring-brand-dark" checked>
                                    <div class="ml-3">
                                        <p class="font-semibold">Regular Shipping</p>
                                        <p class="text-sm text-gray-500">2-3 business days</p>
                                    </div>
                                </div>
                                <span class="font-semibold">Rp 10.000</span>
                            </label>
                            <label class="flex items-center justify-between p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <div class="flex items-center">
                                    <input type="radio" name="shipping" class="form-radio text-brand-dark focus:ring-brand-dark">
                                    <div class="ml-3">
                                        <p class="font-semibold">Express Shipping</p>
                                        <p class="text-sm text-gray-500">1-2 business days</p>
                                    </div>
                                </div>
                                <span class="font-semibold">Rp 20.000</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Optimized width -->
                <div class="xl:col-span-2 space-y-6">
                    <!-- Payment Method -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm">
                        <h2 class="font-bold text-lg text-brand-dark mb-4">Choose Payment Method</h2>
                        <div class="space-y-3">
                            <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" class="form-radio text-brand-dark focus:ring-brand-dark" checked>
                                <span class="ml-3">Transfer Bank</span>
                            </label>
                            <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" class="form-radio text-brand-dark focus:ring-brand-dark">
                                <span class="ml-3">Bayar dengan Koin</span>
                            </label>
                        </div>
                        <div class="border-t my-4"></div>
                        <div class="bg-amber-100/50 border border-amber-300/50 text-sm text-gray-700 p-3 rounded-lg space-y-2">
                            <div class="flex justify-between">
                                <span>Saldo Koin Anda:</span>
                                <span class="font-bold bg-amber-200 px-2 py-1 rounded-md">100 Koin</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Dibutuhkan:</span>
                                <span class="font-bold">50 Koin</span>
                            </div>
                        </div>
                        <p class="text-sm text-green-600 mt-3 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Koin mencukupi untuk pembayaran ini.
                        </p>
                    </div>

                    <!-- Order Details -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm">
                        <h2 class="font-bold text-lg text-brand-dark mb-4">Order Details</h2>
                        <div class="space-y-3 text-sm text-gray-700">
                            <div class="flex justify-between">
                                <span>Total Price</span>
                                <span class="font-semibold">Rp 170.000</span>
                            </div>
                            <div class="flex justify-between text-green-600">
                                <span>Product Discount</span>
                                <span class="font-semibold">-Rp 20.000</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Subtotal</span>
                                <span class="font-semibold">Rp 150.000</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Shipping Cost</span>
                                <span class="font-semibold">Rp 10.000</span>
                            </div>
                            <div class="flex justify-between text-red-500">
                                <span>Shipping Discount</span>
                                <span class="font-semibold">Rp 0</span>
                            </div>
                        </div>
                        <div class="border-t my-4"></div>
                        <div class="flex justify-between font-bold text-lg">
                            <span>Total Payment</span>
                            <div class="text-right">
                                <p>Rp 160.000</p>
                                <p class="text-amber-600 text-sm font-normal">(160 Koin)</p>
                            </div>
                        </div>
                        <button class="w-full bg-amber-300 text-brand-dark font-bold py-3 rounded-lg mt-6 hover:bg-amber-400 transition-colors">
                            Proceed to Payment
                        </button>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm">
                        <h2 class="font-bold text-lg text-brand-dark mb-4">Promo Code</h2>
                        <div class="flex gap-2">
                            <input type="text" placeholder="Enter promo code" class="flex-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-dark">
                            <button class="px-4 py-2 bg-brand-dark text-white rounded-lg hover:bg-opacity-90 transition-colors">Apply</button>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Get additional discounts with promo codes!</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Change Address Modal -->
    <div id="addressModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-brand-dark">Change Delivery Address</h2>
                        <button onclick="closeAddressModal()" class="text-gray-500 hover:text-gray-700">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Saved Addresses -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-lg mb-4">Saved Addresses</h3>
                        <div class="space-y-3">
                            <label class="flex items-start p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <input type="radio" name="saved_address" value="home" class="mt-1 mr-3" checked>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="font-semibold">Home - Nanami</span>
                                        <span class="text-sm bg-green-100 text-green-800 px-2 py-1 rounded">Current</span>
                                    </div>
                                    <p class="text-sm text-gray-600">Jl. Raya Rambutan, Condong Catur, Depok, Sleman, Yogyakarta</p>
                                    <p class="text-sm text-gray-500">+62 8127898752</p>
                                </div>
                            </label>

                            <label class="flex items-start p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <input type="radio" name="saved_address" value="office" class="mt-1 mr-3">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="font-semibold">Office - Nanami</span>
                                    </div>
                                    <p class="text-sm text-gray-600">Jl. Malioboro No. 123, Yogyakarta City Center</p>
                                    <p class="text-sm text-gray-500">+62 8127898752</p>
                                </div>
                            </label>

                            <label class="flex items-start p-4 border rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <input type="radio" name="saved_address" value="parent" class="mt-1 mr-3">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="font-semibold">Parents House</span>
                                    </div>
                                    <p class="text-sm text-gray-600">Jl. Kaliurang KM 5, Sleman, Yogyakarta</p>
                                    <p class="text-sm text-gray-500">+62 8123456789</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Add New Address -->
                    <div class="mb-6">
                        <div class="flex items-center mb-4">
                            <input type="checkbox" id="add_new_address" class="mr-3">
                            <label for="add_new_address" class="font-semibold text-lg">Add New Address</label>
                        </div>
                        
                        <div id="new_address_form" class="hidden space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Label</label>
                                    <input type="text" placeholder="e.g., Home, Office" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-dark">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Recipient Name</label>
                                    <input type="text" placeholder="Full Name" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-dark">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Complete Address</label>
                                <textarea placeholder="Street address, building, floor, etc." rows="3" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-dark"></textarea>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                    <input type="text" placeholder="City" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-dark">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Province</label>
                                    <input type="text" placeholder="Province" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-dark">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                    <input type="text" placeholder="12345" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-dark">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                <input type="tel" placeholder="+62 812 3456 7890" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-dark">
                            </div>
                        </div>
                    </div>

                    <!-- Modal Actions -->
                    <div class="flex gap-3 pt-4 border-t">
                        <button onclick="closeAddressModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            Cancel
                        </button>
                        <button onclick="saveAddress()" class="flex-1 px-4 py-2 bg-amber-300 text-brand-dark font-semibold rounded-lg hover:bg-amber-400 transition-colors">
                            Save & Use This Address
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const addresses = {
            home: {
                name: "Home - Nanami",
                address: "Jl. Raya Rambutan, Condong Catur, Depok, Sleman, Yogyakarta",
                phone: "+62 8127898752"
            },
            office: {
                name: "Office - Nanami",
                address: "Jl. Malioboro No. 123, Yogyakarta City Center",
                phone: "+62 8127898752"
            },
            parent: {
                name: "Parents House",
                address: "Jl. Kaliurang KM 5, Sleman, Yogyakarta",
                phone: "+62 8123456789"
            }
        };

        function openAddressModal() {
            document.getElementById('addressModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeAddressModal() {
            document.getElementById('addressModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function saveAddress() {
            const selectedAddress = document.querySelector('input[name="saved_address"]:checked');
            const addNewAddress = document.getElementById('add_new_address').checked;
            
            if (addNewAddress) {
                alert('New address functionality would be implemented here');
                return;
            }
            
            if (selectedAddress) {
                const addressKey = selectedAddress.value;
                const addressData = addresses[addressKey];
                
                const deliveryAddressDiv = document.getElementById('delivery-address');
                deliveryAddressDiv.innerHTML = `
                    <p class="font-bold">${addressData.name}</p>
                    <p class="text-gray-600">${addressData.address}. ${addressData.phone}</p>
                `;
                
                closeAddressModal();
            }
        }

        document.getElementById('add_new_address').addEventListener('change', function() {
            const form = document.getElementById('new_address_form');
            if (this.checked) {
                form.classList.remove('hidden');
                document.querySelectorAll('input[name="saved_address"]').forEach(input => {
                    input.checked = false;
                });
            } else {
                form.classList.add('hidden');
            }
        });

        document.querySelectorAll('input[name="saved_address"]').forEach(input => {
            input.addEventListener('change', function() {
                if (this.checked) {
                    document.getElementById('add_new_address').checked = false;
                    document.getElementById('new_address_form').classList.add('hidden');
                }
            });
        });

        document.getElementById('addressModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAddressModal();
            }
        });
    </script>
</x-app-layout>