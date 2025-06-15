<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshops extends Model
{
    use HasFactory;
    protected $table = 'workshops';
    protected $fillable = ['title', 'image', 'description', 'price', 'category_id', 'tagline', 'short_description'];

    // public function category()
    // {
    //     return $this->belongsTo(CategoriesWorkshops::class);
    // }

    // public function tags()
    // {
    //     return $this->belongsToMany(Tags::class);
    // }

    // public function ratings()
    // {
    //     return $this->hasMany(Ratings::class);
    // }

    // public function comments()
    // {
    //     return $this->hasMany(Comments::class);
    // }

    // public function properties()
    // {
    //     return $this->hasMany(Workshop_properties::class);
    // }

    // public function averageRating()
    // {
    //     return $this->ratings()->avg('stars');
    // }
}
