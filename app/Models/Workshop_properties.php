<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop_properties extends Model
{
    use HasFactory;
    protected $fillable = ['workshop_id', 'name', 'value'];
}
