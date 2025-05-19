<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = ['anggota_id', 'testimonial_text', 'rating', 'is_active'];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}
