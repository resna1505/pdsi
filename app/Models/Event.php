<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'start_time',
        'end_time',
        'location',
        'category',
        'all_day'
    ];

    protected $casts = [
        'start_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'all_day' => 'boolean'
    ];

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
            return $this->start_date->addDay()->format('Y-m-d');
        }
        return $this->start_date->format('Y-m-d') . 'T' . $this->end_time->format('H:i:s');
    }

    // Format untuk upcoming events
    public function getFormattedStartDateAttribute()
    {
        return $this->start_date->format('M d, Y');
    }

    public function getFormattedTimeAttribute()
    {
        if ($this->all_day) {
            return 'All Day';
        }
        return $this->start_time->format('h:i A') . ' - ' . $this->end_time->format('h:i A');
    }
}
