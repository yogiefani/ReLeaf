<section class="bg-brand-beige py-16 md:py-24">
    <div class="container mx-auto px-6 md:px-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div class="flex justify-center">
                <img src="{{ asset('images/bookstore-illustration.png') }}" alt="Ilustrasi Komunitas ReLeaf"
                    class="max-w-sm w-full">
            </div>
            <div class="text-center md:text-left">
                <h2 class="font-playfair text-5xl font-bold text-brand-dark mb-4">
                    Tentang ReLeaf
                </h2>
                <div class="space-y-6">
                    <p class="font-oxygen text-lg leading-relaxed text-gray-700">
                        <span class="font-bold text-amber-600">ReLeaf</span> adalah platform komunitas pertukaran buku
                        yang menghidupkan kembali semangat berbagi literasi. Kami percaya bahwa setiap buku memiliki
                        jiwa yang dapat terus hidup di tangan pembaca baru.
                    </p>

                    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-amber-400">
                        <h3 class="font-bold text-brand-dark text-xl mb-3">🌱 Konsep ReLeaf</h3>
                        <p class="text-gray-700">
                            <strong>Re-Leaf</strong> = "Daun Baru" - Memberikan kehidupan baru pada buku-buku yang telah
                            dibaca,
                            seperti daun yang gugur dan tumbuh kembali. Setiap buku yang Anda tukar akan mendapatkan
                            "daun baru"
                            di tangan pembaca lain.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-lg">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white font-bold">📚</span>
                                </div>
                                <h4 class="font-bold text-green-800">Tukar Buku</h4>
                            </div>
                            <p class="text-green-700 text-sm">Tukarkan buku lama dengan yang baru, dapatkan koin untuk
                                setiap kontribusi</p>
                        </div>

                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-lg">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white font-bold">🏘️</span>
                                </div>
                                <h4 class="font-bold text-blue-800">Komunitas</h4>
                            </div>
                            <p class="text-blue-700 text-sm">Bergabung dengan komunitas pembaca, admin lokal siap
                                membantu pengantaran</p>
                        </div>

                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-lg">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white font-bold">♻️</span>
                                </div>
                                <h4 class="font-bold text-purple-800">Sustainability</h4>
                            </div>
                            <p class="text-purple-700 text-sm">Mengurangi limbah kertas dengan memberikan kehidupan
                                kedua pada buku</p>
                        </div>

                        <div class="bg-gradient-to-br from-amber-50 to-amber-100 p-4 rounded-lg">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white font-bold">🪙</span>
                                </div>
                                <h4 class="font-bold text-amber-800">Sistem Koin</h4>
                            </div>
                            <p class="text-amber-700 text-sm">Dapatkan koin dari buku yang Anda tukar, gunakan untuk
                                membeli buku lain</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('book-exchange.index') }}"
                        class="inline-block bg-amber-300 hover:bg-amber-400 text-brand-dark font-bold px-8 py-3 rounded-lg shadow-md transition-colors duration-300 text-center">
                        Mulai Tukar Buku
                    </a>
                    <a href="{{ route('collection') }}"
                        class="inline-block bg-white hover:bg-gray-50 text-brand-dark font-bold px-8 py-3 rounded-lg shadow-md border-2 border-amber-300 transition-colors duration-300 text-center">
                        Jelajahi Koleksi
                    </a>
                </div>
            </div>
        </div>

        <!-- Mission & Vision Section -->
        <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="font-bold text-brand-dark text-xl mb-3">Misi Kami</h3>
                <p class="text-gray-700">Menciptakan ekosistem literasi berkelanjutan melalui pertukaran buku komunitas
                    yang ramah lingkungan dan mudah diakses.</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                </div>
                <h3 class="font-bold text-brand-dark text-xl mb-3">Visi Kami</h3>
                <p class="text-gray-700">Menjadi platform terdepan dalam membangun komunitas pembaca yang peduli
                    lingkungan dan saling berbagi pengetahuan.</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-purple-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                    </svg>
                </div>
                <h3 class="font-bold text-brand-dark text-xl mb-3">Nilai Kami</h3>
                <p class="text-gray-700">Keberlanjutan, komunitas, dan kecintaan pada literasi adalah fondasi yang
                    mendorong setiap langkah ReLeaf.</p>
            </div>
        </div>
    </div>
</section>
