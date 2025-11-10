@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detail Booking</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">Customer: {{ $booking->user->name ?? '-' }}</h5>
            <p><strong>Service:</strong> {{ $booking->service->nama ?? '-' }}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($booking->service->harga ?? 0, 0, ',', '.') }}</p>

            @if($booking->service && $booking->service->image)
                <div class="mb-3">
                    <img src="{{ asset('uploads/services/' . $booking->service->image) }}" 
                         alt="Service Image" 
                         class="img-fluid rounded shadow-sm border" 
                         style="max-width: 250px;">
                </div>
            @else
                <p class="text-muted">Tidak ada gambar tersedia.</p>
            @endif

            <p><strong>Tanggal Booking:</strong> {{ $booking->booking_date }}</p>
            <p><strong>Status:</strong> 
                <span class="badge bg-{{ $booking->status == 'done' ? 'success' : ($booking->status == 'cancelled' ? 'danger' : 'warning') }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </p>
            <p><strong>Catatan:</strong> {{ $booking->notes ?? '-' }}</p>
            <p><strong>Dibuat pada:</strong> {{ $booking->created_at->format('d M Y H:i') }}</p>
            <p><strong>Diperbarui pada:</strong> {{ $booking->updated_at->format('d M Y H:i') }}</p>
        </div>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-warning">Edit</a>
    </div>
</div>
@endsection
