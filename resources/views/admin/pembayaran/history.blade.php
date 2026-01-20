@extends('layouts.app')

@section('title', 'Riwayat Pembayaran')

@section('content')
<link rel="stylesheet" href="{{ asset('dist/css/admin/pembayaran/history.css') }}">

<div class="container container-dashboard">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h3 class="dashboard-title mb-0">
            📜 Riwayat Pembayaran
        </h3>
        <a href="{{ route('admin.pembayaran.index') }}"
           class="btn btn-gradient-indigo btn-sm px-4 py-2 rounded-pill shadow-sm">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    {{-- Card Table --}}
    <div class="modern-card">
        <div class="modern-header">
            Data Riwayat Pembayaran
        </div>

        <div class="card-body p-0">
            <div class="table-responsive px-3 py-3">
                <table class="modern-table align-middle">
                    <thead>
                        <tr>
                            <th class="text-center" style="width:60px;">No</th>
                            <th>Booking</th>
                            <th>Metode</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th class="text-center" style="width:120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td class="text-center fw-bold text-primary">
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <div class="fw-semibold text-dark">
                                    #{{ $payment->booking_id }}
                                </div>
                            </td>

                            <td>
                                <span class="badge-method bg-indigo-soft text-indigo">
                                    {{ strtoupper($payment->method) }}
                                </span>
                            </td>

                            <td class="fw-bold text-success">
                                Rp {{ number_format($payment->amount,0,',','.') }}
                            </td>

                            <td>
                                <span class="badge-status
                                    {{ $payment->status === 'completed' ? 'bg-green-soft text-green' :
                                       ($payment->status === 'pending' ? 'bg-yellow-soft text-yellow' : 'bg-red-soft text-red') }}">
                                    {{ strtoupper($payment->status) }}
                                </span>
                            </td>

                            <td>
                                {{ $payment->formatted_paid_at ?? '-' }}
                            </td>

                            <td class="text-center">
                                <a href="{{ route('admin.pembayaran.show', $payment->id) }}"
                                   class="btn btn-icon btn-blue" title="Detail Pembayaran">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
