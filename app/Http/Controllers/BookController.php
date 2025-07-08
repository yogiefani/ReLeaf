<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class BookController extends Controller
{
    /**
     * Menampilkan halaman detail untuk satu buku.
     */
    public function show($slug)
    {
        $book = $this->findBookBySlug($slug);

        // Jika buku tidak ditemukan, tampilkan halaman 404
        if (!$book) {
            abort(404);
        }

        return view('books.show', ['book' => $book]);
    }

    /**
     * Data dummy untuk semua buku.
     * Nanti, ini akan diganti dengan query ke database: Book::all();
     */
    private function getBooksData()
    {
        return [
            [
                'slug' => 'sapiens-grafis-vol-2',
                'title' => 'Sapiens Grafis vol.2',
                'author' => 'Yuval Noah Harari',
                'price' => '116.000',
                'image' => 'images/books/sapiens-detail.png',
                'short_description' => 'Sapiens: A Graphic History, Volume 2 invites you on an enthralling journey through time – a vivid adventure beyond mere pages.',
                'synopsis' => 'Graphic Sapiens Volume 2 discusses the emergence of Homo sapiens on Earth and how Sapiens emerged from an ordinary species to the dominant life chain. This comic tells of the agricultural revolution, the great effort by Homo sapiens to support its growing population, has instead given rise to disputes, property rights, inequality, and human suffering due to war and disease. Also the story of the emergence of empires and great human civilizations that are increasingly larger and more complex. Historian Yuval Noah Harari presents the story of human civilization through interesting humorous images and history shape us and brighten our understanding of what it means to be human. This graphic adaptation is an interesting re-reading of the success of the Sapiens edition, in a comic format that is interesting, hilarious and enjoyable to listen to.',
                'details' => [
                    'Number of Page' => '256 pages',
                    'Publication Date' => 'January 8, 2022',
                    'Publisher' => 'Gramedia Pustaka Utama',
                    'Language' => 'Indonesian',
                    'ISBN' => '9786024817536',
                    'Weight' => '0.5 kg',
                    'Length' => '24.0 cm',
                ],
                'review' => [
                    'name' => 'Barack Obama',
                    'photo' => 'images/profile-obama.png',
                    'text' => '"Interesting and provocative makes us realize that we have only been on this Earth for a short time, that agriculture and science have only recently existed, and we should not take any of that lightly."'
                ]
            ],
            // Tambahkan data buku lainnya di sini jika perlu
        ];
    }

    /**
     * Mencari satu buku berdasarkan slug-nya.
     * Nanti, ini akan diganti dengan: Book::where('slug', $slug)->firstOrFail();
     */
    private function findBookBySlug($slug)
    {
        $books = $this->getBooksData();
        return Arr::first($books, fn ($book) => $book['slug'] === $slug);
    }
}