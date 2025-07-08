<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BookCategories extends Component
{
    /**
     * The array of book categories.
     *
     * @var array
     */
    public $featuredBooks = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->featuredBooks = [
            [
                'image' => 'images/books/book-1.jpg',
                'title' => 'The Midnight Library',
                'author' => 'Matt Haig',
                'price' => 'Rp 99.000'
            ],
            [
                'image' => 'images/books/book-2.jpg',
                'title' => 'Klara and the Sun',
                'author' => 'Kazuo Ishiguro',
                'price' => 'Rp 125.000'
            ],
            [
                'image' => 'images/books/book-3.jpg',
                'title' => 'Project Hail Mary',
                'author' => 'Andy Weir',
                'price' => 'Rp 150.000'
            ],
            [
                'image' => 'images/books/book-4.jpg',
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'price' => 'Rp 85.000'
            ],
            [
                'image' => 'images/books/book-1.jpg',
                'title' => 'The Psychology of Money',
                'author' => 'Morgan Housel',
                'price' => 'Rp 95.000'
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.book-categories');
    }
}
