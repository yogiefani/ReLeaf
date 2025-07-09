<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingBagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->with('book')->get();
        $subTotal = $cartItems->sum(fn($item) => $item->quantity * $item->book->price);

        return view('cart', compact('cartItems', 'subTotal'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function add(Request $request, Book $book)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $cartItem = CartItem::where('user_id', Auth::id())->where('book_id', $book->id)->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $request->quantity);
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'quantity' => $request->quantity,
            ]);
        }
        return redirect()->route('cart.index')->with('success', 'Buku berhasil ditambahkan ke keranjang.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CartItem $cartItem)
    {
        if (Auth::id() !== $cartItem->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate(['quantity' => 'required|integer|min:1']);
        $cartItem->update(['quantity' => $request->quantity]);
        
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function remove(CartItem $cartItem)
    {
        if (Auth::id() !== $cartItem->user_id) {
            abort(403, 'THIS ACTION IS UNAUTHORIZED.');
        }
        
        $cartItem->delete();
        return back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}
