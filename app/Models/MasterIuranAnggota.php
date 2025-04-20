<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterIuranAnggota extends Model
{
    use HasFactory;

    protected $fillable = ['nama_iuran', 'jumlah', 'periode'];

    public function iurans()
    {
        return $this->hasMany(IuranAnggota::class, 'master_iuran_id');
    }
}
