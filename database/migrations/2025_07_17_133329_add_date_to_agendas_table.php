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
        Schema::table('agendas', function (Blueprint $table) {
            $table->datetime('dimulai')->nullable();
            $table->datetime('berakhir')->nullable(); // VARCHAR default panjang 255 karakter
        });
    }

    public function down()
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->dropColumn(['dimulai', 'berakhir']);
        });
    }
};
