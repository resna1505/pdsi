<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAgenda extends Model
{
    use HasFactory;

    protected $table = 'category_agendas';

    protected $fillable = [
        'name',
        'is_active'
    ];

    public function agenda()
    {
        return $this->hasMany(Agenda::class, 'category_id');
    }
}
