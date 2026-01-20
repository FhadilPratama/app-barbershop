<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['booking.user', 'booking.service'])
            ->where('status', 'completed');

        // 🔎 Filter tanggal
        if ($request->filled('from')) {
            $query->whereDate('paid_at', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('paid_at', '<=', $request->to);
        }

        // 🔎 Filter metode
        if ($request->filled('method')) {
            $query->where('method', $request->method);
        }

        $payments = $query->orderBy('paid_at', 'desc')->get();

        // 📊 Summary
        $totalIncome = $payments->sum('amount');
        $totalCash   = $payments->where('method', 'cash')->sum('amount');
        $totalOnline = $payments->where('method', 'online')->sum('amount');

        return view('admin.laporan.index', compact(
            'payments',
            'totalIncome',
            'totalCash',
            'totalOnline'
        ));
    }
}
