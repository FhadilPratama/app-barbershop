<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Services\MidtransConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    /**
     * 📋 LIST BOOKING
     */
    public function index()
    {
        $bookings = Booking::with(['user', 'service', 'payment'])
            ->orderBy('booking_date', 'desc')
            ->get();

        return view('admin.pembayaran.index', compact('bookings'));
    }

    /**
     * 💵 BAYAR CASH
     */
    public function payCash(Booking $booking)
    {
        if ($booking->status === 'paid') {
            return back()->with('error', 'Booking sudah lunas');
        }

        DB::transaction(function () use ($booking) {

            // 1️⃣ BUAT PAYMENT
            Payment::create([
                'booking_id' => $booking->id,
                'method' => 'cash',
                'amount' => $booking->total_price,
                'status' => 'completed', // ✅ ganti dari 'paid'
                'paid_at' => now(),
            ]);

            // 2️⃣ UPDATE BOOKING
            $booking->update([
                'status' => 'paid',
                'payment_method' => 'cash',
                'payment_date' => now(),
            ]);
        });

        return back()->with('success', 'Pembayaran cash berhasil');
    }


    /**
     * 🌐 BAYAR ONLINE
     */
    public function payOnline($bookingId)
    {
        $booking = Booking::with('user')->findOrFail($bookingId);

        if ($booking->status === 'paid') {
            return back()->with('error', 'Booking sudah dibayar.');
        }

        MidtransConfig::load();

        $orderId = 'ORDER-' . $booking->id . '-' . time();

        // ✅ SIMPAN PAYMENT PENDING
        Payment::create([
            'booking_id' => $booking->id,
            'method' => 'online',
            'amount' => $booking->total_price,
            'status' => 'pending',
            'reference' => $orderId,
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => $booking->user->name,
                'email' => $booking->user->email,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('admin.pembayaran.pay-online', compact(
            'booking',
            'snapToken',
            'orderId'
        ));
    }

    /**
     * 🔔 CALLBACK MIDTRANS
     */
    public function callback(Request $request)
    {
        MidtransConfig::load();

        $orderId = $request->order_id;
        $status = $request->transaction_status;
        $amount = (int) $request->gross_amount;

        $bookingId = explode('-', $orderId)[1] ?? null;
        $booking = Booking::find($bookingId);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        DB::transaction(function () use ($booking, $orderId, $status, $amount) {

            // 🔎 ambil / buat payment
            $payment = Payment::firstOrCreate(
                ['reference' => $orderId],
                [
                    'booking_id' => $booking->id,
                    'method' => 'online',
                    'amount' => $amount,
                    'status' => 'pending',
                ]
            );

            // 🔒 anti double process
            if ($payment->status === 'completed') {
                return;
            }

            // ✅ BERHASIL
            if (in_array($status, ['capture', 'settlement'])) {

                $payment->update([
                    'status' => 'completed',
                    'paid_at' => now(),
                ]);

                $booking->update([
                    'status' => 'paid',
                    'payment_method' => 'online',
                    'payment_date' => now(),
                ]);
            }

            // ❌ GAGAL
            if (in_array($status, ['deny', 'expire', 'cancel'])) {
                $payment->update([
                    'status' => 'failed',
                ]);
            }
        });

        return response()->json(['message' => 'OK']);
    }

    /**
     * 📜 HISTORY
     */
    public function history()
    {
        $payments = Payment::with(['booking.user', 'booking.service'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pembayaran.history', compact('payments'));
    }

    /**
     * 🔍 DETAIL PEMBAYARAN + BOOKING
     */
    public function show($id)
    {
        $payment = Payment::with(['booking.user', 'booking.service'])
            ->findOrFail($id);

        return view('admin.pembayaran.show', compact('payment'));
    }
}
