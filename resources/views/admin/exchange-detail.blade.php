<x-admin-layout title="Detail Pengajuan Tukar Buku">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.book-exchanges') }}"
            class="inline-flex items-center text-brand-dark hover:text-opacity-80">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Daftar Pengajuan
        </a>
    </div>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Book Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Info -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-xl font-semibold text-brand-dark mb-4">Informasi Buku</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kode Pengajuan</label>
                        <p class="mt-1 text-lg font-semibold text-brand-dark">{{ $exchange->code }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <div class="mt-1">
                            @switch($exchange->status)
                                @case('Diterima')
                                    <span
                                        class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                        Diterima
                                    </span>
                                @break

                                @case('Menunggu Penilaian')
                                    <span
                                        class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu Penilaian
                                    </span>
                                @break

                                @case('Ditolak')
                                    <span
                                        class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                @break
                            @endswitch
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Judul Buku</label>
                        <p class="mt-1 text-gray-900">{{ $exchange->title }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Penulis</label>
                        <p class="mt-1 text-gray-900">{{ $exchange->author }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Genre</label>
                        <p class="mt-1 text-gray-900">{{ $exchange->genre }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Bahasa</label>
                        <p class="mt-1 text-gray-900">{{ $exchange->language }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Tanggal Pengajuan</label>
                        <p class="mt-1 text-gray-900">{{ $exchange->created_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Condition Description -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-brand-dark mb-3">Deskripsi Kondisi Buku</h3>
                <p class="text-gray-700 leading-relaxed">{{ $exchange->condition_description }}</p>
            </div>

            <!-- Photos -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-brand-dark mb-4">Foto Buku</h3>

                @if ($exchange->photos->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($exchange->photos as $photo)
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Book photo"
                                    class="w-full h-48 object-cover rounded-lg cursor-pointer hover:opacity-75 transition-opacity"
                                    onclick="openImageModal('{{ asset('storage/' . $photo->photo_path) }}')">
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-25 rounded-lg transition-opacity flex items-center justify-center">
                                    <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Tidak ada foto yang diunggah.</p>
                @endif
            </div>

            <!-- Rejection Reason (if rejected) -->
            @if ($exchange->status === 'Ditolak' && $exchange->rejection_reason)
                <div class="bg-red-50 border border-red-200 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-red-800 mb-3">Alasan Penolakan</h3>
                    <p class="text-red-700">{{ $exchange->rejection_reason }}</p>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- User Info -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-brand-dark mb-4">Informasi User</h3>

                <div class="text-center mb-4">
                    <div class="w-16 h-16 bg-brand-dark rounded-full flex items-center justify-center mx-auto mb-3">
                        <span
                            class="text-white text-xl font-bold">{{ strtoupper(substr($exchange->user->name, 0, 1)) }}</span>
                    </div>
                    <h4 class="font-semibold text-gray-900">{{ $exchange->user->name }}</h4>
                    <p class="text-sm text-gray-500">{{ $exchange->user->email }}</p>
                </div>

                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Koin Saat Ini:</span>
                        <span class="font-semibold text-brand-dark">{{ number_format($exchange->user->coins) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Pengajuan:</span>
                        <span
                            class="font-semibold text-brand-dark">{{ $exchange->user->bookExchanges->count() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Bergabung:</span>
                        <span class="text-gray-900">{{ $exchange->user->created_at->format('M Y') }}</span>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t border-gray-200">
                    <a href="{{ route('admin.users.show', $exchange->user->id) }}"
                        class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-lg transition-colors text-center block">
                        Lihat Detail User
                    </a>
                </div>
            </div>

            <!-- Action Buttons -->
            @if ($exchange->status === 'Menunggu Penilaian')
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-brand-dark mb-4">Aksi</h3>

                    <!-- Approve Form -->
                    <form action="{{ route('admin.book-exchanges.approve', $exchange->id) }}" method="POST"
                        class="mb-4">
                        @csrf
                        <div class="mb-3">
                            <label for="awarded_coins" class="block text-sm font-medium text-gray-700 mb-1">Jumlah
                                Koin</label>
                            <input type="number" name="awarded_coins" id="awarded_coins" min="1" max="500"
                                value="50"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        </div>
                        <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors"
                            onclick="return confirm('Yakin ingin menyetujui pengajuan ini?')">
                            Setujui Pengajuan
                        </button>
                    </form>

                    <!-- Reject Button -->
                    <button type="button" onclick="openRejectModal()"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        Tolak Pengajuan
                    </button>
                </div>
            @endif

            <!-- Coin Transaction History -->
            @if ($exchange->coinTransactions->count() > 0)
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-brand-dark mb-4">Riwayat Transaksi</h3>
                    <div class="space-y-2">
                        @foreach ($exchange->coinTransactions as $transaction)
                            <div class="flex justify-between items-center p-2 bg-green-50 rounded">
                                <span class="text-sm text-green-700">{{ $transaction->description }}</span>
                                <span
                                    class="font-semibold text-green-600">+{{ number_format($transaction->amount) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </div>
                <div class="mt-2 px-7 py-3">
                    <h3 class="text-lg font-medium text-gray-900 text-center">Tolak Pengajuan</h3>
                    <div class="mt-4">
                        <form action="{{ route('admin.book-exchanges.reject', $exchange->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">
                                    Alasan Penolakan
                                </label>
                                <textarea name="rejection_reason" id="rejection_reason" rows="4" placeholder="Jelaskan alasan penolakan..."
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" required></textarea>
                            </div>
                            <div class="flex gap-3">
                                <button type="button" onclick="closeRejectModal()"
                                    class="flex-1 px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                    Tolak
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 overflow-y-auto h-full w-full hidden z-50"
        onclick="closeImageModal()">
        <div class="relative top-20 mx-auto p-5 border w-auto shadow-lg rounded-md bg-white max-w-4xl">
            <div class="flex justify-end">
                <button onclick="closeImageModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <img id="modalImage" src="" alt="Book photo" class="w-full h-auto rounded">
        </div>
    </div>

    <script>
        function openRejectModal() {
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }

        function openImageModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }
    </script>
</x-admin-layout>
