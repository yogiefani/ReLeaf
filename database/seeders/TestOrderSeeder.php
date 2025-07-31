<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserAddress;
use App\Models\BookExchange;
use App\Models\Book;
use App\Models\CoinTransaction;

class TestOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cari user yang bukan admin
        $user = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['admin', 'super_admin']);
        })->first();

        if (!$user) {
            $this->command->error('No regular user found. Please create a regular user first.');
            return;
        }

        // Buat address jika user belum punya
        $address = $user->addresses()->first();
        if (!$address) {
            $address = UserAddress::create([
                'user_id' => $user->id,
                'full_address' => 'Jl. Contoh No. 123, Jakarta Selatan',
                'phone' => '081234567890',
                'label' => 'Rumah'
            ]);
        }

        // Buat book untuk order item (sesuai struktur tabel)
        $book = Book::firstOrCreate([
            'title' => 'Laravel Test Book',
            'author' => 'Test Author'
        ], [
            'slug' => 'laravel-test-book',
            'description' => 'Test book for order testing',
            'price' => 5000,
            'stock' => 1
        ]);

        // Buat book exchange untuk testing (langsung tanpa referensi ke books table)
        $bookExchange = BookExchange::firstOrCreate([
            'user_id' => $user->id,
            'title' => 'Laravel Test Book',
            'author' => 'Test Author'
        ], [
            'code' => 'TST' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
            'genre' => 'Technology',
            'language' => 'Indonesia',
            'condition_description' => 'Kondisi baik, tidak ada coretan',
            'status' => 'Diterima',
            'awarded_coins' => 5000
        ]);

        // Pastikan user punya cukup coins
        $user->update(['coins' => 10000]);

        // Buat order
        $order = Order::create([
            'order_number' => 'ORD' . date('YmdHis') . rand(100, 999),
            'user_id' => $user->id,
            'user_address_id' => $address->id,
            'subtotal' => 5000,
            'shipping_cost' => 0,
            'total_amount' => 5000,
            'payment_method' => 'coins',
            'status' => 'pending',
            'delivery_status' => 'pending'
        ]);

        // Buat order item (menggunakan book_id sesuai struktur tabel)
        OrderItem::create([
            'order_id' => $order->id,
            'book_id' => $book->id,
            'quantity' => 1,
            'price' => 5000
        ]);

        // Buat coin transaction
        CoinTransaction::create([
            'user_id' => $user->id,
            'amount' => 5000,
            'type' => 'debit',
            'description' => 'Purchase book from order #' . $order->id,
            'transactionable_id' => $order->id,
            'transactionable_type' => Order::class
        ]);

        $this->command->info('Test order created successfully!');
        $this->command->info('Order ID: ' . $order->id);
        $this->command->info('User: ' . $user->name . ' (' . $user->email . ')');
    }
}
