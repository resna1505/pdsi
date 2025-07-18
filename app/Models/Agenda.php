<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'video_url',
        'attachment',
        'description',
        'created_at',
        'updated_at',
        'category_id',
        'dimulai',
        'berakhir',
        'location',
    ];

    protected $casts = [
        'dimulai' => 'datetime',
        'berakhir' => 'datetime',
    ];

    public function event()
    {
        return $this->hasOne(Event::class, 'anggota_id');
    }

    public function getDurationAttribute()
    {
        if ($this->dimulai && $this->berakhir) {
            $diff = $this->dimulai->diff($this->berakhir);
            return $diff->days;
        }
        return 0;
    }

    public function scopeToday($query)
    {
        return $query->whereDate('dimulai', today());
    }

    public function scopeUpcoming($query)
    {
        return $query->where('dimulai', '>', now());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('dimulai', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Accessor untuk gambar
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/default-mitra.png');
    }

    public function category()
    {
        return $this->belongsTo(CategoryAgenda::class, 'category_id');
    }

    public function getDateAttribute()
    {
        return $this->dimulai ? $this->dimulai->format('Y-m-d') : null;
    }
}
