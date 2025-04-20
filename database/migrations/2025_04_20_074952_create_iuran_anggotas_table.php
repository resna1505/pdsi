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
        Schema::create('iuran_anggotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('anggotas')->onDelete('cascade');
            $table->foreignId('master_iuran_id')->constrained('master_iuran_anggotas')->onDelete('cascade');
            $table->integer('status')->default(0); // 0 = info, 1 = payment, 2 = verif, 3 = selesai
            $table->string('bukti_bayar')->nullable(); // path file
            $table->text('keterangan')->nullable();
            $table->dateTime('tanggal_lunas')->nullable();
            $table->foreignId('diverifikasi_oleh')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iuran_anggotas');
    }
};
