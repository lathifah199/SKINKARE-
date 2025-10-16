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
    Schema::create('anaks', function (Blueprint $table) {
        $table->id();
        $table->string('nama_lengkap');
        $table->string('jenis_kelamin');
        $table->integer('umur'); // dalam bulan
        $table->string('ttl'); // tempat, tanggal lahir
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anaks');
    }
};
