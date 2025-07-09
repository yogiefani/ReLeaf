<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WhatYouGet extends Component
{
    /**
     * The array of benefits.
     *
     * @var array
     */
    public $benefits = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Data kini berada di dalam kelas komponen, terisolasi dan rapi.
        $this->benefits = [
            [
                'icon' => 'images/icons/icon-book.png',
                'title' => 'Temukan Buku Favoritmu, Tanpa Ribet!',
                'description' => 'Nikmati pengalaman belanja buku fisik yang mudah, cepat, dan aman. Ribuan judul dari berbagai genre siap dikirim langsung ke tanganmu!',
                'align' => 'left'
            ],
            [
                'icon' => 'images/icons/icon-rocket.png',
                'title' => 'Koleksi Lengkap & Terupdate',
                'description' => 'Dari novel best-seller, buku self-development, hingga referensi akademik—semuanya ada di satu tempat.',
                'align' => 'right'
            ],
            [
                'icon' => 'images/icons/icon-support.png',
                'title' => 'Dukungan untuk Kebiasaan Membaca',
                'description' => 'Kami hadir untuk membantumu membangun rutinitas membaca dengan menyediakan buku berkualitas dan layanan yang memudahkan.',
                'align' => 'left'
            ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.what-you-get');
    }
}