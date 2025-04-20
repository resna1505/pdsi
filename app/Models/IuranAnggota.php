<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IuranAnggota extends Model
{
    use HasFactory;

    protected $fillable = [
        'anggota_id',
        'master_iuran_id',
        'status',
        'bukti_bayar',
        'keterangan',
        'tanggal_lunas',
        'diverifikasi_oleh'
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function masterIuran()
    {
        return $this->belongsTo(MasterIuranAnggota::class, 'master_iuran_id');
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'diverifikasi_oleh');
    }
}
