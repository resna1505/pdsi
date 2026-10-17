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
        'logo',
        'ringkasan',
        'filosofi',
        'arti_lambang',
        'visi',
        'misi',
        'tujuan',
        'slogan',
        'nilai_dasar',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Syarat dokumen pendaftaran anggota perhimpunan (sesuai form register).
     */
    public function syaratDokumen(): array
    {
        $syarat = ['STR masih aktif', 'SIP', 'Serkom'];
        if ($this->singkatan === 'PDSKKSI') {
            $syarat[] = 'SERPENG (Sp.KKLP)';
        }

        return array_merge($syarat, ['Ijazah Dokter', 'CV']);
    }

    public function getLogoUrlAttribute(): ?string
    {
        if (!$this->logo) {
            return null;
        }

        // Logo bawaan (build/...) atau hasil upload admin (storage/images/perhimpunan)
        return str_contains($this->logo, '/')
            ? asset($this->logo)
            : asset('storage/images/perhimpunan/' . $this->logo);
    }

    /**
     * Misi sebagai array (satu poin per baris).
     */
    public function getMisiListAttribute(): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $this->misi))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->all();
    }

    public function getNilaiDasarListAttribute(): array
    {
        return collect(explode(',', (string) $this->nilai_dasar))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->all();
    }

    public function anggotas()
    {
        return $this->hasMany(Anggota::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('urutan')->orderBy('nama');
    }
}
