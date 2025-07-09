<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OnboardingController;

Route::middleware('hasOneSuperAdmin')->group(function () {
    Route::get('onboarding-page', [OnboardingController::class, 'index'])->name('onboarding');
    Route::post('onboarding-page/submit', [OnboardingController::class, 'onboarding_submit'])->name('onboarding.submit');
});

Route::middleware(['dontHaveSuperAdmin'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/checkout', function () {
        return view('checkout');
    })->name('checkout');

    Route::get('/cart', function () {
        return view('cart');
    })->name('cart');

    Route::get('/tukar-buku', function () {
        return view('tukar-buku');
    })->name('book-exchange');

    Route::get('/riwayat-transaksi', function () {
        return view('riwayat-transaksi');
    })->name('transaction-history');

    Route::get('/dashboard', function () {
        return view('welcome');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::get('/book/{slug}', [BookController::class, 'show'])->name('books.show');
});
require __DIR__.'/auth.php';
