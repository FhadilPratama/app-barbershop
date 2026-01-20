@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('dist/css/admin/booking/create.css') }}">

<div class="container py-4">

    <div class="card booking-create-card">

        {{-- HEADER --}}
        <div class="card-header booking-create-header">
            <div>
                <h4 class="booking-create-title">➕ Tambah Booking</h4>
                <small class="booking-create-subtitle">Isi detail booking pelanggan dengan lengkap</small>
            </div>
            <span class="booking-status-badge">
                Status: UNPAID
            </span>
        </div>

        {{-- BODY --}}
        <div class="card-body booking-create-body">

            <form action="{{ route('admin.bookings.store') }}" method="POST">
                @csrf

                {{-- USER --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">User</label>

                    <input type="text"
                           name="manual_user_input"
                           class="form-control form-control-lg booking-input mb-2"
                           placeholder="✨ Ketik nama user baru">

                    <select name="user_id" class="form-select form-select-lg booking-input">
                        <option value="">-- Pilih User --</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                        @endforeach
                    </select>

                    <div class="form-text">
                        Pilih user yang ada atau ketik nama untuk user baru
                    </div>
                </div>

                {{-- SERVICE --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Service</label>
                    <select name="service_id"
                            id="serviceSelect"
                            class="form-select form-select-lg booking-input"
                            required>
                        <option value="">-- Pilih Service --</option>
                        @foreach($services as $s)
                            <option value="{{ $s->id }}">{{ $s->deskripsi }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- INFO SERVICE --}}
                <div id="serviceInfoCard" class="service-info-card" style="display:none; max-width:560px;">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-8">
                            <p class="service-info-item">
                                <span class="service-info-label">Category</span><br>
                                <span id="serviceCategory" class="service-info-value">-</span>
                            </p>
                            <p class="service-info-item">
                                <span class="service-info-label">Model</span><br>
                                <span id="serviceModel" class="service-info-value">-</span>
                            </p>
                            <p class="service-info-item mb-0">
                                <span class="service-info-label text-success">Harga</span><br>
                                <span class="service-info-price">
                                    Rp <span id="serviceHarga">-</span>
                                </span>
                            </p>
                        </div>

                        <div class="col-md-4 text-center" id="serviceImageWrapper" style="display:none;">
                            <img id="serviceImage" class="service-info-image">
                        </div>
                    </div>
                </div>

                {{-- BOOKING DATE --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Tanggal Booking</label>
                    <input type="datetime-local"
                           name="booking_date"
                           class="form-control form-control-lg booking-input"
                           required>
                </div>

                {{-- CATATAN --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Catatan</label>
                    <textarea name="notes"
                              class="form-control form-control-lg booking-input"
                              rows="3"
                              placeholder="📝 Tambahkan catatan jika ada..."></textarea>
                </div>

                {{-- INFO STATUS --}}
                <div class="booking-status-alert">
                    <i class="fa-solid fa-circle-info me-2"></i>
                    <strong>Status:</strong> Otomatis <b>UNPAID</b> saat booking dibuat
                </div>

                {{-- ACTION BUTTONS --}}
                <div class="booking-action-buttons">
                    <button class="btn btn-success btn-lg rounded-pill px-4 shadow-sm">
                        <i class="fa-solid fa-floppy-disk me-2"></i> Simpan Booking
                    </button>
                    <a href="{{ route('admin.bookings.index') }}"
                       class="btn btn-light btn-lg rounded-pill px-4 shadow-sm border">
                        <i class="fa-solid fa-arrow-left me-2"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

{{-- AJAX Service --}}
<script>
    document.getElementById('serviceSelect').addEventListener('change', async function () {
        const serviceId = this.value;

        const card = document.getElementById('serviceInfoCard');
        const category = document.getElementById('serviceCategory');
        const model = document.getElementById('serviceModel');
        const harga = document.getElementById('serviceHarga');
        const imgWrap = document.getElementById('serviceImageWrapper');
        const img = document.getElementById('serviceImage');

        if (!serviceId) {
            card.style.display = 'none';
            return;
        }

        try {
            const res = await fetch(`{{ url('admin/bookings/service') }}/${serviceId}`);
            const data = await res.json();

            category.textContent = data.category ?? '-';
            model.textContent = data.model ?? '-';
            harga.textContent = new Intl.NumberFormat('id-ID').format(data.harga);

            if (data.image_url) {
                img.src = data.image_url;
                imgWrap.style.display = 'block';
            } else {
                imgWrap.style.display = 'none';
            }

            card.style.display = 'block';

        } catch (error) {
            console.error('Gagal ambil service:', error);
            card.style.display = 'none';
        }
    });
</script>
@endsection
