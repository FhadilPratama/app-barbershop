@extends('layouts.app')

@section('content')
    <h1>Edit User</h1>
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password (kosongkan jika tidak ingin mengubah)</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <!-- Role -->
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control">
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <!-- Membership Status -->
        <div class="form-group" id="membership_status_div">
            <label for="membership_status">Status Membership</label>
            <select name="membership_status" id="membership_status" class="form-control">
                <option value="normal" {{ $user->membership_status == 'normal' ? 'selected' : '' }}>Normal</option>
                <option value="vip" {{ $user->membership_status == 'vip' ? 'selected' : '' }}>VIP</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update User</button>
    </form>

    <script>
        // Menyembunyikan "membership_status" jika role adalah "user"
        document.getElementById("role").addEventListener("change", function() {
            var role = this.value;
            var membershipStatusDiv = document.getElementById("membership_status_div");
            if (role === "user") {
                membershipStatusDiv.style.display = "none";  // Sembunyikan field membership jika role adalah user
            } else {
                membershipStatusDiv.style.display = "block";  // Tampilkan field membership jika role adalah admin
            }
        });

        // Menetapkan default nilai membership jika role adalah "user"
        document.addEventListener("DOMContentLoaded", function() {
            var role = document.getElementById("role").value;
            var membershipStatusDiv = document.getElementById("membership_status_div");
            if (role === "user") {
                membershipStatusDiv.style.display = "none";  // Sembunyikan field membership jika role adalah user
            }
        });
    </script>
@endsection
