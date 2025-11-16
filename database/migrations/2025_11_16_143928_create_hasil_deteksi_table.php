<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilDeteksiTable extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_deteksi', function (Blueprint $table) {
            $table->bigIncrements('id_hasil');
            $table->unsignedBigInteger('id_pemeriksaan');
            $table->string('status_stunting', 50);
            $table->text('rekomendasi_pencegahan');
            $table->timestamps();

            $table->foreign('id_pemeriksaan')->references('id_pemeriksaan')->on('pemeriksaan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_deteksi');
    }
};
