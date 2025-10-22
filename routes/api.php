<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\PromoController;
use App\Http\Controllers\Api\PointController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Semua route di sini akan otomatis memiliki prefix "/api"
| dan akan mengembalikan response dalam format JSON.
|
*/

// ✅ Tes koneksi API
Route::get('/ping', function () {
    return response()->json(['message' => 'API Connected ✅']);
});

// 🔐 Auth Routes
Route::post('/login', [AuthController::class, 'login']); // Login untuk Flutter
Route::post('/register', [AuthController::class, 'register']); // Opsional (kalau admin buat akun manual)

// Semua route di bawah ini harus login (pakai token Sanctum)
Route::middleware('auth:sanctum')->group(function () {

    // 🔓 Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // 💈 Booking
    Route::get('/bookings', [BookingController::class, 'index']);     // List booking user
    Route::post('/bookings', [BookingController::class, 'store']);    // Buat booking baru
    Route::get('/bookings/{id}', [BookingController::class, 'show']); // Detail booking

    // ✂️ Services (jenis cukur, harga, dll)
    Route::get('/services', [ServiceController::class, 'index']);

    // 💰 Payment
    Route::post('/payments', [PaymentController::class, 'store']); // Proses pembayaran

    // 🎁 Promo & Diskon
    Route::get('/promos', [PromoController::class, 'index']);

    // ⭐ Point System
    Route::get('/points', [PointController::class, 'index']);      // Lihat point user
    Route::post('/points/redeem', [PointController::class, 'redeem']); // Tukar point ke diskon
});
