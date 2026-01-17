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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Siapa Vendornya?
        $table->foreignId('category_id')->constrained(); // Masuk kategori apa?
        
        $table->string('name');
        $table->string('slug')->unique();
        $table->string('brand')->nullable(); // Merek: RCB, AHM, dll
        $table->integer('price');
        $table->integer('stock')->default(1);
        $table->integer('weight')->default(1000); // Dalam gram
        $table->enum('condition', ['baru', 'bekas'])->default('baru');
        
        $table->text('description'); // Penjelasan panjang
        $table->string('image')->nullable(); // Foto produk
        
        // Fitur Spesial: Kompatibilitas (Misal: Bisa buat Vario, Beat)
        $table->string('compatibility')->nullable(); 
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
