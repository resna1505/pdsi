<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoLearningMethod extends Model
{
    use HasFactory;
    protected $table = 'video_learning_method';
    protected $fillable = ['video_id', 'learning_method_id', 'progress'];
}
