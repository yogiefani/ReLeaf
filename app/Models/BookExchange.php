<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookExchange extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photos()
    {
        return $this->hasMany(BookExchangePhoto::class);
    }
    public function coinTransactions(): MorphMany
    {
        return $this->morphMany(CoinTransaction::class, 'transactionable');
    }
}