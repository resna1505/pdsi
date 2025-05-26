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
        Schema::table('agendas', function (Blueprint $table) {
            $table->dropForeign(['category_id']); // drop foreign lama
            $table->foreign('category_id')->references('id')->on('category_agendas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->dropForeign(['category_id']); // rollback foreign ke sebelumnya
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }
};
