@extends('layouts.app')

@section('content')
    <h1>Tambah User</h1>
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <!-- Nama -->
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <!-- Konfirmasi Password -->
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <!-- Role -->
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <!-- Membership Status (Tampilkan hanya jika role = admin) -->
        <div class="form-group" id="membership_status_div">
            <label for="membership_status">Status Membership</label>
            <select name="membership_status" id="membership_status" class="form-control">
                <option value="normal">Normal</option>
                <option value="vip">VIP</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Tambah User</button>
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
