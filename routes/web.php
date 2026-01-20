<?php

use App\Http\Controllers\Admin\{
    DashboardController,
    LayananController,
    BookingController,
    PembayaranController,
    AntreanController,
    MembershipController,
    PromoController,
    PointController,
    NotifikasiController,
    LaporanController,
    UserController
};
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

// Redirect root ke dashboard
Route::get('/', fn() => redirect()->route('admin.dashboard.index'));

// =======================
// ADMIN ROUTES
// =======================
Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard.index');

        Route::resource('layanan', LayananController::class)
            ->except('show');

        Route::resource('bookings', BookingController::class);
        Route::get('bookings/service/{id}', [BookingController::class, 'getService'])
            ->name('bookings.getService');

        Route::post('bookings/{booking}/mark-as-paid', [BookingController::class, 'markAsPaid'])
            ->name('bookings.markAsPaid');

        // ===================
        // PEMBAYARAN
        // ===================
        Route::get('pembayaran/history', [PembayaranController::class, 'history'])
            ->name('pembayaran.history');

        Route::post('pembayaran/booking/{booking}/cash', [PembayaranController::class, 'payCash'])
            ->name('pembayaran.cash');

        Route::get('pembayaran/booking/{booking}/online', [PembayaranController::class, 'payOnline'])
            ->name('pembayaran.online');

        Route::resource('pembayaran', PembayaranController::class)
            ->only(['index', 'show']);

        // 🔥 Simulasi hanya LOCAL
        if (app()->environment(['local', 'testing'])) {
            Route::post(
                'pembayaran/callback-simulate',
                [PembayaranController::class, 'callbackSimulate']
            )->name('pembayaran.callback-simulate');
        }

        Route::resource('antrean', AntreanController::class)->only(['index', 'show']);
        Route::resource('membership', MembershipController::class)->except('show');
        Route::resource('promo', PromoController::class)->except('show');
        Route::resource('point', PointController::class)->only(['index', 'edit', 'update']);
        Route::resource('notifikasi', NotifikasiController::class)->except('show');
        Route::resource('laporan', LaporanController::class)->only('index');
        Route::resource('users', UserController::class)->except('show');
        Route::resource('services', ServiceController::class);
    });

// =======================
// MIDTRANS CALLBACK
// =======================
Route::post('/midtrans/callback', [PembayaranController::class, 'callback']);

// =======================
// PROFILE
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes
require __DIR__ . '/auth.php';
