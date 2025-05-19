<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mitras', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable(); // Path/location gambar
            $table->string('title'); // Nama mitra (contoh: "Universitas Indonesia")
            $table->string('telephone'); // Nomor telepon
            $table->string('email'); // Alamat email
            $table->text('address')->nullable(); // Alamat lengkap
            $table->string('type')->nullable(); // Jenis mitra (contoh: "Rumah Sakit", "Universitas")
            $table->string('website')->nullable(); // URL website
            $table->boolean('is_active')->default(true); // Status aktif/tidak
            $table->integer('order_column')->default(0); // Untuk sorting
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitras');
    }
};
