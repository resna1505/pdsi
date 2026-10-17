<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('perhimpunans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('singkatan', 50);
            // Desain KTA khusus perhimpunan, kosong = pakai desain default
            $table->string('kta_depan')->nullable();
            $table->string('kta_belakang')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });

        $data = [
            ['Perhimpunan Dokter Spesialis Anak Seluruh Indonesia', 'PDSASI'],
            ['Perhimpunan Dokter Spesialis Penyakit Dalam Indonesia', 'PDSPDSI'],
            ['Perkumpulan Obstetri dan Ginekologi Seluruh Indonesia', 'PDSOGSI'],
            ['Perhimpunan Dokter Spesialis Bedah Seluruh Indonesia', 'PDSBSI'],
            ['Perhimpunan Dokter Spesialis Anestesiologi dan Terapi Intensif Seluruh Indonesia', 'PDSATISI'],
            ['Perhimpunan Dokter Spesialis Jantung dan Pembuluh Darah Seluruh Indonesia', 'PDSKSI'],
            ['Perhimpunan Dokter Spesialis Saraf Seluruh Indonesia', 'PDSSI'],
            ['Perhimpunan Dokter Spesialis Paru Seluruh Indonesia', 'PDSPSI'],
            ['Perhimpunan Dokter Spesialis Kulit dan Kelamin Seluruh Indonesia', 'PDSDOSKSI'],
            ['Perhimpunan Dokter Spesialis Mata Seluruh Indonesia', 'PDSMSI'],
            ['Perhimpunan Telinga Hidung Tenggorok Bedah Kepala Leher Seluruh Indonesia', 'PDSTHTKLSI'],
            ['Perhimpunan Dokter Spesialis Radiologi Seluruh Indonesia', 'PDSRSI'],
            ['Perhimpunan Dokter Spesialis Patologi Anatomik Seluruh Indonesia', 'PDSPASI'],
            ['Perhimpunan Dokter Spesialis Patologi Klinik Seluruh Indonesia', 'PDSPKSI'],
            ['Perhimpunan Dokter Spesialis Kedokteran Jiwa Seluruh Indonesia', 'PDSKJSI'],
            ['Perhimpunan Dokter Spesialis Urologi Seluruh Indonesia', 'PDSUSI'],
            ['Perhimpunan Dokter Spesialis Orthopaedi dan Traumatologi Seluruh Indonesia', 'PDSOTSI'],
            ['Perhimpunan Dokter Spesialis Bedah Saraf Seluruh Indonesia', 'PDSBSSI'],
            ['Perhimpunan Dokter Spesialis Bedah Plastik, Rekonstruksi dan Estetik Seluruh Indonesia', 'PDSBPRESI'],
            ['Perhimpunan Dokter Spesialis Kedokteran Fisik dan Rehabilitasi Seluruh Indonesia', 'PDSKFRSI'],
            ['Perhimpunan Dokter Spesialis Kedokteran Forensik dan Medikolegal Seluruh Indonesia', 'PDSFMSI'],
            ['Perhimpunan Dokter Spesialis Mikrobiologi Klinik Seluruh Indonesia', 'PDSMKSI'],
            ['Perhimpunan Dokter Spesialis Kedokteran Okupasi Indonesia', 'PDSOSI'],
            ['Perhimpunan Dokter Spesialis Kedokteran Olahraga Seluruh Indonesia', 'PDSKOSI'],
            ['Perhimpunan Dokter Spesialis Kedokteran Penerbangan Seluruh Indonesia', 'PDSKPSI'],
            ['Perhimpunan Dokter Spesialis Parasitologi Klinik Seluruh Indonesia', 'PDSPAKSI'],
            ['Perhimpunan Dokter Spesialis Kedokteran Nuklir dan Teranostik Molekuler Seluruh Indonesia', 'PDSKNTMSI'],
            ['Perhimpunan Dokter Spesialis Gizi Klinik Seluruh Indonesia', 'PDSGKSI'],
            ['Perhimpunan Dokter Spesialis Bedah Toraks, Kardiak dan Vaskular Seluruh Indonesia', 'PDSBTKVSI'],
            ['Perhimpunan Dokter Spesialis Bedah Anak Seluruh Indonesia', 'PDSBASI'],
            ['Perhimpunan Dokter Spesialis Emergensi Seluruh Indonesia', 'PDSEMSI'],
            ['Perhimpunan Reumatologi Seluruh Indonesia', 'PDSRSI'],
            ['Perhimpunan Nefrologi Seluruh Indonesia', 'PDSNSI'],
            ['Perhimpunan Dokter Spesialis Bedah Onkologi Seluruh Indonesia', 'PDSBOSI'],
            ['Perhimpunan Spesialis Bedah Vaskular dan Endovaskular Seluruh Indonesia', 'PDSBVESI'],
            ['Perhimpunan Dokter Spesialis Farmakologi Klinik Seluruh Indonesia', 'PDSFKSI'],
            ['Perhimpunan Dokter Spesialis Andrologi Seluruh Indonesia', 'PDSANSI'],
            ['Perhimpunan Dokter Spesialis Akupunktur Medik Seluruh Indonesia', 'PDSAKMSI'],
            ['Perhimpunan Dokter Umum Indonesia Seluruh Indonesia', 'PDUSI'],
            ['Perhimpunan Dokter Spesialis Kedokteran Keluarga Layanan Primer Seluruh Indonesia', 'PDSKKSI'],
            ['Perhimpunan Dokter Spesialis Kedokteran Kelautan Seluruh Indonesia', 'PDSKLSI'],
        ];

        $now = now();
        DB::table('perhimpunans')->insert(array_map(fn ($row, $i) => [
            'nama' => $row[0],
            'singkatan' => $row[1],
            'is_active' => true,
            'urutan' => $i + 1,
            'created_at' => $now,
            'updated_at' => $now,
        ], $data, array_keys($data)));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perhimpunans');
    }
};
