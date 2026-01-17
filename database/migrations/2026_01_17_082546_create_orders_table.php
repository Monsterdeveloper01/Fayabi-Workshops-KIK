<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_orders_table.php
public function up(): void
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('order_number')->unique(); // Contoh: ORD-20240101-001
        $table->decimal('total_price', 15, 2);
        $table->string('status')->default('pending'); // pending, paid, shipped
        $table->string('payment_method'); // qris, va, dll
        $table->string('payment_status')->default('unpaid');
        $table->string('email')->nullable(); // Email pembeli saat checkout
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
