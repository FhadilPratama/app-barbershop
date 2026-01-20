@extends('layouts.app')

@section('title', 'Pembayaran Online')

@section('content')
<link rel="stylesheet" href="{{ asset('dist/css/admin/pembayaran/index.css') }}">

<div class="container-bookings">

    <h1 class="booking-title">💳 Pembayaran Online</h1>

    {{-- Info Booking --}}
    <div class="detail-card mb-4">
        <div class="detail-header">
            Detail Booking #{{ $booking->id }}
        </div>

        <div class="detail-body">
            <div class="detail-grid">
                <div>
                    <small>Customer</small>
                    <p>{{ $booking->user->name ?? '-' }}</p>
                </div>
                <div>
                    <small>Layanan</small>
                    <p>{{ $booking->service->nama ?? '-' }}</p>
                </div>
                <div>
                    <small>Tanggal Booking</small>
                    <p>{{ $booking->formatted_booking_date }}</p>
                </div>
                <div>
                    <small>Status</small>
                    <p>
                        <span class="badge badge-status bg-{{
                            $booking->status === 'paid' ? 'success' :
                            ($booking->status === 'cancelled' ? 'danger' : 'warning')
                        }}">
                            {{ strtoupper($booking->status) }}
                        </span>
                    </p>
                </div>
                <div>
                    <small>Metode Pembayaran</small>
                    <p>{{ $booking->payment_method ? strtoupper($booking->payment_method) : '-' }}</p>
                </div>
                <div>
                    <small>Total Pembayaran</small>
                    <p class="fw-bold text-success">
                        Rp {{ number_format($booking->total_price,0,',','.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Tombol Bayar --}}
    <div class="text-center">
        <button id="pay-button" class="btn btn-primary px-5 py-2">
            💸 Bayar Sekarang
        </button>
    </div>

</div>

{{-- Midtrans --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script>
document.getElementById('pay-button').onclick = function () {
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(){
            window.location.href = "{{ route('admin.pembayaran.index') }}";
        }
    });
};
</script>
@endsection
