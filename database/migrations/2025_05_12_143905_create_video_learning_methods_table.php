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
        Schema::create('video_learning_method', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_id')->constrained()->onDelete('cascade');
            $table->foreignId('learning_method_id')->constrained()->onDelete('cascade');
            $table->integer('progress')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_learning_methods');
    }
};
