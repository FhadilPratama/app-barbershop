<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('service_id')
                ->constrained('services')
                ->cascadeOnDelete();

            $table->dateTime('booking_date');

            // 🔒 STATUS DIKUNCI (TANPA CANCELLED)
            $table->enum('status', ['unpaid', 'paid'])
                ->default('unpaid');

            // 💳 METODE PEMBAYARAN
            $table->enum('payment_method', ['none', 'cash', 'online'])
                ->default('none');

            // 🔗 REFERENSI MIDTRANS
            $table->string('payment_ref')->nullable();

            $table->decimal('total_price', 10, 2);

            $table->dateTime('payment_date')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
