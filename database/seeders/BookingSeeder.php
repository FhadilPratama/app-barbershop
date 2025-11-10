<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Service;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first(); // pastikan user ada
        $service = Service::first(); // pastikan service ada

        Booking::create([
            'user_id' => $user->id,
            'service_id' => $service->id,
            'booking_date' => Carbon::now()->addDays(2),
            'status' => 'pending',
            'notes' => 'Catatan contoh booking pelanggan',
        ]);
    }
}
