<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'discount_percent',
        'valid_until',
    ];

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
