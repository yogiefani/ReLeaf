<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FaqSection extends Component
{
    /**
     * The array of frequently asked questions.
     *
     * @var array
     */
    public $faqs = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Data FAQ sekarang dikelola di dalam kelas ini.
        $this->faqs = [
            [
                'question' => 'Berapa lama waktu pengiriman untuk buku fisik?',
                'answer' => 'Pengiriman dalam negeri biasanya memakan waktu 2–5 hari kerja, tergantung lokasi Anda. Kami juga menyediakan opsi pengiriman ekspres.',
                'open' => true // Item pertama terbuka secara default
            ],
            [
                'question' => 'Apakah saya bisa memesan buku yang tidak ada di katalog?',
                'answer' => 'Bisa. Anda dapat menghubungi tim kami dan kami akan berusaha mencarikan buku yang Anda butuhkan melalui layanan pemesanan khusus.',
                'open' => false
            ],
            [
                'question' => 'Apakah saya bisa mengembalikan buku yang sudah dibeli?',
                'answer' => 'Tentu, selama kondisi buku masih seperti semula dan pengembalian dilakukan dalam waktu 7 hari setelah diterima. Silakan hubungi layanan pelanggan kami untuk proses lebih lanjut.',
                'open' => false
            ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.faq-section');
    }
}