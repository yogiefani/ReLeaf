<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied - AirBook</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-50 flex items-center justify-center min-h-screen font-oxygen">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8 text-center">
        <div class="mb-6">
            <svg class="mx-auto h-16 w-16 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 15v2m0 0l-3-3m3 3l3-3m-3-8V3m0 4l-3-3m3 3l3-3m-3 4v8" />
            </svg>
        </div>

        <h1 class="text-2xl font-bold text-brand-dark mb-4 font-playfair">Access Denied</h1>
        <p class="text-gray-600 mb-6">
            Maaf, Anda tidak memiliki akses untuk halaman ini. Halaman ini hanya dapat diakses oleh Super Admin.
        </p>

        <div class="space-y-3">
            <a href="{{ route('home') }}"
                class="w-full bg-amber-300 text-brand-dark font-bold py-3 px-6 rounded-lg hover:bg-amber-400 transition-colors inline-block">
                Kembali ke Beranda
            </a>

            @auth
                <a href="{{ route('profile.dashboard') }}"
                    class="w-full bg-gray-100 text-gray-700 font-medium py-3 px-6 rounded-lg hover:bg-gray-200 transition-colors inline-block">
                    Ke Dashboard Saya
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="w-full bg-gray-100 text-gray-700 font-medium py-3 px-6 rounded-lg hover:bg-gray-200 transition-colors inline-block">
                    Login
                </a>
            @endauth
        </div>
    </div>
</body>

</html>
