@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('dist/css/admin/user/index.css') }}">

    <div class="container-users">
        <h1>Daftar Users</h1>

        {{-- Filter Bar --}}
        <form id="filterForm" method="GET" action="{{ route('admin.users.index') }}" class="filter-bar mb-3 d-flex flex-wrap align-items-center justify-content-between">
            <div class="search-box">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    class="form-control" 
                    placeholder="🔍 Cari nama, email, atau no HP..."
                    onkeydown="if(event.key === 'Enter'){ this.form.submit(); }">
            </div>
            <div class="filter-role">
                <select name="role" class="form-select" onchange="this.form.submit()">
                    <option value="all" {{ request('role') == 'all' ? 'selected' : '' }}>Semua Role</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>
            <div>
                <a href="{{ route('admin.users.index') }}" class="btn btn-light">Reset</a>
            </div>
        </form>

        <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Tambah User</a>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>No Handphone</th>
                    <th>Role</th>
                    <th>Membership Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td data-label="No">{{ $loop->iteration }}</td>
                        <td data-label="Name">{{ $user->name }}</td>
                        <td data-label="Email">{{ $user->email }}</td>
                        <td data-label="No Handphone">{{ $user->no_handphone }}</td>
                        <td data-label="Role">{{ ucfirst($user->role) }}</td>
                        <td data-label="Membership Status">{{ ucfirst($user->membership_status) }}</td>
                        <td data-label="Aksi">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
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

    {{-- JavaScript untuk auto submit --}}
    <script>
        document.querySelector('.search-box input').addEventListener('input', function(e) {
            if (this.value === '') {
                document.getElementById('filterForm').submit();
            }
        });
    </script>
@endsection