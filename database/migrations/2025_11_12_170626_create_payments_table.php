<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // 🔗 Relasi ke booking
            $table->foreignId('booking_id')
                ->constrained('bookings')
                ->cascadeOnDelete();

            // 💳 Metode pembayaran
            $table->enum('method', ['cash', 'online']);

            // 💰 Jumlah dibayar (WAJIB > 0)
            $table->decimal('amount', 12, 2);

            // 📌 Status pembayaran
            $table->enum('status', ['pending', 'completed', 'failed'])
                ->default('pending');

            // 🔐 Referensi Midtrans (order_id)
            $table->string('reference')->nullable()->unique();

            // 📝 Catatan
            $table->text('notes')->nullable();

            // 🕒 Waktu pembayaran sukses
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
