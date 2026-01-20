@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('dist/css/admin/service/index.css') }}">

<div class="container-services">
    <h1>Daftar Layanan</h1>

    {{-- Filter Bar --}}
    <form id="filterForm" method="GET" action="{{ route('admin.services.index') }}" class="filter-bar mb-3 d-flex flex-wrap align-items-center justify-content-between">
        <div class="search-box">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                class="form-control" 
                placeholder="🔍 Cari nama atau model..."
                onkeydown="if(event.key === 'Enter'){ this.form.submit(); }">
        </div>
        <div class="filter-role">
            <select name="category" class="form-select" onchange="this.form.submit()">
                <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <a href="{{ route('admin.services.index') }}" class="btn btn-light">Reset</a>
        </div>
    </form>

    <a href="{{ route('admin.services.create') }}" class="btn btn-primary mb-3">Tambah Layanan</a>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Category</th>
                    <th>Model</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $index => $service)
                    <tr>
                        <td data-label="No">{{ $index + 1 }}</td>
                        <td data-label="Gambar">
                            @if($service->image)
                                <img src="{{ asset('uploads/services/' . $service->image) }}" alt="Service Image" width="60" height="60" style="object-fit: cover; border-radius: 6px;">
                            @else
                                <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>
                        <td data-label="Category">{{ $service->nama }}</td>
                        <td data-label="Model">{{ $service->deskripsi }}</td>
                        <td data-label="Harga">Rp {{ number_format($service->harga, 0, ',', '.') }}</td>
                        <td data-label="Aksi">
                            <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    // Auto submit saat search box kosong
    document.querySelector('.search-box input').addEventListener('input', function(e) {
        if (this.value === '') {
            document.getElementById('filterForm').submit();
        }
    });
</script>
@endsection
