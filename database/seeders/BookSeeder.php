<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'Little Women',
            'author' => 'Louisa May Alcott',
            'slug' => 'little-women',
            'description' => 'A classic novel following the lives of the four March sisters—Meg, Jo, Beth, and Amy.',
            'price' => 75000,
            'stock' => 50,
            'cover_image' => 'images/picks/little-women.jpg', 
        ]);

        Book::create([
            'title' => 'They Both Die at the End',
            'author' => 'Adam Silvera',
            'slug' => 'they-both-die-at-the-end',
            'description' => 'On September 5, a little after midnight, Death-Cast calls Mateo Torrez and Rufus Emeterio to give them some bad news: They’re going to die today.',
            'price' => 95000,
            'stock' => 30,
            'cover_image' => 'images/picks/they-both-die.jpg',
        ]);

        Book::create([
            'title' => 'Laut Bercerita',
            'author' => 'Leila S. Chudori',
            'slug' => 'laut-bercerita',
            'description' => 'Sebuah novel yang memikat tentang persahabatan, cinta, dan kehilangan di tengah-tengah aktivisme mahasiswa pada masa Orde Baru.',
            'price' => 85000,
            'stock' => 45,
            'cover_image' => 'images/books/book-4.jpg',
        ]);
    }
}
