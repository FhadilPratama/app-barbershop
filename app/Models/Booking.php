<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * ❗ FIELD YANG BOLEH DIISI DARI CONTROLLER
     */
    protected $fillable = [
        'user_id',
        'service_id',
        'booking_date',
        'notes',
        'total_price',
        'status',           // ✅ TAMBAH
        'payment_method',   // ✅ TAMBAH
        'payment_date',     // ✅ TAMBAH
    ];

    protected $casts = [
        'booking_date' => 'datetime',
        'payment_date' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class)->latestOfMany();
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS (DISPLAY ONLY)
    |--------------------------------------------------------------------------
    */

    public function getFormattedBookingDateAttribute()
    {
        return $this->booking_date
            ? $this->booking_date->format('d M Y H:i')
            : '-';
    }

    public function getFormattedPaymentDateAttribute()
    {
        return $this->payment_date
            ? $this->payment_date->format('d M Y H:i')
            : '-';
    }

    /*
    |--------------------------------------------------------------------------
    | STATE CHECKERS (AMAN)
    |--------------------------------------------------------------------------
    */

    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    public function isUnpaid(): bool
    {
        return $this->status === 'unpaid';
    }

    public function isOnlinePayment(): bool
    {
        return $this->payment_method === 'online';
    }

    public function isCashPayment(): bool
    {
        return $this->payment_method === 'cash';
    }
}
