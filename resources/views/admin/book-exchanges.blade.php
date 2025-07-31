<x-admin-layout title="Manajemen Tukar Buku">
    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6 border border-gray-100">
        <form method="GET" action="{{ route('admin.book-exchanges') }}" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-64">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                    placeholder="Cari berdasarkan judul, penulis, kode, atau nama user..."
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-brand-dark focus:border-brand-dark">
            </div>

            <div class="min-w-40">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-brand-dark focus:border-brand-dark">
                    <option value="">Semua Status</option>
                    <option value="Menunggu Penilaian"
                        {{ request('status') == 'Menunggu Penilaian' ? 'selected' : '' }}>Menunggu Penilaian</option>
                    <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <div class="flex items-end">
                <button type="submit"
                    class="px-6 py-2 bg-brand-dark text-white rounded-lg hover:bg-opacity-90 transition-colors">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku
                            & User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Detail</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($exchanges as $exchange)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if ($exchange->photos->count() > 0)
                                        <img src="{{ asset('storage/' . $exchange->photos->first()->photo_path) }}"
                                            alt="Book cover" class="w-12 h-12 object-cover rounded mr-4">
                                    @else
                                        <div
                                            class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center mr-4">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $exchange->title }}</div>
                                        <div class="text-sm text-gray-500">oleh {{ $exchange->author }}</div>
                                        <div class="text-xs text-gray-400">User: {{ $exchange->user->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    <div><strong>Kode:</strong> {{ $exchange->code }}</div>
                                    <div><strong>Genre:</strong> {{ $exchange->genre }}</div>
                                    <div><strong>Bahasa:</strong> {{ $exchange->language }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @switch($exchange->status)
                                    @case('Diterima')
                                        <span
                                            class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Diterima
                                        </span>
                                        @if ($exchange->awarded_coins)
                                            <div class="text-xs text-gray-500 mt-1">{{ $exchange->awarded_coins }} koin</div>
                                        @endif
                                    @break

                                    @case('Menunggu Penilaian')
                                        <span
                                            class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Menunggu Penilaian
                                        </span>
                                    @break

                                    @case('Ditolak')
                                        <span
                                            class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            Ditolak
                                        </span>
                                    @break
                                @endswitch
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $exchange->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.book-exchanges.show', $exchange->id) }}"
                                    class="text-brand-dark hover:text-opacity-80 bg-amber-100 hover:bg-amber-200 px-3 py-1 rounded transition-colors">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        <p>Tidak ada data pengajuan tukar buku.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($exchanges->hasPages())
                <div class="px-6 py-3 border-t border-gray-200">
                    {{ $exchanges->links() }}
                </div>
            @endif
        </div>
    </x-admin-layout>
