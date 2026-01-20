@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('dist/css/admin/user/create.css') }}">

<div class="container-create-user">
    <h1>Tambah User</h1>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <!-- Nama -->
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name') }}" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" required>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- No Handphone -->
        <div class="form-group">
            <label for="no_handphone">No Handphone</label>
            <input type="text" name="no_handphone" id="no_handphone"
                   class="form-control @error('no_handphone') is-invalid @enderror"
                   value="{{ old('no_handphone') }}">
            @error('no_handphone')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password"
                   class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                   class="form-control" required>
        </div>

        <!-- Role -->
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                <option value="">-- Pilih Role --</option>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-actions mt-4">
            <button type="submit" class="btn btn-success">Tambah User</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-light">Kembali</a>
        </div>
    </form>
</div>
@endsection
