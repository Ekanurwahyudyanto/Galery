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
        Schema::create('tim_persik', function (Blueprint $table) {
            $table->integer('id');
            $table->string('nama');
            $table->string('keterangan');
            $table->string('kewarganegaraan');
            $table->boolean('is_aktif');
            $table->string('url_logo');
            $table->string('pemain');
            $table->string('posisi_pemain');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tim_persik');
    }
};
