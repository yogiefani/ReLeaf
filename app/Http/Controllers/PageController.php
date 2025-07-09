<?php

namespace App\Http\Controllers;

use App\Models\Book; // Import model Book
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Menampilkan halaman Collection.
     */
    public function collection()
    {
        // Mengambil semua buku dari database dengan paginasi (15 buku per halaman)
        $books = Book::latest()->paginate(15);
        return view('pages.collection', compact('books'));
    }

    /**
     * Menampilkan halaman Contact Us.
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Menampilkan halaman About Us.
     */
    public function about()
    {
        return view('pages.about');
    }
}
