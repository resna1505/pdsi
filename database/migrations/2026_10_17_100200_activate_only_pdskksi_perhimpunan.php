<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Tahap awal: hanya PDSKKSI yang tampil di form register.
     * Perhimpunan lain bisa diaktifkan admin lewat menu Perhimpunan.
     */
    public function up(): void
    {
        DB::table('perhimpunans')->where('singkatan', '!=', 'PDSKKSI')->update(['is_active' => false]);
        DB::table('perhimpunans')->where('singkatan', 'PDSKKSI')->update(['is_active' => true]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('perhimpunans')->update(['is_active' => true]);
    }
};
