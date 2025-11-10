<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'harga', 'deskripsi', 'status_aktif', 'image'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
