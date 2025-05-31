<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'alamat',
        'spesialis',
        'pengalaman_tahun',
        'jumlah_peserta',
        'jumlah_minat',
        'jumlah_materi',
        'tempat_lahir',
        'tanggal_lahir',
        'kota',
        'provinsi',
        'profesi',
        'ktp',
        'npwp',
        'avatar',
        'user_id',
        'linkedin_url',
        'twitter_url',
        'description',
    ];

    public function iurans()
    {
        return $this->hasMany(IuranAnggota::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    // app/Models/Anggota.php
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
