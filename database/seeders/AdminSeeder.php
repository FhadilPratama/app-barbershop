<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk membuat akun admin.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@barber.com'],
            [
                'name' => 'Admin Barbershop',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),

                // tambahkan field wajib baru
                'no_handphone' => '081234567890',
                'role' => 'admin',
                'membership_status' => 'vip',
            ]
        );
    }
}
