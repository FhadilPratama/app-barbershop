@extends('layouts.app')

@section('title', 'Laporan Pembayaran')

@section('content')
<link rel="stylesheet" href="{{ asset('dist/css/admin/laporan/index.css') }}">

<div class="container container-dashboard">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h3 class="dashboard-title mb-0">
            📊 Laporan Pembayaran
        </h3>
    </div>

    {{-- FILTER --}}
    <form method="GET" class="filter-card mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Dari Tanggal</label>
                <input type="date" name="from" class="form-control"
                       value="{{ request('from') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">Sampai Tanggal</label>
                <input type="date" name="to" class="form-control"
                       value="{{ request('to') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">Metode Pembayaran</label>
                <select name="method" class="form-select">
                    <option value="">Semua Metode</option>
                    <option value="cash" {{ request('method')=='cash'?'selected':'' }}>
                        Cash
                    </option>
                    <option value="online" {{ request('method')=='online'?'selected':'' }}>
                        Online
                    </option>
                </select>
            </div>

            <div class="col-md-3">
                <button class="btn btn-gradient-indigo w-100">
                    <i class="fa-solid fa-filter me-1"></i> Filter
                </button>
            </div>
        </div>
    </form>

    {{-- SUMMARY --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="summary-card summary-total">
                <div class="summary-label">Total Pemasukan</div>
                <div class="summary-value">
                    Rp {{ number_format($totalIncome,0,',','.') }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="summary-card summary-cash">
                <div class="summary-label">Cash</div>
                <div class="summary-value">
                    Rp {{ number_format($totalCash,0,',','.') }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="summary-card summary-online">
                <div class="summary-label">Online</div>
                <div class="summary-value">
                    Rp {{ number_format($totalOnline,0,',','.') }}
                </div>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="modern-card">
        <div class="modern-header">
            Data Pembayaran
        </div>

        <div class="card-body p-0">
            <div class="table-responsive px-3 py-3">
                <table class="modern-table align-middle">
                    <thead>
                        <tr>
                            <th class="text-center" style="width:60px;">No</th>
                            <th>Booking</th>
                            <th>Customer</th>
                            <th>Layanan</th>
                            <th>Metode</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $p)
                        <tr>
                            <td class="text-center fw-bold text-primary">
                                {{ $loop->iteration }}
                            </td>
                            <td class="fw-semibold">#{{ $p->booking_id }}</td>
                            <td>{{ $p->booking->user->name ?? '-' }}</td>
                            <td>{{ $p->booking->service->nama ?? '-' }}</td>
                            <td>
                                <span class="badge-method
                                    {{ $p->method=='cash' ? 'bg-green-soft text-green' : 'bg-indigo-soft text-indigo' }}">
                                    {{ strtoupper($p->method) }}
                                </span>
                            </td>
                            <td class="fw-bold text-success">
                                Rp {{ number_format($p->amount,0,',','.') }}
                            </td>
                            <td>
                                {{ $p->paid_at?->format('d M Y H:i') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Tidak ada data pembayaran
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
