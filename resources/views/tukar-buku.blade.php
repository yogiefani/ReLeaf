<x-app-layout>
    @php
    // Data ini bisa juga Anda pindahkan ke controller atau config jika ingin lebih rapi
    $genres = ['Fiksi', 'Non-Fiksi', 'Sains', 'Sejarah', 'Self-Development', 'Biografi', 'Novel'];
    $languages = ['Indonesia', 'Inggris'];
    @endphp

    <div class="bg-gray-50 font-oxygen">
        <div class="container mx-auto px-6 md:px-12 py-12 md:py-16">

            <div class="text-center mb-12">
                <h1 class="font-playfair text-5xl font-bold text-brand-dark">Tukar Buku</h1>
                <p class="text-lg text-gray-600 mt-2">Kirim buku kamu dan tukar menjadi koin!</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 md:gap-12 items-start">
                
                {{-- KOLOM KIRI - FORMULIR --}}
                <div class="lg:col-span-3 bg-white p-8 rounded-2xl shadow-sm space-y-6">
                    
                    {{-- Menampilkan pesan sukses setelah submit --}}
                    @if (session('success'))
                        <div class="text-center py-10">
                            <svg class="mx-auto h-20 w-20 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <h2 class="font-playfair text-3xl font-bold text-brand-dark mt-4">Pengajuan Berhasil Dikirim!</h2>
                            <p class="mt-2 text-gray-600">{{ session('success') }}</p>
                            <a href="{{ route('book-exchange.index') }}" class="bg-amber-300 text-brand-dark font-bold py-3 px-8 rounded-lg mt-8 hover:bg-amber-400 transition-colors inline-block">
                                Ajukan Buku Lain
                            </a>
                        </div>
                    @else
                        <form action="{{ route('book-exchange.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="title" class="font-semibold text-brand-dark">Judul Buku</label>
                                <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Masukkan judul buku" class="mt-2 w-full border-gray-300 rounded-lg focus:ring-brand-dark focus:border-brand-dark">
                                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="author" class="font-semibold text-brand-dark">Penulis</label>
                                <input type="text" id="author" name="author" value="{{ old('author') }}" placeholder="Masukkan nama penulis" class="mt-2 w-full border-gray-300 rounded-lg focus:ring-brand-dark focus:border-brand-dark">
                                @error('author') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="genre" class="font-semibold text-brand-dark">Genre</label>
                                    <select id="genre" name="genre" class="mt-2 w-full border-gray-300 rounded-lg focus:ring-brand-dark focus:border-brand-dark">
                                        <option disabled selected>Pilih genre buku</option>
                                        @foreach($genres as $genre)
                                            <option value="{{ $genre }}" {{ old('genre') == $genre ? 'selected' : '' }}>{{ $genre }}</option>
                                        @endforeach
                                    </select>
                                     @error('genre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="language" class="font-semibold text-brand-dark">Bahasa</label>
                                    <select id="language" name="language" class="mt-2 w-full border-gray-300 rounded-lg focus:ring-brand-dark focus:border-brand-dark">
                                        <option disabled selected>Pilih bahasa buku</option>
                                        @foreach($languages as $lang)
                                            <option value="{{ $lang }}" {{ old('language') == $lang ? 'selected' : '' }}>{{ $lang }}</option>
                                        @endforeach
                                    </select>
                                    @error('language') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div>
                                <label for="condition_description" class="font-semibold text-brand-dark">Deskripsi Kondisi Buku</label>
                                <textarea id="condition_description" name="condition_description" rows="4" placeholder="Jelaskan kondisi buku (misal: sangat baik, ada sedikit lipatan di halaman, cover masih utuh, dll.)" class="mt-2 w-full border-gray-300 rounded-lg focus:ring-brand-dark focus:border-brand-dark">{{ old('condition_description') }}</textarea>
                                @error('condition_description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="font-semibold text-brand-dark">Foto Buku (Minimal 1, Maksimal 3 foto)</label>
                                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" /></svg>
                                        <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                            <label for="photos" class="relative cursor-pointer rounded-md bg-white font-semibold text-brand-dark focus-within:outline-none focus-within:ring-2 focus-within:ring-brand-dark focus-within:ring-offset-2 hover:text-brand-dark/80">
                                                <span>Klik untuk mengunggah</span>
                                                <input id="photos" name="photos[]" type="file" class="sr-only" multiple>
                                            </label>
                                            <p class="pl-1">atau drag & drop</p>
                                        </div>
                                        <p class="text-xs leading-5 text-gray-600">PNG, JPG hingga 2MB (0/3 foto)</p>
                                    </div>
                                </div>
                                @error('photos') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <p class="text-sm text-gray-500"><span class="font-bold">Tips:</span> Pastikan foto menunjukkan kondisi buku dengan jelas. Sertakan foto cover depan, belakang, dan halaman dalam jika ada kerusakan.</p>
                            </div>
                            <button type="submit" class="w-full bg-amber-300 text-brand-dark font-bold py-4 rounded-lg mt-6 hover:bg-amber-400 transition-colors text-lg">
                                Ajukan Buku
                            </button>
                        </form>
                    @endif
                </div>

                {{-- KOLOM KANAN - RIWAYAT --}}
                <div class="lg:col-span-2">
                    <div class="bg-white p-6 rounded-2xl shadow-sm space-y-5">
                        <h2 class="font-playfair text-3xl font-bold text-brand-dark text-center mb-4">Riwayat Penukaran</h2>
                        
                        @forelse($exchangeHistory as $item)
                        <div class="flex justify-between items-start pt-5 border-t first:border-t-0">
                            <div>
                                <p class="font-bold text-brand-dark">{{ $item->title }}</p>
                                <p class="text-sm text-gray-500">oleh {{ $item->author }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $item->created_at->format('d F Y') }}</p>
                            </div>
                            <div class="text-right">
                                @switch($item->status)
                                    @case('Diterima')
                                        <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Selesai Diterima</span>
                                        @break
                                    @case('Menunggu Penilaian')
                                        <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">Menunggu Penilaian</span>
                                        @break
                                    @case('Ditolak')
                                        <span class="inline-block bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded-full">Ditolak</span>
                                        <p class="text-xs text-red-600 mt-1">{{ $item->rejection_reason }}</p>
                                        @break
                                @endswitch
                            </div>
                        </div>
                        @empty
                            <p class="text-center text-gray-500 py-8">Belum ada riwayat penukaran buku.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
