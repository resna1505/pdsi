<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Struktur extends Model
{
    use HasFactory;

    protected $table = 'struktur';

    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
