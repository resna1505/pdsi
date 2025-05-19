<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    // app/Models/Video.php
    public function learningMethods()
    {
        return $this->belongsToMany(LearningMethod::class, 'video_learning_method')
            ->withPivot('progress')
            ->withTimestamps();
    }
}
