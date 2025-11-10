@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Booking</h2>

    <form action="{{ route('admin.bookings.store') }}" method="POST">
        @csrf

        {{-- Pilih atau Input User --}}
        <div class="mb-4">
            <label for="userSelect" class="form-label fw-semibold">User</label>

            <!-- Input manual langsung di atas dropdown -->
            <input type="text" id="manualUserInput" class="form-control mb-2" placeholder="Ketik nama user baru">

            <select name="user_id" id="userSelect" class="form-select">
                <option value="">-- Pilih User --</option>
                @foreach($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>

            <div class="form-text">Jika user sudah ada, pilih dari daftar. Jika belum, ketik di atas.</div>
        </div>

        {{-- Pilih Service --}}
        <div class="mb-3">
            <label>Service</label>
            <select name="service_id" id="serviceSelect" class="form-control" required>
                <option value="">-- Pilih Service --</option>
                @foreach($services as $s)
                    <option value="{{ $s->id }}">{{ $s->nama }}</option>
                @endforeach
            </select>
        </div>

        {{-- Harga Service --}}
        <div id="servicePriceCard" class="card mb-3 p-3" style="display:none; max-width:400px;">
            <p class="mb-0"><strong>Harga Service:</strong> Rp <span id="serviceharga"></span></p>
        </div>

        {{-- Foto Service --}}
        <div id="serviceImageCard" class="card mb-4 p-3" style="display:none; max-width:150px;">
            <img id="serviceImage" src="" alt="Service Image" class="img-thumbnail">
        </div>

        {{-- Tanggal Booking --}}
        <div class="mb-3">
            <label>Tanggal Booking</label>
            <input type="datetime-local" name="booking_date" class="form-control" required>
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="paid">Paid</option>
                <option value="done">Done</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        {{-- Catatan --}}
        <div class="mb-3">
            <label>Catatan</label>
            <textarea name="notes" class="form-control" rows="3"></textarea>
        </div>

        {{-- Tombol --}}
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

{{-- Script AJAX untuk ambil harga & foto service --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const serviceSelect = document.getElementById('serviceSelect');
    serviceSelect.addEventListener('change', async function() {
        const serviceId = this.value;
        const priceCard = document.getElementById('servicePriceCard');
        const imageCard = document.getElementById('serviceImageCard');
        const priceEl = document.getElementById('serviceharga');
        const imgEl = document.getElementById('serviceImage');

        if (!serviceId) {
            priceCard.style.display = 'none';
            imageCard.style.display = 'none';
            return;
        }

        try {
            const res = await fetch(`{{ url('admin/admin/bookings/service') }}/${serviceId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                credentials: 'same-origin'
            });

            const data = await res.json();
            console.log(data);

            // tampilkan harga
            priceEl.textContent = new Intl.NumberFormat('id-ID').format(data.harga);
            priceCard.style.display = 'block';

            // tampilkan gambar
            if (data.image_url) {
                imgEl.src = data.image_url;
                imageCard.style.display = 'block';
            } else {
                imageCard.style.display = 'none';
            }

        } catch (err) {
            console.error('Gagal ambil data service:', err);
            priceCard.style.display = 'none';
            imageCard.style.display = 'none';
        }
    });
});
</script>
@endsection
