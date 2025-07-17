<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'anggota_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'location',
        'category',
        'all_day',
        'agenda_id'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'all_day' => 'integer'
    ];

    public function getAllDayTextAttribute()
    {
        if ($this->all_day == 0) {
            return 'Same day event';
        } elseif ($this->all_day == 1) {
            return '1 day event';
        } else {
            return $this->all_day . ' days event';
        }
    }

    // Scope untuk filter event berdasarkan durasi
    public function scopeSameDay($query)
    {
        return $query->where('all_day', 0);
    }

    public function scopeMultiDay($query)
    {
        return $query->where('all_day', '>', 0);
    }

    // Relationship dengan User melalui Anggota
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    // Accessor untuk FullCalendar format
    public function getStartAttribute()
    {
        if ($this->all_day) {
            return $this->start_date->format('Y-m-d');
        }
        return $this->start_date->format('Y-m-d') . 'T' . $this->start_time->format('H:i:s');
    }

    public function getEndAttribute()
    {
        if ($this->all_day) {
            // Untuk all day events, jika ada end_date gunakan itu, jika tidak tambah 1 hari
            if ($this->end_date) {
                return $this->end_date->addDay()->format('Y-m-d');
            }
            return $this->start_date->addDay()->format('Y-m-d');
        }

        // Untuk timed events
        $endDate = $this->end_date ?? $this->start_date;
        return $endDate->format('Y-m-d') . 'T' . $this->end_time->format('H:i:s');
    }

    // Format untuk upcoming events
    public function getFormattedStartDateAttribute()
    {
        return $this->start_date->format('M d, Y');
    }

    public function getFormattedTimeAttribute()
    {
        if ($this->all_day) {
            if ($this->end_date && $this->end_date->ne($this->start_date)) {
                return 'All Day (' . $this->start_date->format('M d') . ' - ' . $this->end_date->format('M d') . ')';
            }
            return 'All Day';
        }
        return $this->start_time->format('h:i A') . ' - ' . $this->end_time->format('h:i A');
    }

    // Scope untuk filter berdasarkan user
    // Scope untuk filter berdasarkan user - REVISI
    public function scopeForUser($query, $anggotaId)
    {
        return $query->where(function ($q) use ($anggotaId) {
            $q->where('anggota_id', $anggotaId)
                ->orWhereNull('anggota_id');
        });
    }
}
