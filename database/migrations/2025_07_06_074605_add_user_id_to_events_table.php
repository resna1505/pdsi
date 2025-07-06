<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('anggota_id')->after('id');
            $table->foreign('anggota_id')->references('id')->on('anggotas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['anggota_id']);
            $table->dropColumn('anggota_id');
        });
    }
};
