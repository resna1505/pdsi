<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'noktp',
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
        'facebook_url',
        'instagram_url',
    ];

    // Method untuk menghitung persentase
    public function getProfilePercentage()
    {
        // Field wajib yang harus diisi
        $requiredFields = [
            'nama',
            'noktp',
            'tempat_lahir',
            'tanggal_lahir',
            'email',
            'linkedin_url',
            'twitter_url',
            'facebook_url',
            'instagram_url',
            'no_hp',
            'alamat',
            'spesialis',
            'kota',
            'provinsi',
            'profesi',
            'avatar'
        ];

        $filledFields = 0;
        foreach ($requiredFields as $field) {
            if (!empty($this->$field)) {
                $filledFields++;
            }
        }

        return round(($filledFields / count($requiredFields)) * 100);
    }

    // Method untuk warna progress bar
    public function getProgressColor()
    {
        $percentage = $this->getProfilePercentage();

        if ($percentage >= 80) return 'bg-success';
        if ($percentage >= 60) return 'bg-warning';
        if ($percentage >= 40) return 'bg-info';
        return 'bg-danger';
    }

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

    public function educations()
    {
        return $this->hasMany(Education::class, 'anggota_id');
    }

    /**
     * Relationship dengan Practice
     */
    public function practices()
    {
        return $this->hasMany(Practice::class, 'anggota_id');
    }

    /**
     * Get active practices only
     */
    public function activePractices()
    {
        return $this->hasMany(Practice::class, 'anggota_id')->where('status', 'active');
    }

    /**
     * Get completed educations only
     */
    public function completedEducations()
    {
        return $this->hasMany(Education::class, 'anggota_id')->where('status', 'completed');
    }
}
