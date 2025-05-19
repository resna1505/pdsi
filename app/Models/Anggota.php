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
        'jumlah_materi'
    ];

    public function iurans()
    {
        return $this->hasMany(IuranAnggota::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
}
