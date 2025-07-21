<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $table = 'testimonials';

    protected $fillable = [
        'anggota_id',
        'testimonial_text',
        'rating',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'rating' => 'integer',
    ];

    // Relationship dengan User/Anggota (optional - jika ada)
    // public function anggota()
    // {
    //     return $this->belongsTo(User::class, 'anggota_id');
    // }
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}
