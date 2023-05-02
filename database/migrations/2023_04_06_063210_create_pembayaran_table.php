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
        Schema::create('Pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tiket_id')
            ->constrained('tikets');
            $table->foreignId('harga_tiket_id')
            ->constrained('harga_tikets');
            $table->foreignId('keranjang_id')
            ->constrained('keranjang');
            $table->date('tanggal_pembelian');
            $table->string('stadiun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Pembayaran');
    }
};