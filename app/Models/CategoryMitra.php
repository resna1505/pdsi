<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryMitra extends Model
{
    use HasFactory;

    protected $table = 'category_mitras';

    protected $fillable = [
        'name',
        'is_active'
    ];

    public function mitras()
    {
        return $this->hasMany(Mitra::class, 'category_id');
    }
}
