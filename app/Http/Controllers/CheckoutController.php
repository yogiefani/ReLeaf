<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\UserAddress;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->with('book')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('home')->with('info', 'Keranjang Anda kosong.');
        }
        
        $addresses = UserAddress::where('user_id', $user->id)->get();
        $currentAddress = $addresses->firstWhere('is_current', true) ?? $addresses->first();

        $subTotal = $cartItems->sum(fn($item) => $item->quantity * $item->book->price);
        $shippingCost = 10000; // Contoh biaya pengiriman
        $total = $subTotal + $shippingCost;

        return view('checkout', compact('cartItems', 'addresses', 'currentAddress', 'subTotal', 'shippingCost', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'user_address_id' => 'required|exists:user_addresses,id',
            'payment_method' => 'required|in:bank_transfer,coins',
        ]);

        $user = Auth::user();
        $cartItems = $user->cartItems()->with('book')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $subTotal = $cartItems->sum(fn($item) => $item->quantity * $item->book->price);
        $shippingCost = 10000;
        $totalAmount = $subTotal + $shippingCost;

        // Logika Pembayaran dengan Koin
        if ($request->payment_method === 'coins') {
            $requiredCoins = $totalAmount; // Asumsi 1 Koin = 1 Rupiah
            if ($user->coins < $requiredCoins) {
                return back()->with('error', 'Koin Anda tidak mencukupi untuk pembayaran ini.');
            }
        }

        // Memulai transaksi database untuk memastikan semua proses berhasil
        DB::beginTransaction();
        try {
            // 1. Buat record Order
            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'user_id' => $user->id,
                'user_address_id' => $request->user_address_id,
                'subtotal' => $subTotal,
                'shipping_cost' => $shippingCost,
                'total_amount' => $totalAmount,
                'payment_method' => $request->payment_method,
                'status' => 'pending', // Status awal, akan diubah oleh admin
            ]);

            // 2. Pindahkan item dari keranjang ke Order Items
            foreach ($cartItems as $item) {
                $order->items()->create([
                    'book_id' => $item->book_id,
                    'quantity' => $item->quantity,
                    'price' => $item->book->price,
                ]);
                // 3. Kurangi stok buku
                $item->book->decrement('stock', $item->quantity);
            }

            // 4. Jika bayar dengan koin, kurangi koin pengguna
            if ($request->payment_method === 'coins') {
                $user->decrement('coins', $requiredCoins);
            }

            // 5. Kosongkan keranjang
            $user->cartItems()->delete();

            DB::commit(); // Semua berhasil, simpan perubahan

            return redirect()->route('home')->with('success', 'Pesanan Anda berhasil dibuat! Nomor Pesanan: ' . $order->order_number);

        } catch (\Exception $e) {
            DB::rollBack(); // Ada kesalahan, batalkan semua
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan Anda. Silakan coba lagi.');
        }
    }
}
