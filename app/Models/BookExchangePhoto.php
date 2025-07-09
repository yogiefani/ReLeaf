<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookExchangePhoto extends Model
{
    use HasFactory;
    protected $table = 'book_exchange_photos';
    protected $guarded = ['id'];

    public function bookExchange()
    {
        return $this->belongsTo(BookExchange::class);
    }
}