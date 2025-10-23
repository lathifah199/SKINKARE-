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
        $table->string('nama');
        $table->enum('jenis_kelamin', ['L', 'P']);
        $table->integer('umur');
        $table->string('tempat_lahir')->nullable();
        $table->date('tanggal_lahir')->nullable();
        $table->decimal('tinggi_badan', 5, 2)->nullable();
        $table->decimal('berat_badan', 5, 2)->nullable();
        $table->string('hasil_deteksi')->nullable();
        $table->string('nama_wali')->nullable();
        $table->text('alamat')->nullable();
        $table->string('foto')->nullable();
        $table->timestamps();
    });
}
};
