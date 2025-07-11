<x-app-layout>
    <div class="bg-gray-50 font-oxygen">
        <div class="container mx-auto px-6 md:px-12 py-12 md:py-16">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-12 items-start">
                
                {{-- KOLOM KIRI --}}
                <div class="lg:col-span-2 bg-white p-6 md:p-8 rounded-2xl shadow-sm space-y-6">
                    <h1 class="font-playfair text-4xl font-bold text-brand-dark">Riwayat Transaksi</h1>

                    {{-- Saldo Saat Ini --}}
                    <div class="bg-amber-100/50 border border-amber-300/50 p-6 rounded-2xl flex items-center gap-4">
                        <img src="{{ asset('images/icons/coin.png') }}" alt="Ikon Koin" class="w-10 h-10">
                        <div>
                            <p class="text-sm text-gray-600">Saldo Saat Ini</p>
                            <p class="text-3xl font-bold text-brand-dark">{{ $user->coins }} Koin</p>
                        </div>
                    </div>

                    {{-- Daftar Transaksi --}}
                    <div>
                        <h2 class="font-bold text-lg text-brand-dark mb-4">Riwayat Transaksi</h2>
                        <div class="space-y-3">
                            @forelse ($transactions as $trx)
                                <div class="flex items-center justify-between p-4 rounded-xl border border-gray-100">
                                    <div class="flex items-center gap-4">
                                        {{-- Ikon Plus/Minus berdasarkan tipe transaksi --}}
                                        @if($trx->type === 'credit')
                                            <div class="w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-2xl font-light">+</div>
                                        @else
                                            <div class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center text-2xl font-light">-</div>
                                        @endif
                                        <div>
                                            <p class="font-semibold text-brand-dark">{{ $trx->description }}</p>
                                            <p class="text-sm text-gray-500">{{ $trx->created_at->format('d F Y') }}</p>
                                        </div>
                                    </div>
                                    {{-- Jumlah Koin --}}
                                    @if($trx->type === 'credit')
                                        <span class="font-semibold text-green-600 bg-green-100 px-3 py-1 rounded-md">+ {{ $trx->amount }} Koin</span>
                                    @else
                                        <span class="font-semibold text-red-600 bg-red-100 px-3 py-1 rounded-md">- {{ $trx->amount }} Koin</span>
                                    @endif
                                </div>
                            @empty
                                <p class="text-center text-gray-500 py-4">Belum ada riwayat transaksi.</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- Total Koin --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4">
                        <div class="bg-white border-2 border-green-400 p-4 rounded-xl text-center">
                            <p class="text-sm text-gray-600">Total Koin Diperoleh</p>
                            <p class="text-2xl font-bold text-green-600 mt-1">+ {{ $totalCredit }} Koin</p>
                        </div>
                         <div class="bg-white border-2 border-red-400 p-4 rounded-xl text-center">
                            <p class="text-sm text-gray-600">Total Koin Digunakan</p>
                            <p class="text-2xl font-bold text-red-600 mt-1">- {{ $totalDebit }} Koin</p>
                        </div>
                    </div>

                </div>

                {{-- KOLOM KANAN --}}
                <div class="lg:col-span-1">
                     <div class="bg-white p-6 rounded-2xl shadow-sm">
                        <p class="text-lg">Hi, {{ $user->name }}!</p>
                        <p class="text-sm text-gray-500">Koin Saya</p>
                        <p class="font-playfair text-5xl font-bold text-amber-500 text-center my-6">{{ $user->coins }} Koin</p>
                        <a href="{{ route('orders.index') }}" class="text-sm text-gray-500 hover:text-black text-center block underline">Lihat Riwayat Transaksi</a>
                     </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
