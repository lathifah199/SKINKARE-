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
        $table->unsignedBigInteger('id_orangtua')->nullable()->after('id');
    });
}

public function down()
{
    Schema::table('anaks', function (Blueprint $table) {
        $table->dropColumn('id_orangtua');
    });
}
};
