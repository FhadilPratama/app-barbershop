@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('dist/css/admin/booking/index.css') }}">

    <div class="container-bookings">
        <h1 class="booking-title">📋 Daftar Booking</h1>

        <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary mb-3">
            ➕ Tambah Booking
        </a>

        <div class="table-responsive">
            <table class="table modern-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Customer</th>
                        <th>Service</th>
                        <th>Foto</th>
                        <th>Total</th>
                        <th>Metode</th>
                        <th>Tanggal Booking</th>
                        <th>Status</th>
                        <th>Catatan</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $b)
                                <tr>
                                    <td data-label="No">{{ $loop->iteration }}</td>
                                    <td data-label="Customer">{{ $b->user->name ?? '-' }}</td>
                                    <td data-label="Service">{{ $b->service->nama ?? '-' }}</td>

                                    {{-- FOTO --}}
                                    <td data-label="Foto">
                                        @if($b->service && $b->service->image)
                                            <img src="{{ asset('uploads/services/' . $b->service->image) }}" width="70" height="70"
                                                class="booking-img">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    {{-- TOTAL --}}
                                    <td data-label="Total">
                                        Rp {{ number_format($b->total_price ?? 0, 0, ',', '.') }}
                                    </td>

                                    {{-- METODE --}}
                                    <td data-label="Metode">
                                        {{ $b->payment_method ? strtoupper($b->payment_method) : '-' }}
                                    </td>

                                    {{-- TANGGAL --}}
                                    <td data-label="Tanggal">{{ $b->formatted_booking_date }}</td>

                                    {{-- STATUS --}}
                                    <td data-label="Status">
                                        <span class="badge badge-status bg-{{
                        $b->status === 'paid' ? 'success' :
                        ($b->status === 'cancelled' ? 'danger' : 'warning')
                                        }}">
                                            {{ strtoupper($b->status) }}
                                        </span>
                                    </td>

                                    {{-- CATATAN --}}
                                    <td data-label="Catatan">{{ $b->notes ?? '-' }}</td>

                                    <td data-label="Aksi">
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.bookings.show', $b->id) }}" class="btn btn-info btn-sm"
                                                title="Detail">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>

                                            <a href="{{ route('admin.bookings.edit', $b->id) }}" class="btn btn-warning btn-sm"
                                                title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>

                                            <form action="{{ route('admin.bookings.destroy', $b->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm btn-delete" title="Hapus">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection