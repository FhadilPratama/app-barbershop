@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('dist/css/admin/booking/show.css') }}">

<div class="container py-4">

    <div class="card booking-show-card">

        {{-- HEADER --}}
        <div class="card-header booking-show-header">
            <div>
                <h4 class="booking-show-title">📄 Detail Booking</h4>
                <small class="booking-show-subtitle">Informasi lengkap booking pelanggan</small>
            </div>
            <span class="booking-status-badge status-{{ $booking->status }}">
                {{ strtoupper($booking->status) }}
            </span>
        </div>

        {{-- BODY --}}
        <div class="card-body booking-show-body">

            <div class="row g-4">

                {{-- LEFT: USER & BOOKING --}}
                <div class="col-md-6">

                    <div class="info-card">
                        <h6 class="info-card-title">👤 Informasi User</h6>

                        <div class="info-row">
                            <span class="info-label">Nama</span>
                            <span class="info-value">{{ $booking->user->name ?? '-' }}</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Email</span>
                            <span class="info-value">{{ $booking->user->email ?? '-' }}</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Telepon</span>
                            <span class="info-value">{{ $booking->user->phone ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="info-card mt-3">
                        <h6 class="info-card-title">📅 Informasi Booking</h6>

                        <div class="info-row">
                            <span class="info-label">Tanggal Booking</span>
                            <span class="info-value">
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y, H:i') }}
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Status</span>
                            <span class="info-value text-uppercase fw-semibold">
                                {{ $booking->status }}
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Catatan</span>
                            <span class="info-value">
                                {{ $booking->notes ?? '-' }}
                            </span>
                        </div>
                    </div>

                </div>

                {{-- RIGHT: SERVICE --}}
                <div class="col-md-6">

                    <div class="info-card service-info-card">

                        <h6 class="info-card-title">🛠️ Informasi Service</h6>

                        <div class="service-main d-flex gap-3 align-items-center">

                            <div class="service-image-wrapper"
                                 @if(!$booking->service->image_url) style="display:none;" @endif>
                                <img src="{{ $booking->service->image_url ?? '' }}"
                                     class="service-image">
                            </div>

                            <div class="service-details">
                                <p class="service-name">
                                    {{ $booking->service->deskripsi ?? '-' }}
                                </p>

                                <p class="service-meta">
                                    <span class="badge bg-light text-dark me-1">
                                        {{ $booking->service->category ?? '-' }}
                                    </span>
                                    <span class="badge bg-light text-dark">
                                        {{ $booking->service->model ?? '-' }}
                                    </span>
                                </p>

                                <p class="service-price">
                                    Rp {{ number_format($booking->service->harga ?? 0, 0, ',', '.') }}
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- ACTION BUTTONS --}}
            <div class="booking-show-actions mt-4">

                <a href="{{ route('admin.bookings.edit', $booking->id) }}"
                   class="btn btn-primary btn-lg rounded-pill px-4 shadow-sm">
                    <i class="fa-solid fa-pen-to-square me-2"></i> Edit
                </a>

                <a href="{{ route('admin.bookings.index') }}"
                   class="btn btn-light btn-lg rounded-pill px-4 shadow-sm border">
                    <i class="fa-solid fa-arrow-left me-2"></i> Kembali
                </a>

            </div>

        </div>
    </div>

</div>
@endsection
