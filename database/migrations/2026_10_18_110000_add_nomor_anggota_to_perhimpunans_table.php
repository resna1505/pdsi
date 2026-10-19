<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Penomoran kartu anggota per perhimpunan (awalan + nomor urut),
     * dan nama baru PDSKKSI.
     */
    public function up(): void
    {
        Schema::table('perhimpunans', function (Blueprint $table) {
            // Kosong = anggota perhimpunan memakai nomor PDSI (17 digit berbasis provinsi)
            $table->string('prefix_nomor', 30)->nullable();
            // Nomor urut pertama yang dibuat sistem
            $table->unsignedInteger('nomor_mulai')->default(1);
        });

        // 08192704221001 - 08192704221020 sudah dibagikan manual, sistem mulai dari 1021
        DB::table('perhimpunans')->where('singkatan', 'PDSKKSI')->update([
            'nama' => 'Perhimpunan Dokter Spesialis Kedokteran Keluarga Seluruh Indonesia',
            'prefix_nomor' => '0819270422',
            'nomor_mulai' => 1021,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('perhimpunans')->where('singkatan', 'PDSKKSI')->update([
            'nama' => 'Perhimpunan Dokter Spesialis Kedokteran Keluarga Layanan Primer Seluruh Indonesia',
        ]);

        Schema::table('perhimpunans', function (Blueprint $table) {
            $table->dropColumn(['prefix_nomor', 'nomor_mulai']);
        });
    }
};
