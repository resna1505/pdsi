<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Practice extends Model
{
    use HasFactory;

    protected $fillable = [
        'anggota_id',
        'institution_name',
        'position',
        'department',
        'practice_type',
        'status',
        'start_date',
        'end_date',
        'schedule',
        'phone',
        'address',
        'city',
        'province',
        'description',
        'license_number'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'schedule' => 'array'
    ];

    /**
     * Relationship dengan model Anggota
     */
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    /**
     * Accessor untuk mendapatkan periode praktik
     */
    public function getPeriodAttribute()
    {
        $start = $this->start_date ? $this->start_date->format('M Y') : '';
        $end = $this->end_date ? $this->end_date->format('M Y') : 'Sekarang';

        return $start . ($end ? ' - ' . $end : '');
    }

    /**
     * Accessor untuk status badge class
     */
    public function getStatusBadgeClassAttribute()
    {
        return match ($this->status) {
            'active' => 'text-primary bg-primary-subtle',
            'inactive' => 'text-warning bg-warning-subtle',
            'terminated' => 'text-info bg-info-subtle',
            default => 'text-secondary bg-secondary-subtle'
        };
    }

    /**
     * Accessor untuk status label
     */
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'active' => 'Tersedia',
            'inactive' => 'Tidak Aktif',
            'terminated' => 'Praktik Berakhir',
            default => 'Unknown'
        };
    }

    /**
     * Accessor untuk practice type label
     */
    public function getPracticeTypeLabelAttribute()
    {
        return match ($this->practice_type) {
            'hospital' => 'Rumah Sakit',
            'clinic' => 'Klinik',
            'private' => 'Praktik Pribadi',
            'government' => 'Pemerintah',
            'other' => 'Lainnya',
            default => 'Unknown'
        };
    }

    /**
     * Accessor untuk last update (berdasarkan updated_at)
     */
    public function getLastUpdateAttribute()
    {
        return Carbon::parse($this->updated_at)->diffForHumans();
    }

    /**
     * Accessor untuk full address
     */
    public function getFullAddressAttribute()
    {
        $parts = array_filter([$this->address, $this->city, $this->province]);
        return implode(', ', $parts);
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk filter berdasarkan anggota
     */
    public function scopeByAnggota($query, $anggotaId)
    {
        return $query->where('anggota_id', $anggotaId);
    }

    /**
     * Scope untuk praktik aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
