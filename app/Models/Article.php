<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'category_id',
        'video_url',
        'attachment',
        'description',
        'created_at',
        'updated_at',
    ];

    // protected $casts = [
    //     'is_active' => 'boolean'
    // ];

    // // Scope untuk mitra aktif
    // public function scopeActive($query)
    // {
    //     return $query->where('is_active', true);
    // }

    // Scope untuk diurutkan
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
