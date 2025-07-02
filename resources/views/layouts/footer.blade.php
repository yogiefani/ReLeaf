<footer class="bg-brand-beige font-oxygen text-sm text-gray-700">
    <div class="container mx-auto px-6 md:px-12 py-16 md:py-24">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
            <div class="md:col-span-2">
                <img src="{{ asset('images/logo.png') }}" alt="Airbook Logo" class="h-24">
            </div>

            <div>
                <h3 class="font-bold text-brand-dark mb-4">Alamat</h3>
                <p>Jl. Ring Road Utara, Ngringin,<br>Condongcatur, Kec. Depok,<br>Kabupaten Sleman, Daerah<br>Istimewa Yogyakarta 55281</p>
            </div>
            <div>
                <h3 class="font-bold text-brand-dark mb-4">Kategori</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:underline">Fiksi</a></li>
                    <li><a href="#" class="hover:underline">Sejarah</a></li>
                    <li><a href="#" class="hover:underline">Pengetahuan</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-brand-dark mb-4">Informasi</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:underline">Berbelanja</a></li>
                    <li><a href="#" class="hover:underline">Pembayaran</a></li>
                    <li><a href="#" class="hover:underline">Pengiriman</a></li>
                    <li><a href="#" class="hover:underline">Blog</a></li>
                    <li><a href="#" class="hover:underline">Kebijakan Privasi</a></li>
                    <li><a href="#" class="hover:underline">Hubungi Kami</a></li>
                </ul>
            </div>
        </div>
        <div class="mt-12 border-t border-gray-400 pt-6 flex flex-col md:flex-row justify-between items-center">
            <p>Copyright © {{ date('Y') }} AIRBook</p>
            <div class="flex space-x-4 mt-4 md:mt-0">
                <a href="#"><img src="https://simpleicons.org/icons/x.svg" class="h-5 w-5 filter invert"></a>
                <a href="#"><img src="https://simpleicons.org/icons/instagram.svg" class="h-5 w-5 filter invert"></a>
                <a href="#"><img src="https://simpleicons.org/icons/youtube.svg" class="h-5 w-5 filter invert"></a>
                <a href="#"><img src="https://simpleicons.org/icons/tiktok.svg" class="h-5 w-5 filter invert"></a>
            </div>
             <a href="#" class="mt-4 md:mt-0 hover:underline">Back to Top ↑</a>
        </div>
    </div>
</footer>