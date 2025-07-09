<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:100',
            'full_address' => 'required|string',
            'phone_number' => 'required|string|max:20',
        ]);

        $user = Auth::user();
        $address = $user->addresses()->create($request->all());

        // Jika ini adalah alamat pertama yang ditambahkan,
        // atau jika hanya ada satu alamat, jadikan sebagai alamat utama.
        if ($user->addresses()->count() == 1) {
            $this->setCurrent($address);
        }

        return back()->with('success', 'Alamat baru berhasil ditambahkan.');
    }

    /**
     * Set the specified address as the current one.
     */
    public function setCurrent(UserAddress $address)
    {
        // Memastikan pengguna hanya bisa mengubah alamat miliknya
        if (Auth::id() !== $address->user_id) {
            abort(403, 'THIS ACTION IS UNAUTHORIZED.');
        }

        // Reset semua alamat lain agar tidak menjadi 'current'
        Auth::user()->addresses()->update(['is_current' => false]);

        // Set alamat yang dipilih sebagai 'current'
        $address->update(['is_current' => true]);

        return back()->with('success', 'Alamat pengiriman berhasil diubah.');
    }
}
