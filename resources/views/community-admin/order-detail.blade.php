@extends('layouts.admin.app')

@section('title', 'Order Detail - Community Admin')

@section('content')
    <div class="min-h-screen bg-brand-beige p-6">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center gap-4 mb-4">
                    <a href="{{ route('community-admin.dashboard') }}"
                        class="bg-white hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg transition-colors">
                        ← Kembali
                    </a>
                    <h1 class="text-2xl font-bold text-brand-dark">Order #{{ $order->id }}</h1>
                    <span
                        class="px-3 py-1 {{ $order->delivery_status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }} text-sm rounded-full">
                        {{ $order->delivery_status_label }}
                    </span>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <!-- Order Info -->
                <div class="md:col-span-2 space-y-6">
                    <!-- Customer Info -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-brand-dark mb-4">Informasi Pembeli</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-600">Nama</p>
                                <p class="font-medium">{{ $order->user->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Email</p>
                                <p class="font-medium">{{ $order->user->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Alamat Pengiriman</p>
                                <p class="font-medium">{{ $order->address->full_address ?? 'Tidak ada alamat' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-brand-dark mb-4">Item yang Dibeli</h3>
                        <div class="space-y-4">
                            @foreach ($order->items as $item)
                                <div class="flex gap-4 p-4 border border-gray-200 rounded-lg">
                                    <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-brand-dark">{{ $item->book->title }}</h4>
                                        <p class="text-sm text-gray-600">{{ $item->book->author }}</p>
                                        <p class="text-sm text-gray-500 mt-1">Stok tersedia: {{ $item->book->stock }}</p>
                                        <div class="flex justify-between items-center mt-2">
                                            <span class="text-sm text-gray-600">Jumlah: {{ $item->quantity }}</span>
                                            <span class="font-semibold text-brand-dark">{{ number_format($item->price) }}
                                                koin</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="border-t border-gray-200 mt-4 pt-4">
                            <div class="flex justify-between items-center text-lg font-semibold text-brand-dark">
                                <span>Total</span>
                                <span>{{ number_format($order->total_amount) }} koin</span>
                            </div>
                        </div>
                    </div>

                    <!-- Delivery Timeline -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-brand-dark mb-4">Timeline Pengiriman</h3>
                        <div class="space-y-4">
                            <div class="flex items-center gap-4">
                                <div class="w-4 h-4 bg-green-500 rounded-full flex-shrink-0"></div>
                                <div>
                                    <p class="font-medium">Order Dibuat</p>
                                    <p class="text-sm text-gray-600">{{ $order->created_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>

                            @if ($order->picked_up_at)
                                <div class="flex items-center gap-4">
                                    <div class="w-4 h-4 bg-green-500 rounded-full flex-shrink-0"></div>
                                    <div>
                                        <p class="font-medium">Buku Diambil dari Penjual</p>
                                        <p class="text-sm text-gray-600">{{ $order->picked_up_at->format('d M Y H:i') }}
                                        </p>
                                    </div>
                                </div>
                            @endif

                            @if ($order->delivered_at)
                                <div class="flex items-center gap-4">
                                    <div class="w-4 h-4 bg-green-500 rounded-full flex-shrink-0"></div>
                                    <div>
                                        <p class="font-medium">Buku Sampai ke Pembeli</p>
                                        <p class="text-sm text-gray-600">{{ $order->delivered_at->format('d M Y H:i') }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Status Update Panel -->
                <div class="space-y-6">
                    <!-- Current Status -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-brand-dark mb-4">Status Saat Ini</h3>
                        <div class="text-center">
                            <div
                                class="w-16 h-16 mx-auto mb-3 {{ $order->delivery_status === 'completed' ? 'bg-green-100' : 'bg-blue-100' }} rounded-full flex items-center justify-center">
                                @if ($order->delivery_status === 'completed')
                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                @else
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                @endif
                            </div>
                            <p class="font-semibold text-brand-dark">{{ $order->delivery_status_label }}</p>
                            @if ($order->delivery_notes)
                                <p class="text-sm text-gray-600 mt-2 italic">"{{ $order->delivery_notes }}"</p>
                            @endif
                        </div>
                    </div>

                    <!-- Update Status Form -->
                    @if ($order->delivery_status !== 'completed')
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h3 class="text-lg font-semibold text-brand-dark mb-4">Update Status</h3>

                            <form action="{{ route('community-admin.update-status', $order->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <div class="mb-4">
                                    <label for="delivery_status" class="block text-sm font-medium text-gray-700 mb-2">Status
                                        Baru</label>
                                    <select name="delivery_status" id="delivery_status"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-300 focus:border-transparent"
                                        required>
                                        <option value="">Pilih Status</option>
                                        @if ($order->delivery_status === 'pending')
                                            <option value="preparing">Sedang Disiapkan</option>
                                        @endif
                                        @if (in_array($order->delivery_status, ['pending', 'preparing']))
                                            <option value="picked_up">Diambil dari Penjual</option>
                                        @endif
                                        @if (in_array($order->delivery_status, ['preparing', 'picked_up']))
                                            <option value="in_transit">Dalam Perjalanan</option>
                                        @endif
                                        @if (in_array($order->delivery_status, ['picked_up', 'in_transit']))
                                            <option value="delivered">Terkirim ke Pembeli</option>
                                        @endif
                                        @if ($order->delivery_status === 'delivered')
                                            <option value="completed">Selesai</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="delivery_notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan
                                        (Opsional)</label>
                                    <textarea name="delivery_notes" id="delivery_notes" rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-300 focus:border-transparent"
                                        placeholder="Tambahkan catatan tentang status pengiriman..."></textarea>
                                </div>

                                <button type="submit"
                                    class="w-full bg-amber-300 hover:bg-amber-400 text-brand-dark font-medium py-2 px-4 rounded-lg transition-colors">
                                    Update Status
                                </button>
                            </form>
                        </div>
                    @endif

                    <!-- Admin Info -->
                    @if ($order->assignedTo)
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h3 class="text-lg font-semibold text-brand-dark mb-4">Admin yang Menangani</h3>
                            <div class="text-center">
                                <div
                                    class="w-12 h-12 bg-gray-200 rounded-full mx-auto mb-2 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <p class="font-medium text-brand-dark">{{ $order->assignedTo->name }}</p>
                                <p class="text-sm text-gray-600">{{ $order->assignedTo->email }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
