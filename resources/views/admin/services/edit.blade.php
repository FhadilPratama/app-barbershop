@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Layanan</h2>
    <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="nama" class="form-control" value="{{ $service->nama }}" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $service->harga }}" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $service->deskripsi }}</textarea>
        </div>
        <div class="mb-3">
            <label>Gambar</label><br>
            @if($service->image)
                <img src="{{ asset('uploads/services/' . $service->image) }}" alt="Service Image" width="100" height="100" class="mb-2" style="object-fit: cover;">
            @endif
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-check">
            <input type="checkbox" name="status_aktif" class="form-check-input" value="1" {{ $service->status_aktif ? 'checked' : '' }}>
            <label class="form-check-label">Aktif</label>
        </div>
        <button class="btn btn-success mt-3">Perbarui</button>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection
