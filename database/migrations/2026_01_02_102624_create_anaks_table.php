<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anaks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_orangtua')->nullable();
            $table->unsignedBigInteger('id_nakes')->nullable();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->integer('umur');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('domisili')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_orangtua')->references('id_orangtua')->on('orangtua')->onDelete('set null');
            $table->foreign('id_nakes')->references('id_nakes')->on('nakes')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anaks');
    }
};