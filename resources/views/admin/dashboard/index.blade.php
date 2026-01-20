@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('dist/css/admin/dashboard/index.css') }}">

<div class="container-dashboard">

    <h1 class="dashboard-title">📊 Dashboard Admin</h1>

    {{-- STAT CARD --}}
    <div class="row mb-4 g-3">
        <div class="col-md-3">
            <div class="stat-card gradient-indigo">
                <small>Total Booking</small>
                <h4>{{ $totalBookings }}</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card gradient-blue">
                <small>Booking Hari Ini</small>
                <h4>{{ $todayBookings }}</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card gradient-green">
                <small>Total Pendapatan</small>
                <h4>
                    Rp {{ number_format($totalIncome,0,',','.') }}
                </h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card gradient-teal">
                <small>Pendapatan Hari Ini</small>
                <h4>
                    Rp {{ number_format($todayIncome,0,',','.') }}
                </h4>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="row g-4">
        {{-- BOOKING TERBARU --}}
        <div class="col-md-6">
            <div class="card modern-card">
                <div class="card-header modern-header">
                    📌 Booking Terbaru
                </div>
                <div class="card-body p-0">
                    <table class="table modern-table mb-0">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Layanan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestBookings as $b)
                            <tr>
                                <td>{{ $b->user->name ?? '-' }}</td>
                                <td>{{ $b->service->nama ?? '-' }}</td>
                                <td>
                                    <span class="badge badge-status bg-{{ $b->status=='paid'?'success':'warning' }}">
                                        {{ strtoupper($b->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">
                                    Tidak ada data
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- PEMBAYARAN TERBARU --}}
        <div class="col-md-6">
            <div class="card modern-card">
                <div class="card-header modern-header">
                    💳 Pembayaran Terbaru
                </div>
                <div class="card-body p-0">
                    <table class="table modern-table mb-0">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Metode</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestPayments as $p)
                            <tr>
                                <td>{{ $p->booking->user->name ?? '-' }}</td>
                                <td>
                                    <span class="badge badge-method bg-primary">
                                        {{ strtoupper($p->method) }}
                                    </span>
                                </td>
                                <td>
                                    Rp {{ number_format($p->amount,0,',','.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">
                                    Tidak ada data
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
