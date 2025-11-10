@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Tambah Membership</h3>
    <form action="{{ route('admin.membership.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tipe Membership</label>
            <input type="text" name="type" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email Login</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password Login</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.membership.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
