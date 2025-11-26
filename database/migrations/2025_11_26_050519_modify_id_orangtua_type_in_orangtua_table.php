<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orangtua', function (Blueprint $table) {
            $table->unsignedBigInteger('id_orangtua')->change();
        });
    }

    public function down(): void
    {
        Schema::table('orangtua', function (Blueprint $table) {
            $table->integer('id_orangtua')->change();
        });
    }
};