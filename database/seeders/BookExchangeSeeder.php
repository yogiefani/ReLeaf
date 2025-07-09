<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\BookExchange;
use Illuminate\Support\Str;

class BookExchangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'emma@example.com')->first();

        if ($user) {
            // Contoh 1: Diterima
            $exchange1 = $user->bookExchanges()->create([
                'code' => 'A01297',
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'genre' => 'Fiksi',
                'language' => 'Indonesia',
                'condition_description' => 'Kondisi masih sangat baik, seperti baru.',
                'status' => 'Diterima',
                'awarded_coins' => 50,
            ]);
            $exchange1->photos()->create(['photo_path' => 'exchange_photos/placeholder.jpg']);
            $exchange1->coinTransactions()->create([
                'user_id' => $user->id,
                'type' => 'credit',
                'amount' => 50,
                'description' => 'Penukaran Buku : A01297'
            ]);


            // Contoh 2: Menunggu Penilaian
            $exchange2 = $user->bookExchanges()->create([
                'code' => 'B02345',
                'title' => 'Bumi Manusia',
                'author' => 'Pramoedya Ananta Toer',
                'genre' => 'Sejarah',
                'language' => 'Indonesia',
                'condition_description' => 'Ada sedikit lipatan di cover depan.',
                'status' => 'Menunggu Penilaian',
            ]);
            $exchange2->photos()->create(['photo_path' => 'exchange_photos/placeholder.jpg']);

            // Contoh 3: Ditolak
            $exchange3 = $user->bookExchanges()->create([
                'code' => 'C08765',
                'title' => 'The Little Prince',
                'author' => 'Antoine de Saint-Exupéry',
                'genre' => 'Fiksi',
                'language' => 'Inggris',
                'condition_description' => 'Ada coretan di beberapa halaman.',
                'status' => 'Ditolak',
                'rejection_reason' => 'Alasan: Kondisi buku tidak sesuai.',
            ]);
            $exchange3->photos()->create(['photo_path' => 'exchange_photos/placeholder.jpg']);
        }
    }
}
