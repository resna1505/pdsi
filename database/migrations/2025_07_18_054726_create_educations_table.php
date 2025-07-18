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
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('anggotas')->onDelete('cascade');
            $table->string('institution_name'); // Nama universitas/institusi
            $table->string('degree_type'); // S1 Kedokteran, Sp.PD, dll
            $table->string('major')->nullable(); // Jurusan/bidang studi
            $table->year('start_year'); // Tahun mulai
            $table->year('end_year')->nullable(); // Tahun selesai
            $table->enum('status', ['completed', 'progress', 'dropped'])->default('progress');
            $table->string('institution_logo')->nullable(); // Path logo institusi
            $table->text('description')->nullable(); // Deskripsi tambahan
            $table->string('certificate_number')->nullable(); // Nomor sertifikat/ijazah
            $table->date('graduation_date')->nullable(); // Tanggal wisuda
            $table->decimal('gpa', 3, 2)->nullable(); // IPK
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
