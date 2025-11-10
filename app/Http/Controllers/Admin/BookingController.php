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
        $bookings = Booking::with(['user', 'service'])->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $users = User::all();
        $services = Service::all();
        return view('admin.bookings.create', compact('users', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date',
            'status' => 'required|in:pending,confirmed,paid,done,cancelled',
            'notes' => 'nullable|string',
        ]);

        Booking::create($request->only(['user_id', 'service_id', 'booking_date', 'status', 'notes']));

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil ditambahkan!');
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'service']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $users = User::all();
        $services = Service::all();
        return view('admin.bookings.edit', compact('booking', 'users', 'services'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date',
            'status' => 'required|in:pending,confirmed,paid,done,cancelled',
            'notes' => 'nullable|string',
        ]);

        $booking->update($request->only(['user_id', 'service_id', 'booking_date', 'status', 'notes']));

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil diperbarui!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil dihapus!');
    }

    public function getService($id)
{
    $service = \App\Models\Service::find($id);

    if (!$service) {
        return response()->json(['error' => 'Service tidak ditemukan'], 404);
    }

    // Hapus 'public/' dari path
    $imagePath = $service->image ? asset('uploads/services/' . $service->image) : null;

    return response()->json([
        'nama' => $service->nama,
        'harga' => $service->harga,
        'image_url' => $imagePath,
    ]);
}

}
