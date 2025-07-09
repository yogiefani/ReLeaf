<?php

namespace App\Http\Controllers;

use App\Models\BookExchange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookExchangeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $exchangeHistory = BookExchange::where('user_id', $user->id)
            ->with('photos') 
            ->latest()
            ->get();

        return view('tukar-buku', compact('exchangeHistory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string',
            'language' => 'required|string',
            'condition_description' => 'required|string',
            'photos' => 'required|array|min:1|max:3',
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $bookExchange = BookExchange::create([
            'user_id' => Auth::id(),
            'code' => 'RE' . strtoupper(Str::random(6)),
            'title' => $request->title,
            'author' => $request->author,
            'genre' => $request->genre,
            'language' => $request->language,
            'condition_description' => $request->condition_description,
            'status' => 'Menunggu Penilaian',
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('exchange_photos', 'public');
                $bookExchange->photos()->create(['photo_path' => $path]);
            }
        }

        return redirect()->route('book-exchange.index')->with('success', 'Pengajuan Berhasil Dikirim!');
    }
}