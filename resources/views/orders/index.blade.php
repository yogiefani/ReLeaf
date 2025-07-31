<x-app-layout>
    <div class="bg-gray-50 font-oxygen min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12 max-w-7xl">

            <h1 class="font-playfair text-3xl sm:text-4xl lg:text-5xl font-bold text-brand-dark mb-8 lg:mb-10">Pesanan
                Saya</h1>

            <div class="space-y-8">
                @forelse ($orders as $order)
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                        <div class="p-6">
                            <div
                                class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 border-b pb-4 mb-4">
                                <div>
                                    <p class="font-bold text-lg text-brand-dark">Pesanan #{{ $order->order_number }}</p>
                                    <p class="text-sm text-gray-500">Dipesan pada
                                        {{ $order->created_at->format('d F Y') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-500">Total</p>
                                    <p class="font-bold text-lg text-brand-dark">
                                        Rp{{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <!-- Progress Tracker -->
                            @php
                                // Gunakan delivery_status untuk progress yang lebih akurat
                                $deliveryStatuses = [
                                    'pending' => 'Menunggu',
                                    'preparing' => 'Diproses',
                                    'picked_up' => 'Diambil',
                                    'in_transit' => 'Dikirim',
                                    'delivered' => 'Terkirim',
                                    'completed' => 'Selesai',
                                ];
                                $statusKeys = array_keys($deliveryStatuses);
                                $currentStatusIndex = array_search(
                                    $order->delivery_status ?? $order->status,
                                    $statusKeys,
                                );
                                if ($currentStatusIndex === false) {
                                    // Fallback ke status utama jika delivery_status tidak ditemukan
                                    $fallbackStatuses = [
                                        'pending' => 'Menunggu',
                                        'processing' => 'Diproses',
                                        'shipped' => 'Dikirim',
                                        'completed' => 'Selesai',
                                    ];
                                    $statusKeys = array_keys($fallbackStatuses);
                                    $currentStatusIndex = array_search($order->status, $statusKeys);
                                    $deliveryStatuses = $fallbackStatuses;
                                }
                            @endphp
                            <div class="mb-6">
                                <div class="flex justify-between items-center text-xs text-center">
                                    @foreach ($deliveryStatuses as $key => $status)
                                        @php $index = array_search($key, $statusKeys); @endphp
                                        <div class="flex-1">
                                            <div
                                                class="w-full h-2 rounded-full {{ $index <= $currentStatusIndex ? 'bg-green-500' : 'bg-gray-200' }}">
                                            </div>
                                            <p
                                                class="mt-2 font-semibold {{ $index <= $currentStatusIndex ? 'text-green-600' : 'text-gray-400' }}">
                                                {{ $status }}</p>
                                        </div>
                                        @if (!$loop->last)
                                            <div
                                                class="flex-shrink-0 w-1/4 h-0.5 {{ $index < $currentStatusIndex ? 'bg-green-500' : 'bg-gray-200' }} -mx-1">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <!-- Status Info and Admin Notes -->
                                @if ($order->delivery_notes || $order->assignedTo)
                                    <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                                        @if ($order->assignedTo)
                                            <p class="text-sm text-blue-800">
                                                <strong>Admin yang menangani:</strong> {{ $order->assignedTo->name }}
                                            </p>
                                        @endif
                                        @if ($order->delivery_notes)
                                            <p class="text-sm text-blue-700 mt-1">
                                                <strong>Catatan:</strong> {{ $order->delivery_notes }}
                                            </p>
                                        @endif
                                        @if ($order->picked_up_at)
                                            <p class="text-xs text-blue-600 mt-1">
                                                Diambil pada: {{ $order->picked_up_at->format('d M Y H:i') }}
                                            </p>
                                        @endif
                                        @if ($order->delivered_at)
                                            <p class="text-xs text-blue-600 mt-1">
                                                Terkirim pada: {{ $order->delivered_at->format('d M Y H:i') }}
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- Order Items -->
                            <div class="space-y-4">
                                @foreach ($order->items as $item)
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-20 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                            @if ($item->book->cover_image && file_exists(public_path($item->book->cover_image)))
                                                <img src="{{ asset($item->book->cover_image) }}"
                                                    alt="{{ $item->book->title }}" class="w-full h-full object-cover">
                                            @else
                                                <div
                                                    class="w-full h-full flex items-center justify-center bg-gradient-to-br from-amber-100 to-amber-200">
                                                    <svg class="w-8 h-8 text-amber-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                                        </path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-grow">
                                            <p class="font-semibold text-brand-dark">{{ $item->book->title }}</p>
                                            <p class="text-sm text-gray-500">{{ $item->quantity }} x
                                                Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-semibold text-brand-dark">
                                                Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <p class="text-gray-500">Anda belum memiliki pesanan.</p>
                        <a href="{{ route('home') }}"
                            class="mt-4 inline-block bg-amber-300 text-brand-dark font-bold py-3 px-6 rounded-lg hover:bg-amber-400 transition-colors">
                            Mulai Berbelanja
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
