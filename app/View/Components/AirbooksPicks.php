<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AirbooksPicks extends Component
{
    /**
     * The array of weekly book picks.
     *
     * @var array
     */
    public $bookPicks = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->bookPicks = [
            [
                'image' => 'images/picks/little-women.jpg',
                'title' => 'Little Women',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'week' => 1
            ],
            [
                'image' => 'images/picks/they-both-die.jpg',
                'title' => 'They Both Die at the End',
                'description' => 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essenti. Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'week' => 2
            ],
            [
                'image' => 'images/picks/art-of-war.jpg',
                'title' => 'The Art of War',
                'description' => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.',
                'week' => 3
            ],
            [
                'image' => 'images/picks/keep-up.jpg',
                'title' => 'Keep up with Us',
                'description' => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.',
                'week' => 4
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.airbooks-picks');
    }
}