<?php

namespace App\Http\Controllers;

use App\Models\CoinTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoinTransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transactions = CoinTransaction::where('user_id', $user->id)
            ->latest()
            ->get();

        $totalCredit = $transactions->where('type', 'credit')->sum('amount');
        $totalDebit = $transactions->where('type', 'debit')->sum('amount');

        return view('riwayat-transaksi', compact('user', 'transactions', 'totalCredit', 'totalDebit'));
    }
}