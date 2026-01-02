<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_deteksi', function (Blueprint $table) {
            $table->id('id_hasil');
            $table->unsignedBigInteger('id')->nullable();
            $table->unsignedBigInteger('id_pemeriksaan');
            $table->string('status_prediksi', 100)->nullable();
            $table->float('zscore')->nullable();
            $table->float('risiko_persen')->nullable();
            $table->string('kategori_risiko', 100)->nullable();
            $table->string('warna_risiko', 20)->nullable();
            $table->text('hasil')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('id')->references('id')->on('anaks')->onDelete('cascade');
            $table->foreign('id_pemeriksaan')->references('id_pemeriksaan')->on('pemeriksaan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_deteksi');
    }
};