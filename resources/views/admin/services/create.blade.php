@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('dist/css/admin/service/create.css') }}">

<div class="container-form">
    <h1>Tambah Layanan</h1>

    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="form-card">
        @csrf

        <div class="form-group">
            <label for="nama">Category</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" name="harga" id="harga" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Model</label>
            <input type="text" name="deskripsi" id="deskripsi" class="form-control">
        </div>

        <div class="form-group">
            <label for="image">Gambar</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-light">Kembali</a>
        </div>
    </form>
</div>
@endsection
