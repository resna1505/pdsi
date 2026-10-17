<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perhimpunan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'singkatan',
        'kta_depan',
        'kta_belakang',
        'is_active',
        'urutan',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function anggotas()
    {
        return $this->hasMany(Anggota::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('urutan')->orderBy('nama');
    }
}
