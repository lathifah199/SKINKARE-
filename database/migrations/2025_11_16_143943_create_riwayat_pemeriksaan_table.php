<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPemeriksaanTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riwayat_pemeriksaan', function (Blueprint $table) {
            $table->bigIncrements('id_riwayat');
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('id_pemeriksaan');
            $table->unsignedBigInteger('id_hasil');
            $table->timestamps();

            $table->foreign('id')->references('id')->on('anaks')->onDelete('cascade');
            $table->foreign('id_pemeriksaan')->references('id_pemeriksaan')->on('pemeriksaan')->onDelete('cascade');
            $table->foreign('id_hasil')->references('id_hasil')->on('hasil_deteksi')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pemeriksaan');
    }
};
