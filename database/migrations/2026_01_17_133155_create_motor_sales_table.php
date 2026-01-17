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
    Schema::create('motor_sales', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('brand');
        $table->string('model');
        $table->year('year');
        $table->integer('mileage');
        $table->text('description');
        $table->string('image'); // Path foto motor
        $table->bigInteger('price_offer');
        $table->string('whatsapp');
        $table->string('status')->default('pending'); // pending, reviewed, sold
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motor_sales');
    }
};
