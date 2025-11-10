@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Layanan</h2>
    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-check">
            <input type="checkbox" name="status_aktif" class="form-check-input" value="1" checked>
            <label class="form-check-label">Aktif</label>
        </div>
        <button class="btn btn-success mt-3">Simpan</button>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection
