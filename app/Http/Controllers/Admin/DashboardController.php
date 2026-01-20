<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 📊 STATISTIK
        $totalBookings = Booking::count();

        $todayBookings = Booking::whereDate('booking_date', today())->count();

        $totalIncome = Payment::where('status', 'completed')->sum('amount');

        $todayIncome = Payment::where('status', 'completed')
            ->whereDate('paid_at', today())
            ->sum('amount');

        // 📋 DATA TERBARU
        $latestBookings = Booking::with(['user', 'service'])
            ->latest()
            ->take(5)
            ->get();

        $latestPayments = Payment::with(['booking.user'])
            ->where('status', 'completed')
            ->latest('paid_at')
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'totalBookings',
            'todayBookings',
            'totalIncome',
            'todayIncome',
            'latestBookings',
            'latestPayments'
        ));
    }
}
