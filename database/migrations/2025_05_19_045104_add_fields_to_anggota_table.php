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
            $table->string('spesialis');
            $table->integer('pengalaman_tahun');
            $table->integer('jumlah_peserta');
            $table->integer('jumlah_minat');
            $table->integer('jumlah_materi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anggota', function (Blueprint $table) {
            $table->dropColumn(['spesialis', 'pengalaman_tahun', 'jumlah_peserta', 'jumlah_minat', 'jumlah_materi']);
        });
    }
};
