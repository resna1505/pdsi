<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningMethod extends Model
{
    use HasFactory;

    public function videos()
    {
        return $this->belongsToMany(Video::class, 'video_learning_method')
            ->withPivot('progress')
            ->withTimestamps();
    }
}
