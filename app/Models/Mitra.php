<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'telephone',
        'email',
        'address',
        'type',
        'website',
        'is_active',
        'order_column',
        'category_id',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Scope untuk mitra aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk diurutkan
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_column');
    }

    // Accessor untuk gambar
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/default-mitra.png');
    }
}
