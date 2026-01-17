<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('service_bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('service_type'); // cuci, servis, atau modifikasi
        $table->string('nama');
        $table->string('whatsapp');
        
        // Data Motor (Nullable karena Cuci & Servis/Modif punya input beda)
        $table->string('motor_brand')->nullable(); // Untuk Servis/Modif
        $table->string('motor_model')->nullable(); // Untuk Servis/Modif
        $table->string('motor_size')->nullable();  // Untuk Cuci (small/medium/large)
        
        // Detail Jasa
        $table->string('package_name'); // Paket Cuci / Jenis Service
        $table->date('booking_date');
        $table->time('booking_time')->nullable(); // Khusus Cuci
        $table->bigInteger('budget')->nullable(); // Khusus Modifikasi
        
        $table->text('notes')->nullable();
        $table->string('status')->default('pending'); // pending, process, completed, cancelled
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_bookings');
    }
};
