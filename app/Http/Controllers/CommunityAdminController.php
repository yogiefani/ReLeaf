<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommunityAdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Hanya admin dan super admin yang bisa akses
        if (!$user->hasRole('admin') && !$user->hasRole('Super Admin')) {
            abort(403, 'Tidak memiliki akses');
        }

        // Statistik untuk admin
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('delivery_status', 'pending')->count(),
            'my_assigned_orders' => Order::where('assigned_to', $user->id)->count(),
            'completed_orders' => Order::where('delivery_status', 'completed')->count(),
        ];

        // Orders yang belum ada yang handle (untuk admin bisa ambil)
        $availableOrders = Order::whereNull('assigned_to')
            ->whereIn('delivery_status', ['pending', 'preparing'])
            ->with(['user', 'address', 'items.book'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Orders yang dihandle oleh admin ini
        $myOrders = Order::where('assigned_to', $user->id)
            ->with(['user', 'address', 'items.book'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('community-admin.dashboard', compact('stats', 'availableOrders', 'myOrders'));
    }

    public function takeOrder($orderId)
    {
        $user = Auth::user();

        if (!$user->hasRole('admin') && !$user->hasRole('super_admin')) {
            return back()->with('error', 'Tidak memiliki akses');
        }

        $order = Order::findOrFail($orderId);

        if ($order->assigned_to) {
            return back()->with('error', 'Order sudah diambil admin lain');
        }

        DB::transaction(function () use ($order, $user) {
            $order->update([
                'assigned_to' => $user->id,
                'delivery_status' => 'preparing',
                'status' => 'processing' // Update status utama juga
            ]);
        });

        return back()->with('success', 'Order berhasil diambil! Silakan siapkan buku untuk pengantaran.');
    }

    public function updateStatus(Request $request, $orderId)
    {
        $user = Auth::user();

        if (!$user->hasRole('admin') && !$user->hasRole('super_admin')) {
            return back()->with('error', 'Tidak memiliki akses');
        }

        $request->validate([
            'delivery_status' => 'required|in:preparing,picked_up,in_transit,delivered,completed',
            'delivery_notes' => 'nullable|string|max:500'
        ]);

        $order = Order::findOrFail($orderId);

        if ($order->assigned_to !== $user->id && !$user->hasRole('super_admin')) {
            return back()->with('error', 'Anda tidak bisa update order ini');
        }

        $updateData = [
            'delivery_status' => $request->delivery_status,
            'delivery_notes' => $request->delivery_notes
        ];

        // Set timestamp berdasarkan status
        if ($request->delivery_status === 'picked_up' && !$order->picked_up_at) {
            $updateData['picked_up_at'] = now();
        }

        if ($request->delivery_status === 'delivered' && !$order->delivered_at) {
            $updateData['delivered_at'] = now();
        }

        // Auto-sync main status berdasarkan delivery status
        $mainStatusMapping = [
            'pending' => 'pending',
            'preparing' => 'processing',
            'picked_up' => 'processing',
            'in_transit' => 'shipped',
            'delivered' => 'shipped',
            'completed' => 'completed'
        ];

        if (isset($mainStatusMapping[$request->delivery_status])) {
            $updateData['status'] = $mainStatusMapping[$request->delivery_status];
        }

        $order->update($updateData);

        $statusMessage = [
            'preparing' => 'Order sedang disiapkan',
            'picked_up' => 'Buku telah diambil dari penjual',
            'in_transit' => 'Buku dalam perjalanan ke pembeli',
            'delivered' => 'Buku telah sampai ke pembeli',
            'completed' => 'Transaksi selesai'
        ];

        return back()->with('success', 'Status berhasil diupdate: ' . $statusMessage[$request->delivery_status]);
    }

    public function orderDetail($orderId)
    {
        $user = Auth::user();

        if (!$user->hasRole('admin') && !$user->hasRole('super_admin')) {
            abort(403, 'Tidak memiliki akses');
        }

        $order = Order::with([
            'user',
            'address',
            'items.book',
            'assignedTo',
            'coinTransactions'
        ])->findOrFail($orderId);

        // Hanya admin yang handle order ini atau super admin yang bisa lihat detail
        if ($order->assigned_to !== $user->id && !$user->hasRole('super_admin')) {
            abort(403, 'Tidak memiliki akses ke order ini');
        }

        return view('community-admin.order-detail', compact('order'));
    }
}
