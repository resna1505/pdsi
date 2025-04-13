<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(false);
            $table->string('email')->unique();
            $table->string('name');
            $table->string('level')->default('Dokter');
            $table->string('tempat_lahir');
            $table->timestamp('tanggal_lahir');
            $table->string('no_hp');
            $table->string('alamat');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('profesi');
            $table->text('ktp');
            $table->text('npwp');
            $table->text('avatar');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        User::create([
            'email' => 'admin@ictpdsi.com', // Email sebaiknya lowercase
            'name' => 'Admin ICT PDSI',
            'level' => 'Admin',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01 00:00:00', // Format timestamp yang valid
            'no_hp' => '08123456789',
            'alamat' => 'Kantor ICT PDSI',
            'kota' => 'Jakarta',
            'provinsi' => 'DKI Jakarta',
            'profesi' => 'Administrator',
            'ktp' => '1234567890123456',
            'npwp' => '01.234.567.8-912.345',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(), // Gunakan now() untuk timestamp saat ini
            'avatar' => 'avatar-1.jpg',
            'remember_token' => bin2hex(random_bytes(20)),
            'created_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('level');
        });
    }
};
