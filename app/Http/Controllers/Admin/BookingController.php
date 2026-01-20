<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'service', 'payment'])->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        return view('admin.bookings.create', [
            'users' => User::all(),
            'services' => Service::all(),
        ]);
    }

    /**
     * 💾 CREATE BOOKING
     * STATUS SELALU unpaid (DIKUNCI)
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'manual_user_input' => 'nullable|string',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        // ✅ Buat / ambil user
        if (!$request->user_id && $request->manual_user_input) {
            $user = User::create([
                'name' => $request->manual_user_input,
                'email' => strtolower(str_replace(' ', '', $request->manual_user_input)) . '@dummy.com',
                'password' => bcrypt('password'),
            ]);
            $userId = $user->id;
        } else {
            $userId = $request->user_id;
        }

        $service = Service::findOrFail($request->service_id);

        Booking::create([
            'user_id' => $userId,
            'service_id' => $service->id,
            'booking_date' => $request->booking_date,
            'total_price' => $service->harga,
            'notes' => $request->notes,
            'status' => 'unpaid', // 🔒 KUNCI DI SINI
        ]);

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking berhasil dibuat (status: unpaid)');
    }

    public function edit(Booking $booking)
    {
        return view('admin.bookings.edit', [
            'booking' => $booking,
            'users' => User::all(),
            'services' => Service::all(),
        ]);
    }

    /**
     * ✏️ UPDATE BOOKING
     * TANPA SENTUH STATUS & PAYMENT
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $service = Service::findOrFail($request->service_id);

        $booking->update([
            'user_id' => $request->user_id,
            'service_id' => $service->id,
            'booking_date' => $request->booking_date,
            'total_price' => $service->harga,
            'notes' => $request->notes,
        ]);

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking berhasil diperbarui');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return back()->with('success', 'Booking dihapus');
    }

    public function markAsPaid($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status === 'paid') {
            return back()->with('error', 'Booking sudah dibayar');
        }

        $booking->update([
            'status' => 'paid',
            'payment_method' => 'cash',
            'payment_date' => now(),
        ]);

        return back()->with('success', 'Pembayaran cash berhasil');
    }

    public function getService($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['error' => 'Service tidak ditemukan'], 404);
        }

        return response()->json([
            'id' => $service->id,
            'category' => $service->nama,
            'model' => $service->deskripsi,
            'harga' => (int) $service->harga, // ⬅️ PENTING
            'image_url' => $service->image
                ? asset('uploads/services/' . $service->image)
                : null,
        ]);
    }

    public function show($id)
    {
        $booking = \App\Models\Booking::with(['user', 'service'])->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

}
