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
        Schema::create('harga_tikets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tiket_id')
            ->constrained('tikets');
            $table->double('harga');
            $table->foreignId('jenis_tiket_id')
            ->constrained('jenis_tikets');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harga_tikets');
    }
};
