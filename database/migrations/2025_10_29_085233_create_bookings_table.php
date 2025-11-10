<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id(); // BIGINT PK
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->dateTime('booking_date');
            $table->enum('status', ['pending', 'confirmed', 'paid', 'done', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps(); // created_at dan updated_at otomatis
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
