<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQrcodeHasilTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('qrcode_hasil', function (Blueprint $table) {
            $table->bigIncrements('id_qrcode');
            $table->unsignedBigInteger('id_hasil');
            $table->string('link_qrcode');
            $table->date('tanggal_generate');
            $table->timestamps();

            $table->foreign('id_hasil')->references('id_hasil')->on('hasil_deteksi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qrcode_hasil');
    }
};
