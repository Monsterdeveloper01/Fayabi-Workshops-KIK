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
    Schema::table('users', function (Blueprint $table) {
        $table->string('recipient_name')->nullable()->after('email'); // Nama Penerima
        $table->string('phone_number')->nullable()->after('recipient_name'); // No HP
        $table->text('address_line')->nullable()->after('phone_number'); // Alamat Jalan
        $table->string('city')->nullable()->after('address_line');
        $table->string('province')->nullable()->after('city');
        $table->string('postal_code')->nullable()->after('province');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['recipient_name', 'phone_number', 'address_line', 'city', 'province', 'postal_code']);
    });
}
};
