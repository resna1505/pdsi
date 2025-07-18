<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';

    protected $fillable = [
        'anggota_id',
        'institution_name',
        'degree_type',
        'major',
        'start_year',
        'end_year',
        'status',
        'institution_logo',
        'description',
        'certificate_number',
        'graduation_date',
        'gpa'
    ];

    protected $casts = [
        'graduation_date' => 'date',
        'gpa' => 'decimal:2'
    ];

    /**
     * Relationship dengan model Anggota
     */
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    /**
     * Accessor untuk mendapatkan periode pendidikan
     */
    public function getPeriodAttribute()
    {
        if ($this->end_year) {
            return $this->start_year . '-' . $this->end_year;
        }
        return $this->start_year . ' - Sekarang';
    }

    /**
     * Accessor untuk status badge class
     */
    public function getStatusBadgeClassAttribute()
    {
        return match ($this->status) {
            'completed' => 'text-success bg-success-subtle',
            'progress' => 'text-primary bg-primary-subtle',
            'dropped' => 'text-danger bg-danger-subtle',
            default => 'text-secondary bg-secondary-subtle'
        };
    }

    /**
     * Accessor untuk status label
     */
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'completed' => 'Completed',
            'progress' => 'Progress',
            'dropped' => 'Dropped',
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
}
