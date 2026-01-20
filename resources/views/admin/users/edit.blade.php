@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('dist/css/admin/user/edit.css') }}">

<div class="container-user-form">
    <div class="card shadow-lg border-0 rounded-4 p-4 bg-white animate__animated animate__fadeIn">
        <h1 class="text-center mb-4 fw-bold text-primary">Edit User</h1>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="form-group mb-3">
                <label for="name" class="form-label fw-semibold">Nama</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
            </div>

            <!-- Email -->
            <div class="form-group mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <!-- No Handphone -->
            <div class="form-group mb-3">
                <label for="no_handphone" class="form-label fw-semibold">No Handphone</label>
                <input type="text" name="no_handphone" id="no_handphone" class="form-control" value="{{ $user->no_handphone }}">
            </div>

            <!-- Password -->
            <div class="form-group mb-3">
                <label for="password" class="form-label fw-semibold">Password (kosongkan jika tidak ganti)</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <!-- Konfirmasi Password -->
            <div class="form-group mb-3">
                <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>

            <!-- Role -->
            <div class="form-group mb-3">
                <label for="role" class="form-label fw-semibold">Role</label>
                <select name="role" id="role" class="form-select">
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <!-- Membership Status -->
            <div class="form-group mb-3" id="membership_status_div">
                <label for="membership_status" class="form-label fw-semibold">Status Membership</label>
                <select name="membership_status" id="membership_status" class="form-select">
                    <option value="normal" {{ $user->membership_status == 'normal' ? 'selected' : '' }}>Normal</option>
                    <option value="vip" {{ $user->membership_status == 'vip' ? 'selected' : '' }}>VIP</option>
                </select>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success px-5 py-2 rounded-pill shadow-sm">
                    <i class="bi bi-check-circle me-1"></i> Update User
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleMembership() {
        const role = document.getElementById("role").value;
        const membershipStatusDiv = document.getElementById("membership_status_div");
        membershipStatusDiv.style.display = role === "admin" ? "block" : "none";
    }

    document.getElementById("role").addEventListener("change", toggleMembership);
    document.addEventListener("DOMContentLoaded", toggleMembership);
</script>
@endsection
