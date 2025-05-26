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
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Accessor untuk gambar
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/default-mitra.png');
    }
}
