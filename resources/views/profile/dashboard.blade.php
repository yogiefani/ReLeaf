<x-app-layout>
    <div class="bg-gray-50 font-oxygen min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12 max-w-7xl">

            <div class="mb-8">
                <h1 class="font-playfair text-3xl sm:text-4xl font-bold text-brand-dark">Profil Saya</h1>
                <p class="text-gray-600 mt-1">Selamat datang kembali, {{ Auth::user()->name }}! Kelola akun dan aktivitas Anda di sini.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- My Orders Card -->
                <a href="{{ route('orders.index') }}" class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-lg transition-shadow flex items-start gap-4">
                    <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg text-brand-dark">Pesanan Saya</h2>
                        <p class="text-sm text-gray-500 mt-1">Lacak riwayat pembelian dan status pesanan Anda.</p>
                    </div>
                </a>

                <!-- Book Exchange Card -->
                <a href="{{ route('book-exchange.index') }}" class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-lg transition-shadow flex items-start gap-4">
                    <div class="bg-green-100 text-green-600 p-3 rounded-full">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" /></svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg text-brand-dark">Tukar Buku</h2>
                        <p class="text-sm text-gray-500 mt-1">Kelola pengajuan tukar buku Anda.</p>
                    </div>
                </a>

                <!-- Transaction History Card -->
                <a href="{{ route('transaction-history') }}" class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-lg transition-shadow flex items-start gap-4">
                    <div class="bg-amber-100 text-amber-600 p-3 rounded-full">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg text-brand-dark">Riwayat Transaksi</h2>
                        <p class="text-sm text-gray-500 mt-1">Lihat riwayat transaksi koin Anda.</p>
                    </div>
                </a>

                <!-- Account Settings Card -->
                <a href="{{ route('profile.edit') }}" class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-lg transition-shadow flex items-start gap-4">
                    <div class="bg-gray-100 text-gray-600 p-3 rounded-full">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.096 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg text-brand-dark">Pengaturan Akun</h2>
                        <p class="text-sm text-gray-500 mt-1">Perbarui profil dan kata sandi Anda.</p>
                    </div>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
