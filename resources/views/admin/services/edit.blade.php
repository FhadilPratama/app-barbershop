@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('dist/css/admin/service/create.css') }}">

<div class="container-form">
    <h1>Edit Layanan</h1>

    <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="form-card">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama">Category</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ $service->nama }}" required>
        </div>

        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" name="harga" id="harga" class="form-control" value="{{ $service->harga }}" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Model</label>
            <input type="text" name="deskripsi" id="deskripsi" class="form-control" value="{{ $service->deskripsi }}">
        </div>

        <div class="form-group">
            <label for="image">Gambar</label><br>
            @if($service->image)
                <img src="{{ asset('uploads/services/' . $service->image) }}" alt="Service Image" class="service-img-preview mb-2">
            @endif
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-light">Kembali</a>
        </div>
    </form>
</div>
@endsection
