<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metode', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tiket_id')
            ->constrained('tikets');
            $table->foreignId('keranjang_id')
            ->constrained('keranjang');
            $table->string('logo1');
            $table->string('logo2');
            $table->string('logo3');
            $table->string('logo4');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metode');
    }
};
