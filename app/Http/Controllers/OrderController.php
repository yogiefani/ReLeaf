<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the user's orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Auth::user()
            ->orders()
            ->with('items.book') // Eager load order items and the related book
            ->latest() // Urutkan dari yang terbaru
            ->get();

        return view('orders.index', compact('orders'));
    }
}
