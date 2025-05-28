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
        Schema::table('anggotas', function (Blueprint $table) {
            $table->integer('pengalaman_tahun')->nullable()->change();
            $table->integer('jumlah_peserta')->nullable()->change();
            $table->integer('jumlah_minat')->nullable()->change();
            $table->integer('jumlah_materi')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anggotas', function (Blueprint $table) {
            $table->integer('pengalaman_tahun')->nullable(false)->change();
            $table->integer('jumlah_peserta')->nullable(false)->change();
            $table->integer('jumlah_minat')->nullable(false)->change();
            $table->integer('jumlah_materi')->nullable(false)->change();
        });
    }
};
