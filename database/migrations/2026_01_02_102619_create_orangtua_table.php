<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orangtua', function (Blueprint $table) {
            $table->id('id_orangtua');
            $table->string('nama');
            $table->string('email')->unique()->nullable();
            $table->string('kata_sandi')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('domisili')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orangtua');
    }
};