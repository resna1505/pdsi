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
        Schema::create('master_iuran_anggotas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_iuran');
            $table->decimal('jumlah', 12, 2);
            $table->date('periode'); // bisa tanggal atau hanya bulan-tahun
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_iuran_anggotas');
    }
};
