<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('transaksis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->integer('total_harga');
        $table->string('metode_bayar')->default('Transfer Bank');
        $table->string('metode_kirim')->default('Ambil Sendiri');
        $table->json('items'); 
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
