<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemeriksaan', function (Blueprint $table) {
            $table->id('id_pemeriksaan');
            $table->unsignedBigInteger('id');
            $table->date('tanggal_pemeriksaan');
            $table->integer('tinggi_badan');
            $table->integer('berat_badan')->nullable();
            $table->enum('metode_input', ['manual', 'otomatis']);
            $table->timestamps();

            // Foreign key
            $table->foreign('id')->references('id')->on('anaks')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan');
    }
};