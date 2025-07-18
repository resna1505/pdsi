<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'sub_title',
        'image',
        'title_banner',
        'sub_title_banner',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
