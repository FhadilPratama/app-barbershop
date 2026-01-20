@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@section('content')
<link rel="stylesheet" href="{{ asset('dist/css/admin/pembayaran/show.css') }}">

<div class="container container-dashboard">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h3 class="dashboard-title mb-0">
            🔍 Detail Pembayaran
        </h3>
        <a href="{{ route('admin.pembayaran.history') }}"
           class="btn btn-gradient-indigo btn-sm px-4 py-2 rounded-pill shadow-sm">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    {{-- PAYMENT INFO --}}
    <div class="modern-card mb-4">
        <div class="modern-header">
            Informasi Pembayaran
        </div>
        <div class="card-body px-4 py-3">
            <table class="detail-table">
                <tr>
                    <th>Metode</th>
                    <td>
                        <span class="badge-method bg-indigo-soft text-indigo">
                            {{ strtoupper($payment->method) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td class="fw-bold text-success">
                        Rp {{ number_format($payment->amount,0,',','.') }}
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge-status
                            {{ $payment->status === 'completed' ? 'bg-green-soft text-green' : 'bg-red-soft text-red' }}">
                            {{ strtoupper($payment->status) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Paid At</th>
                    <td>{{ $payment->formatted_paid_at ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Reference</th>
                    <td>{{ $payment->reference ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Notes</th>
                    <td>{{ $payment->notes ?? '-' }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- BOOKING INFO --}}
    <div class="modern-card mb-4">
        <div class="modern-header">
            Informasi Booking
        </div>
        <div class="card-body px-4 py-3">
            <table class="detail-table">
                <tr>
                    <th>Booking ID</th>
                    <td class="fw-semibold text-primary">
                        #{{ $payment->booking->id }}
                    </td>
                </tr>
                <tr>
                    <th>Customer</th>
                    <td>{{ $payment->booking->user->name }}</td>
                </tr>
                <tr>
                    <th>Service</th>
                    <td>{{ $payment->booking->service->deskripsi }}</td>
                </tr>
                <tr>
                    <th>Tanggal Booking</th>
                    <td>{{ $payment->booking->formatted_booking_date }}</td>
                </tr>
                <tr>
                    <th>Status Booking</th>
                    <td>
                        <span class="badge-status bg-green-soft text-green">
                            {{ strtoupper($payment->booking->status) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Metode Booking</th>
                    <td>
                        <span class="badge-method bg-indigo-soft text-indigo">
                            {{ strtoupper($payment->booking->payment_method ?? '-') }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</div>
@endsection
