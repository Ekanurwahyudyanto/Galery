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
        Schema::create('keranjang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('harga_tiket_id')
            ->constrained('harga_tikets');
            $table->string('harga');
            $table->foreignId('tiket_id')
            ->constrained('tikets');
            $table->double('total');
            $table->string('jumlh_tiket');
            $table->date('tanggal_pembelian');
            $table->string('Seat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};
