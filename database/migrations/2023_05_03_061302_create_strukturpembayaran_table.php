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
        Schema::create('strukturpembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_transaksi');
            $table->foreignId('tiket_id')
                ->constrained('tikets');
            $table->foreignId('harga_tiket_id')
                ->constrained('harga_tikets');
            $table->foreignId('keranjang_id')
                ->constrained('keranjang');
            $table->date('tanggal');
            $table->string('pembayaran');
            $table->string('nomor_virtual_account');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('strukturpembayaran');
    }
};