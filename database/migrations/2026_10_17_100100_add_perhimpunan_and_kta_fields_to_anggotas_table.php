<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('anggotas', function (Blueprint $table) {
            $table->foreignId('perhimpunan_id')->nullable()->after('user_id')
                ->constrained('perhimpunans')->nullOnDelete();

            // Dokumen persyaratan (opsional, untuk dokter yang memiliki STR/SIP)
            $table->string('no_str')->nullable();
            $table->date('str_berlaku_sampai')->nullable();
            $table->string('file_str')->nullable();
            $table->string('file_sip')->nullable();
            $table->string('file_serkom')->nullable();
            $table->string('file_serpeng')->nullable();
            $table->string('file_ijazah')->nullable();
            $table->string('file_cv')->nullable();

            // Status verifikasi: null/pending, approved, rejected
            $table->string('status_verifikasi', 20)->nullable();
            $table->text('alasan_penolakan')->nullable();
            $table->timestamp('tanggal_verifikasi')->nullable();

            // KTA
            $table->date('kta_berlaku_sampai')->nullable();
            $table->string('kta_token', 64)->nullable()->unique();
        });

        // Anggota yang sudah punya nomor kartu: tandai approved, masa berlaku 5 tahun
        // sejak terdaftar, dan buat token QR verifikasi.
        DB::table('anggotas')->whereNotNull('no_kartu_anggota')->orderBy('id')
            ->each(function ($anggota) {
                DB::table('anggotas')->where('id', $anggota->id)->update([
                    'status_verifikasi' => 'approved',
                    'kta_berlaku_sampai' => Carbon::parse($anggota->created_at ?? now())->addYears(5)->toDateString(),
                    'kta_token' => Str::random(40),
                ]);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anggotas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('perhimpunan_id');
            $table->dropUnique(['kta_token']);
            $table->dropColumn([
                'no_str',
                'str_berlaku_sampai',
                'file_str',
                'file_sip',
                'file_serkom',
                'file_serpeng',
                'file_ijazah',
                'file_cv',
                'status_verifikasi',
                'alasan_penolakan',
                'tanggal_verifikasi',
                'kta_berlaku_sampai',
                'kta_token',
            ]);
        });
    }
};
