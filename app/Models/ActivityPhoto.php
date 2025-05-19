<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityPhoto extends Model
{
    protected $fillable = ['activity_id', 'image'];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
