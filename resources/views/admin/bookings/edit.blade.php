@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Booking</h2>

    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="form-control">
                @foreach($users as $u)
                    <option value="{{ $u->id }}" {{ $booking->user_id == $u->id ? 'selected' : '' }}>
                        {{ $u->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Service</label>
            <select name="service_id" class="form-control">
                @foreach($services as $s)
                    <option value="{{ $s->id }}" {{ $booking->service_id == $s->id ? 'selected' : '' }}>
                        {{ $s->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal Booking</label>
            <input type="datetime-local" name="booking_date" value="{{ date('Y-m-d\TH:i', strtotime($booking->booking_date)) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                @foreach(['pending','confirmed','paid','done','cancelled'] as $status)
                    <option value="{{ $status }}" {{ $booking->status == $status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Catatan</label>
            <textarea name="notes" class="form-control" rows="3">{{ $booking->notes }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
