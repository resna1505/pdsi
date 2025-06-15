<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag_workshop extends Model
{
    use HasFactory;
    protected $table = 'tag_workshop';
    protected $fillable = ['workshop_id', 'tag_id'];
    public $timestamps = false;
}
