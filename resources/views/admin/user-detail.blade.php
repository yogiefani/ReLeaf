<x-admin-layout title="Detail User">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.users') }}" class="inline-flex items-center text-brand-dark hover:text-opacity-80">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Daftar Users
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- User Profile -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="text-center">
                <div class="w-20 h-20 bg-brand-dark rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-white text-2xl font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                </div>
                <h2 class="text-xl font-semibold text-brand-dark">{{ $user->name }}</h2>
                <p class="text-gray-600">{{ $user->email }}</p>

                <div class="mt-4 space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Koin Saat Ini:</span>
                        <span class="font-semibold text-brand-dark">{{ number_format($user->coins) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Pengajuan:</span>
                        <span class="font-semibold text-brand-dark">{{ $user->bookExchanges->count() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Orders:</span>
                        <span class="font-semibold text-brand-dark">{{ $user->orders->count() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Bergabung:</span>
                        <span class="text-gray-900">{{ $user->created_at->format('d M Y') }}</span>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t border-gray-200">
                    @foreach ($user->roles as $role)
                        <span
                            class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded-full">
                            {{ $role->name }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Book Exchanges & Coin Transactions -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Book Exchanges -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-brand-dark mb-4">Riwayat Tukar Buku</h3>

                @if ($user->bookExchanges->count() > 0)
                    <div class="space-y-4">
                        @foreach ($user->bookExchanges->take(5) as $exchange)
                            <div class="flex items-center justify-between p-4 border border-gray-100 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    @if ($exchange->photos->count() > 0)
                                        <img src="{{ asset('storage/' . $exchange->photos->first()->photo_path) }}"
                                            alt="Book cover" class="w-12 h-12 object-cover rounded">
                                    @else
                                        <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif

                                    <div>
                                        <p class="font-medium text-brand-dark">{{ $exchange->title }}</p>
                                        <p class="text-sm text-gray-500">{{ $exchange->code }}</p>
                                    </div>
                                </div>

                                <div class="text-right">
                                    @switch($exchange->status)
                                        @case('Diterima')
                                            <span
                                                class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded-full">Diterima</span>
                                            @if ($exchange->awarded_coins)
                                                <div class="text-xs text-gray-500 mt-1">{{ $exchange->awarded_coins }} koin
                                                </div>
                                            @endif
                                        @break

                                        @case('Menunggu Penilaian')
                                            <span
                                                class="inline-block bg-yellow-100 text-yellow-800 text-xs font-semibold px-2 py-1 rounded-full">Menunggu</span>
                                        @break

                                        @case('Ditolak')
                                            <span
                                                class="inline-block bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded-full">Ditolak</span>
                                        @break
                                    @endswitch
                                    <p class="text-xs text-gray-400 mt-1">{{ $exchange->created_at->format('d/m/Y') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                        @if ($user->bookExchanges->count() > 5)
                            <div class="text-center">
                                <p class="text-sm text-gray-500">Dan {{ $user->bookExchanges->count() - 5 }} pengajuan
                                    lainnya</p>
                            </div>
                        @endif
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">Belum ada riwayat tukar buku.</p>
                @endif
            </div>

            <!-- Coin Transactions -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-brand-dark mb-4">Riwayat Transaksi Koin</h3>

                @if ($user->coinTransactions->count() > 0)
                    <div class="space-y-3">
                        @foreach ($user->coinTransactions->take(10) as $transaction)
                            <div class="flex justify-between items-center p-3 border border-gray-100 rounded-lg">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $transaction->description }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ $transaction->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div class="text-right">
                                    <span
                                        class="text-sm font-semibold {{ $transaction->type === 'credit' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $transaction->type === 'credit' ? '+' : '-' }}{{ number_format($transaction->amount) }}
                                    </span>
                                    <span
                                        class="text-xs {{ $transaction->type === 'credit' ? 'text-green-500' : 'text-red-500' }}">
                                        {{ $transaction->type === 'credit' ? 'Credit' : 'Debit' }}
                                    </span>
                                </div>
                            </div>
                        @endforeach

                        @if ($user->coinTransactions->count() > 10)
                            <div class="text-center">
                                <p class="text-sm text-gray-500">Dan {{ $user->coinTransactions->count() - 10 }}
                                    transaksi lainnya</p>
                            </div>
                        @endif
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">Belum ada transaksi koin.</p>
                @endif
            </div>

            <!-- Orders -->
            @if ($user->orders->count() > 0)
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-brand-dark mb-4">Riwayat Pembelian</h3>

                    <div class="space-y-4">
                        @foreach ($user->orders->take(5) as $order)
                            <div class="flex justify-between items-center p-4 border border-gray-100 rounded-lg">
                                <div>
                                    <p class="font-medium text-brand-dark">Order #{{ $order->id }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->items->count() }} item(s)</p>
                                    <p class="text-xs text-gray-400">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-brand-dark">{{ number_format($order->total_amount) }}
                                        koin</p>
                                    <span
                                        class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded-full">{{ $order->status }}</span>
                                </div>
                            </div>
                        @endforeach

                        @if ($user->orders->count() > 5)
                            <div class="text-center">
                                <p class="text-sm text-gray-500">Dan {{ $user->orders->count() - 5 }} order lainnya</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
