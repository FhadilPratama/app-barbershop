@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Booking</h2>

    <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary mb-3">Tambah Booking</a>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Customer</th>
                <th>Category</th>
                <th>Harga</th>
                <th>Foto</th>
                <th>Tanggal Booking</th>
                <th>Status</th>
                <th>Catatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $b)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $b->user->name ?? '-' }}</td>
                <td>{{ $b->service->nama ?? '-' }}</td>
                <td>Rp {{ number_format($b->service->harga ?? 0, 0, ',', '.') }}</td>
                <td>
                    @if ($b->service && $b->service->image)
                        <img src="{{ asset('uploads/services/' . $b->service->image) }}" 
                             alt="Foto Service" 
                             width="80" height="80" 
                             class="rounded shadow-sm border">
                    @else
                        <span class="text-muted">Tidak ada gambar</span>
                    @endif
                </td>
                <td>{{ $b->booking_date }}</td>
                <td>
                    <span class="badge bg-{{ $b->status == 'done' ? 'success' : ($b->status == 'cancelled' ? 'danger' : 'warning') }}">
                        {{ ucfirst($b->status) }}
                    </span>
                </td>
                <td>{{ $b->notes }}</td>
                <td>
                    <a href="{{ route('admin.bookings.show', $b->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('admin.bookings.edit', $b->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.bookings.destroy', $b->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm delete-btn">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // SweetAlert untuk session success
    @if(session('success'))
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: {!! json_encode(session('success')) !!},
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true
        });
    @endif

    // Konfirmasi hapus
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function(e){
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if(result.isConfirmed){
                    btn.closest('form').submit();
                }
            });
        });
    });
</script>
@endpush
