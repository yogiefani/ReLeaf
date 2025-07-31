<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookExchange;
use App\Models\CoinTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SuperAdminController extends Controller
{
    public function index()
    {
        $data = [
            'totalUsers' => User::whereHas('roles', function ($query) {
                $query->where('name', 'User');
            })->count(),
            'totalExchanges' => BookExchange::count(),
            'pendingExchanges' => BookExchange::where('status', 'Menunggu Penilaian')->count(),
            'approvedExchanges' => BookExchange::where('status', 'Diterima')->count(),
            'rejectedExchanges' => BookExchange::where('status', 'Ditolak')->count(),
            'totalCoinsDistributed' => CoinTransaction::where('type', 'credit')->sum('amount'),
        ];

        $recentExchanges = BookExchange::with(['user', 'photos'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('data', 'recentExchanges'));
    }

    public function bookExchanges(Request $request)
    {
        $query = BookExchange::with(['user', 'photos']);

        // Filter berdasarkan status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan search
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $exchanges = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.book-exchanges', compact('exchanges'));
    }

    public function showExchangeDetail($id)
    {
        $exchange = BookExchange::with(['user', 'photos', 'coinTransactions'])->findOrFail($id);
        return view('admin.exchange-detail', compact('exchange'));
    }

    public function approveExchange(Request $request, $id)
    {
        $request->validate([
            'awarded_coins' => 'required|integer|min:1|max:500'
        ]);

        $exchange = BookExchange::findOrFail($id);

        if ($exchange->status !== 'Menunggu Penilaian') {
            return redirect()->back()->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        DB::beginTransaction();
        try {
            // Update status exchange
            $exchange->update([
                'status' => 'Diterima',
                'awarded_coins' => $request->awarded_coins
            ]);

            // Tambahkan koin ke user
            $exchange->user->increment('coins', $request->awarded_coins);

            // Buat transaksi koin
            CoinTransaction::create([
                'user_id' => $exchange->user_id,
                'type' => 'credit',
                'amount' => $request->awarded_coins,
                'description' => "Tukar buku: {$exchange->title}",
                'transactionable_type' => BookExchange::class,
                'transactionable_id' => $exchange->id,
            ]);

            DB::commit();

            return redirect()->back()->with('success', "Pengajuan berhasil disetujui! {$request->awarded_coins} koin telah diberikan kepada {$exchange->user->name}.");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pengajuan.');
        }
    }

    public function rejectExchange(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $exchange = BookExchange::findOrFail($id);

        if ($exchange->status !== 'Menunggu Penilaian') {
            return redirect()->back()->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        $exchange->update([
            'status' => 'Ditolak',
            'rejection_reason' => $request->rejection_reason
        ]);

        return redirect()->back()->with('success', 'Pengajuan berhasil ditolak.');
    }

    public function users()
    {
        $users = User::with('roles')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'User');
            })
            ->withCount('bookExchanges')
            ->withSum('coinTransactions', 'amount')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.users', compact('users'));
    }

    public function showUser($id)
    {
        $user = User::with(['bookExchanges.photos', 'coinTransactions', 'orders.items.book'])
            ->findOrFail($id);

        return view('admin.user-detail', compact('user'));
    }

    public function coinTransactions()
    {
        $transactions = CoinTransaction::with(['user', 'transactionable'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.coin-transactions', compact('transactions'));
    }
}
