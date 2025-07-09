<x-app-layout>
    <div class="bg-gray-50 py-16 md:py-24">
        <div class="container mx-auto px-6 md:px-12 max-w-4xl">
            <div class="text-center">
                <h1 class="font-playfair text-5xl font-bold text-brand-dark">Hubungi Kami</h1>
                <p class="text-lg text-gray-600 mt-2">Kami ingin mendengar dari Anda. Kirimkan pesan kepada kami!</p>
            </div>

            <div class="mt-12 bg-white p-8 rounded-2xl shadow-sm">
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="font-semibold text-brand-dark">Nama Anda</label>
                            <input type="text" id="name" name="name" class="mt-2 w-full border-gray-300 rounded-lg focus:ring-brand-dark focus:border-brand-dark">
                        </div>
                        <div>
                            <label for="email" class="font-semibold text-brand-dark">Email Anda</label>
                            <input type="email" id="email" name="email" class="mt-2 w-full border-gray-300 rounded-lg focus:ring-brand-dark focus:border-brand-dark">
                        </div>
                    </div>
                    <div>
                        <label for="message" class="font-semibold text-brand-dark">Pesan</label>
                        <textarea id="message" name="message" rows="5" class="mt-2 w-full border-gray-300 rounded-lg focus:ring-brand-dark focus:border-brand-dark"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="bg-amber-300 text-brand-dark font-bold py-3 px-10 rounded-lg hover:bg-amber-400 transition-colors">
                            Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
