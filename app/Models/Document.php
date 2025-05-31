<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'filename', 'type', 'size', 'upload_date'];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'user_id', 'user_id');
    }
}
