<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Book; 
use Illuminate\Support\Collection; 

class BookCategories extends Component
{
    /**
     * The collection of featured books.
     *
     * @var \Illuminate\Support\Collection
     */
    public Collection $featuredBooks;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Ambil 5 buku terbaru dari database sebagai featured books
        $this->featuredBooks = Book::latest()->take(5)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.book-categories');
    }
}
