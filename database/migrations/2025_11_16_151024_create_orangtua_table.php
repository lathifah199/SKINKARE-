<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('orangtua', function (Blueprint $table) {
            $table->id('id_orangtua'); // primary key AUTO INCREMENT
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('kata_sandi');
            $table->string('no_hp')->nullable();
            $table->string('alamat')->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orangtua');
    }
};
