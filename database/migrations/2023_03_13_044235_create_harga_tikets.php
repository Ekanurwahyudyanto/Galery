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
            $table->integer('id');
            $table->integer('tiket_id')->nullable()->tikets('id');
            $table->double('harga');
            $table->integer('jenis_tiket_id')->nullable()->jenis_tikets('id');
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
