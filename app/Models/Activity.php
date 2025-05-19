<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['title', 'location', 'description'];

    public function photos()
    {
        return $this->hasMany(ActivityPhoto::class);
    }
}
