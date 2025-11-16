<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaanTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemeriksaan', function (Blueprint $table) {
            $table->bigIncrements('id_pemeriksaan');
            $table->unsignedBigInteger('id');
            $table->date('tanggal_pemeriksaan');
            $table->integer('tinggi_badan');
            $table->integer('berat_badan');
            $table->enum('metode_input', ['manual', 'otomatis']);
            $table->timestamps();

            $table->foreign('id')->references('id')->on('anaks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan');
    }
};
