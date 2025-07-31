@extends('layouts.admin.app')

@section('title', 'Community Admin Dashboard')

@section('content')
    <div class="min-h-screen bg-brand-beige p-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-brand-dark mb-2">Community Admin Dashboard</h1>
                <p class="text-gray-600">Kelola pengantaran buku untuk komunitas</p>
            </div>

            <!-- Stats -->
            <div class="grid md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg p-6 shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Total Orders</p>
                            <p class="text-2xl font-bold text-brand-dark">{{ $stats['total_orders'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-6 shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-100 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Pending Orders</p>
                            <p class="text-2xl font-bold text-brand-dark">{{ $stats['pending_orders'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-6 shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Orders Saya</p>
                            <p class="text-2xl font-bold text-brand-dark">{{ $stats['my_assigned_orders'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-6 shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Completed</p>
                            <p class="text-2xl font-bold text-brand-dark">{{ $stats['completed_orders'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Available Orders -->
            <div class="bg-white rounded-lg shadow-sm mb-8">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-brand-dark">Orders Tersedia</h2>
                    <p class="text-gray-600 text-sm">Orders yang belum diambil admin</p>
                </div>
                <div class="p-6">
                    @if ($availableOrders->isEmpty())
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <p class="text-gray-500">Tidak ada orders yang tersedia</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($availableOrders as $order)
                                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-2">
                                                <span class="font-semibold text-brand-dark">Order
                                                    #{{ $order->id }}</span>
                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">
                                                    {{ $order->delivery_status_label }}
                                                </span>
                                            </div>
                                            <p class="text-gray-600 text-sm mb-2">Pembeli: {{ $order->user->name }}</p>
                                            <div class="text-sm text-gray-500">
                                                <p>{{ $order->items->count() }} item(s)</p>
                                                <p>Total: {{ number_format($order->total_amount) }} koin</p>
                                                <p>Alamat: {{ $order->address->full_address ?? 'Tidak ada alamat' }}</p>
                                            </div>
                                            <p class="text-xs text-gray-400 mt-2">{{ $order->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        <div class="ml-4 space-y-2">
                                            <form action="{{ route('community-admin.take-order', $order->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-amber-300 hover:bg-amber-400 text-brand-dark px-4 py-2 rounded-lg font-medium transition-colors">
                                                    Ambil Order
                                                </button>
                                            </form>
                                            <a href="{{ route('community-admin.order-detail', $order->id) }}"
                                                class="block text-center bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm transition-colors">
                                                Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- My Orders -->
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-brand-dark">Orders Saya</h2>
                    <p class="text-gray-600 text-sm">Orders yang sedang saya handle</p>
                </div>
                <div class="p-6">
                    @if ($myOrders->isEmpty())
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <p class="text-gray-500">Anda belum mengambil order apapun</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($myOrders as $order)
                                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-2">
                                                <span class="font-semibold text-brand-dark">Order
                                                    #{{ $order->id }}</span>
                                                <span
                                                    class="px-2 py-1 {{ $order->delivery_status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }} text-xs rounded-full">
                                                    {{ $order->delivery_status_label }}
                                                </span>
                                            </div>
                                            <p class="text-gray-600 text-sm mb-2">Pembeli: {{ $order->user->name }}</p>
                                            <div class="text-sm text-gray-500">
                                                <p>{{ $order->items->count() }} item(s)</p>
                                                <p>Total: {{ number_format($order->total_amount) }} koin</p>
                                                <p>Alamat: {{ $order->address->full_address ?? 'Tidak ada alamat' }}</p>
                                            </div>
                                            @if ($order->delivery_notes)
                                                <p class="text-sm text-gray-600 mt-2 italic">Note:
                                                    {{ $order->delivery_notes }}</p>
                                            @endif
                                            <p class="text-xs text-gray-400 mt-2">
                                                {{ $order->created_at->diffForHumans() }}</p>
                                        </div>
                                        <div class="ml-4">
                                            <a href="{{ route('community-admin.order-detail', $order->id) }}"
                                                class="bg-brand-dark hover:bg-gray-800 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                                                Kelola Order
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
