<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\ShoppingBagController;
use App\Http\Controllers\BookExchangeController;
use App\Http\Controllers\CoinTransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan rute web untuk aplikasi Anda. Rute-rute
| ini dimuat oleh RouteServiceProvider dalam sebuah grup yang
| berisi grup middleware "web". Buat sesuatu yang hebat!
|
*/

// Route untuk onboarding Super Admin (jika belum ada)
Route::middleware('hasOneSuperAdmin')->group(function () {
    Route::get('onboarding-page', [OnboardingController::class, 'index'])->name('onboarding');
    Route::post('onboarding-page/submit', [OnboardingController::class, 'onboarding_submit'])->name('onboarding.submit');
});

// Grup route utama untuk aplikasi
Route::middleware(['dontHaveSuperAdmin'])->group(function () {

    // Halaman utama / Beranda
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    // Route untuk halaman statis
    Route::get('/collection', [PageController::class, 'collection'])->name('collection');
    Route::get('/contact-us', [PageController::class, 'contact'])->name('contact');
    Route::get('/about-us', [PageController::class, 'about'])->name('about');

    // Route yang memerlukan autentikasi pengguna
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

        // Profil Pengguna
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::get('/profile/dashboard', [ProfileController::class, 'dashboard'])->name('profile.dashboard');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Fitur Tukar Buku
        Route::prefix('tukar-buku')->name('book-exchange.')->group(function () {
            Route::get('/', [BookExchangeController::class, 'index'])->name('index');
            Route::post('/store', [BookExchangeController::class, 'store'])->name('store');
        });

        // Riwayat Transaksi Koin
        Route::get('/riwayat-transaksi', [CoinTransactionController::class, 'index'])->name('transaction-history');

        // Keranjang Belanja (Shopping Bag)
        Route::prefix('cart')->name('cart.')->group(function () {
            Route::get('/', [ShoppingBagController::class, 'index'])->name('index');
            Route::post('/add/{book}', [ShoppingBagController::class, 'add'])->name('add');
            Route::patch('/update/{cartItem}', [ShoppingBagController::class, 'update'])->name('update');
            Route::delete('/remove/{cartItem}', [ShoppingBagController::class, 'remove'])->name('remove');
        });

        // Checkout
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

        // Manajemen Alamat Pengguna
        Route::prefix('address')->name('address.')->group(function () {
            Route::post('/store', [AddressController::class, 'store'])->name('store');
            Route::post('/set-current/{address}', [AddressController::class, 'setCurrent'])->name('set-current');
        });
    });

    // Detail Buku (bisa diakses publik)
    Route::get('/book/{slug}', [BookController::class, 'show'])->name('books.show');

    Route::get('/my-orders', [OrderController::class, 'index'])->name('orders.index');
});

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

require __DIR__.'/auth.php';
