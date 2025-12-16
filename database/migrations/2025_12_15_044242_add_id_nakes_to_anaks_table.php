<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('anaks', function (Blueprint $table) {
        $table->unsignedBigInteger('id_nakes')
              ->nullable()
              ->after('id_orangtua');

        $table->foreign('id_nakes')
              ->references('id_nakes')
              ->on('nakes')
              ->nullOnDelete();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anaks', function (Blueprint $table) {
            //
        });
    }
};
