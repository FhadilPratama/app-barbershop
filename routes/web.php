<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\AntreanController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\PointController;
use App\Http\Controllers\Admin\NotifikasiController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Redirect / ke login atau dashboard jika sudah login
Route::get('/', function () {
    return redirect()->route('admin.dashboard.index');
});

// Group routes admin, semua harus login & verified
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Layanan
    Route::resource('layanan', LayananController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    // Booking
    Route::resource('booking', BookingController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    // Pembayaran
    Route::resource('pembayaran', PembayaranController::class)->only(['index', 'show']);

    // Antrean
    Route::resource('antrean', AntreanController::class)->only(['index', 'show']);

    // Membership
    Route::resource('membership', MembershipController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    // Promo
    Route::resource('promo', PromoController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    // Poin
    Route::resource('point', PointController::class)->only(['index', 'edit', 'update']);

    // Notifikasi
    Route::resource('notifikasi', NotifikasiController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    // Laporan
    Route::resource('laporan', LaporanController::class)->only(['index']);
});

// Group routes profile (harus login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes auth bawaan Laravel
require __DIR__.'/auth.php';
