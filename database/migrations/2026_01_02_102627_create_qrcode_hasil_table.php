<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qrcode_hasil', function (Blueprint $table) {
            $table->id('id_qrcode');
            $table->unsignedBigInteger('id_hasil');
            $table->string('link_qrcode');
            $table->date('tanggal_generate');
            $table->timestamps();

            // Foreign key
            $table->foreign('id_hasil')->references('id_hasil')->on('hasil_deteksi')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qrcode_hasil');
    }
};