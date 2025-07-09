<x-app-layout>
    <div class="bg-gray-50 font-oxygen min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12 max-w-7xl">

            <h1 class="font-playfair text-3xl sm:text-4xl lg:text-5xl font-bold text-brand-dark mb-8 lg:mb-10">Pesanan Saya</h1>

            <div class="space-y-8">
                @forelse ($orders as $order)
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 border-b pb-4 mb-4">
                                <div>
                                    <p class="font-bold text-lg text-brand-dark">Pesanan #{{ $order->order_number }}</p>
                                    <p class="text-sm text-gray-500">Dipesan pada {{ $order->created_at->format('d F Y') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-500">Total</p>
                                    <p class="font-bold text-lg text-brand-dark">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <!-- Progress Tracker -->
                            @php
                                $statuses = ['pending' => 'Menunggu', 'processing' => 'Diproses', 'shipped' => 'Dikirim', 'completed' => 'Selesai'];
                                $statusKeys = array_keys($statuses);
                                $currentStatusIndex = array_search($order->status, $statusKeys);
                            @endphp
                            <div class="mb-6">
                                <div class="flex justify-between items-center text-xs text-center">
                                    @foreach ($statuses as $key => $status)
                                        @php $index = array_search($key, $statusKeys); @endphp
                                        <div class="flex-1">
                                            <div class="w-full h-2 rounded-full {{ $index <= $currentStatusIndex ? 'bg-green-500' : 'bg-gray-200' }}"></div>
                                            <p class="mt-2 font-semibold {{ $index <= $currentStatusIndex ? 'text-green-600' : 'text-gray-400' }}">{{ $status }}</p>
                                        </div>
                                        @if (!$loop->last)
                                            <div class="flex-shrink-0 w-1/4 h-0.5 {{ $index < $currentStatusIndex ? 'bg-green-500' : 'bg-gray-200' }} -mx-1"></div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <!-- Order Items -->
                            <div class="space-y-4">
                                @foreach ($order->items as $item)
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-20 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                        <img src="{{ asset($item->book->cover_image) }}" alt="{{ $item->book->title }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-grow">
                                        <p class="font-semibold text-brand-dark">{{ $item->book->title }}</p>
                                        <p class="text-sm text-gray-500">{{ $item->quantity }} x Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-brand-dark">Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <p class="text-gray-500">Anda belum memiliki pesanan.</p>
                        <a href="{{ route('home') }}" class="mt-4 inline-block bg-amber-300 text-brand-dark font-bold py-3 px-6 rounded-lg hover:bg-amber-400 transition-colors">
                            Mulai Berbelanja
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
