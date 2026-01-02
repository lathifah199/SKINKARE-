<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nakes', function (Blueprint $table) {
            $table->id('id_nakes');
            $table->string('nama_lengkap');
            $table->string('kata_sandi');
            $table->string('nomor_hp');
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nakes');
    }
};