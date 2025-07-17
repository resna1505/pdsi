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
        Schema::table('workshops', function (Blueprint $table) {
            $table->string('assign')->nullable(); // VARCHAR default panjang 255 karakter
        });
    }

    public function down()
    {
        Schema::table('workshops', function (Blueprint $table) {
            $table->dropColumn('assign');
        });
    }
};
