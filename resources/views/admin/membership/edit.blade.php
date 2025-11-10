@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Edit Membership</h3>
    <form action="{{ route('admin.membership.update', $membership->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $membership->name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tipe Membership</label>
            <input type="text" name="type" value="{{ $membership->type }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.membership.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Sukses!',
    text: '{{ session('success') }}',
    showConfirmButton: false,
    timer: 2000
});
</script>
@endif
@endsection
