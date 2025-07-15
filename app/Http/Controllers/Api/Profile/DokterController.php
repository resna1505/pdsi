<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DokterController extends Controller
{
    public function index()
    {
        try {
            $jumlahDokter = Anggota::count();
            $jumlahMitra = Mitra::count();
            $evaluasi = 89;
            $dokter = Anggota::whereNotNull('spesialis')
                ->where('spesialis', '!=', '')
                ->get();
            $anggotaKehormatan = Anggota::whereNotNull('spesialis')
                ->where('spesialis', '=', 'Anggota Kehormatan')
                ->get();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'dokter' => $dokter,
                    'anggotaKehormatan' => $anggotaKehormatan,
                    'jumlahDokter' => $jumlahDokter,
                    'jumlahMitra' => $jumlahMitra,
                    'evaluasi' => $evaluasi
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengambil data dokter: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data',
            ], 500);
        }
    }
}
