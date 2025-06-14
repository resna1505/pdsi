<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesWorkshops extends Model
{
    use HasFactory;
    // protected $table = 'categories_workshops';
    protected $fillable = ['name'];
}
