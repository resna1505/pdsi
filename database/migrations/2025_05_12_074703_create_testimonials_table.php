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
        if (!Schema::hasTable('testimonials')) {
            Schema::create('testimonials', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('anggota_id');
                $table->text('testimonial_text');
                $table->tinyInteger('rating')->default(5);
                $table->boolean('is_active')->default(true);
                $table->timestamps();

                $table->foreign('anggota_id')->references('id')->on('anggotas')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
