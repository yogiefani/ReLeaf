<?php
// File: app/Models/CoinTransaction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoinTransaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent transactionable model (BookExchange, Order, etc.).
     */
    public function transactionable()
    {
        return $this->morphTo();
    }
}