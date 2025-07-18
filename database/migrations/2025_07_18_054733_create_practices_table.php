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
        Schema::create('practices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('anggotas')->onDelete('cascade');
            $table->string('institution_name'); // Nama RS/Klinik
            $table->string('position')->nullable(); // Posisi/jabatan
            $table->string('department')->nullable(); // Departemen/bagian
            $table->enum('practice_type', ['hospital', 'clinic', 'private', 'government', 'other'])->default('hospital');
            $table->enum('status', ['active', 'inactive', 'terminated'])->default('active');
            $table->date('start_date'); // Tanggal mulai praktik
            $table->date('end_date')->nullable(); // Tanggal berakhir praktik
            $table->json('schedule')->nullable(); // Jadwal praktik (JSON format)
            $table->string('phone')->nullable(); // Telepon tempat praktik
            $table->text('address')->nullable(); // Alamat tempat praktik
            $table->string('city')->nullable(); // Kota
            $table->string('province')->nullable(); // Provinsi
            $table->text('description')->nullable(); // Deskripsi praktik
            $table->string('license_number')->nullable(); // Nomor izin praktik
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practices');
    }
};
