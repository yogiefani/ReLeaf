<x-admin-layout title="Dashboard">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="font-semibold text-gray-700">Total Users</h2>
                    <p class="text-2xl font-bold text-brand-dark">{{ $data['totalUsers'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="bg-green-100 text-green-600 p-3 rounded-full">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="font-semibold text-gray-700">Total Pengajuan</h2>
                    <p class="text-2xl font-bold text-brand-dark">{{ $data['totalExchanges'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="bg-yellow-100 text-yellow-600 p-3 rounded-full">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="font-semibold text-gray-700">Menunggu Review</h2>
                    <p class="text-2xl font-bold text-brand-dark">{{ $data['pendingExchanges'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="bg-amber-100 text-amber-600 p-3 rounded-full">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="font-semibold text-gray-700">Koin Terdistribusi</h2>
                    <p class="text-2xl font-bold text-brand-dark">{{ number_format($data['totalCoinsDistributed']) }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Distribution -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h3 class="font-semibold text-gray-700 mb-4">Status Pengajuan</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Disetujui</span>
                    <div class="flex items-center">
                        <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                            <div class="bg-green-500 h-2 rounded-full"
                                style="width: {{ $data['totalExchanges'] > 0 ? ($data['approvedExchanges'] / $data['totalExchanges']) * 100 : 0 }}%">
                            </div>
                        </div>
                        <span class="text-sm font-semibold text-brand-dark">{{ $data['approvedExchanges'] }}</span>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Menunggu</span>
                    <div class="flex items-center">
                        <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                            <div class="bg-yellow-500 h-2 rounded-full"
                                style="width: {{ $data['totalExchanges'] > 0 ? ($data['pendingExchanges'] / $data['totalExchanges']) * 100 : 0 }}%">
                            </div>
                        </div>
                        <span class="text-sm font-semibold text-brand-dark">{{ $data['pendingExchanges'] }}</span>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Ditolak</span>
                    <div class="flex items-center">
                        <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                            <div class="bg-red-500 h-2 rounded-full"
                                style="width: {{ $data['totalExchanges'] > 0 ? ($data['rejectedExchanges'] / $data['totalExchanges']) * 100 : 0 }}%">
                            </div>
                        </div>
                        <span class="text-sm font-semibold text-brand-dark">{{ $data['rejectedExchanges'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Exchanges -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-gray-700">Pengajuan Terbaru</h3>
                <a href="{{ route('admin.book-exchanges') }}"
                    class="text-amber-600 hover:text-amber-700 text-sm font-medium">
                    Lihat Semua →
                </a>
            </div>

            <div class="space-y-3">
                @forelse($recentExchanges as $exchange)
                    <div
                        class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-gray-50">
                        <div class="flex items-center space-x-3">
                            @if ($exchange->photos->count() > 0)
                                <img src="{{ asset('storage/' . $exchange->photos->first()->photo_path) }}"
                                    alt="Book cover" class="w-10 h-10 object-cover rounded">
                            @else
                                <div class="w-10 h-10 bg-gray-200 rounded flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                        </path>
                                    </svg>
                                </div>
                            @endif

                            <div>
                                <p class="font-medium text-brand-dark">{{ $exchange->title }}</p>
                                <p class="text-sm text-gray-500">oleh {{ $exchange->user->name }}</p>
                            </div>
                        </div>

                        <div class="text-right">
                            @switch($exchange->status)
                                @case('Diterima')
                                    <span
                                        class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded-full">Diterima</span>
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
                            <p class="text-xs text-gray-400 mt-1">{{ $exchange->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    @empty
                        <p class="text-center text-gray-500 py-8">Belum ada pengajuan tukar buku.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h3 class="font-semibold text-gray-700 mb-4">Quick Actions</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('admin.book-exchanges', ['status' => 'Menunggu Penilaian']) }}"
                    class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="bg-yellow-100 text-yellow-600 p-2 rounded-full mr-3">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-brand-dark">Review Pengajuan</p>
                        <p class="text-sm text-gray-500">{{ $data['pendingExchanges'] }} menunggu review</p>
                    </div>
                </a>

                <a href="{{ route('admin.users') }}"
                    class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="bg-blue-100 text-blue-600 p-2 rounded-full mr-3">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-brand-dark">Kelola Users</p>
                        <p class="text-sm text-gray-500">{{ $data['totalUsers'] }} users terdaftar</p>
                    </div>
                </a>

                <a href="{{ route('admin.coin-transactions') }}"
                    class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="bg-amber-100 text-amber-600 p-2 rounded-full mr-3">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-brand-dark">Transaksi Koin</p>
                        <p class="text-sm text-gray-500">Monitor aktivitas koin</p>
                    </div>
                </a>
            </div>
        </div>
    </x-admin-layout>
