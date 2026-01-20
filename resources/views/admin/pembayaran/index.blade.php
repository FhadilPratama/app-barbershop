@extends('layouts.app')

@section('title', 'Daftar Pembayaran')

@section('content')
<link rel="stylesheet" href="{{ asset('dist/css/admin/pembayaran/index.css') }}">

<div class="container-bookings">
    <h1 class="booking-title">🧾 Daftar Pembayaran</h1>

    <a href="{{ route('admin.pembayaran.history') }}" class="btn btn-primary mb-3">
        ⏱️ Riwayat Pembayaran
    </a>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-3 border-0 mb-3">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger shadow-sm rounded-3 border-0 mb-3">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table modern-table align-middle mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Customer</th>
                    <th>Layanan</th>
                    <th>Tanggal</th>
                    <th>Metode</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th width="160">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td data-label="No">{{ $loop->iteration }}</td>

                        <td data-label="Customer">
                            {{ $booking->user->name ?? '-' }}
                        </td>

                        <td data-label="Layanan">
                            {{ $booking->service->nama ?? '-' }}
                        </td>

                        <td data-label="Tanggal">
                            {{ $booking->formatted_booking_date }}
                        </td>

                        <td data-label="Metode">
                            {{ $booking->payment_method ? strtoupper($booking->payment_method) : '-' }}
                        </td>

                        <td data-label="Total">
                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                        </td>

                        <td data-label="Status">
                            <span class="badge badge-status bg-{{ 
                                $booking->status === 'paid' ? 'success' : 
                                ($booking->status === 'cancelled' ? 'danger' : 'warning') 
                            }}">
                                {{ strtoupper($booking->status) }}
                            </span>
                        </td>

                        <td data-label="Aksi">
                            <div class="action-buttons">
                                @if($booking->status === 'unpaid')
                                    <form action="{{ route('admin.pembayaran.cash', $booking->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm" title="Bayar Cash">
                                            <i class="fa-solid fa-money-bill-wave"></i>
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.pembayaran.online', $booking->id) }}" 
                                       class="btn btn-primary btn-sm" title="Bayar Online">
                                        <i class="fa-solid fa-globe"></i>
                                    </a>
                                @else
                                    <a href="{{ route('admin.pembayaran.show', $booking->payment->id ?? 0) }}" 
                                       class="btn btn-info btn-sm" title="Detail Pembayaran">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
