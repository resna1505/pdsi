<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DokterController extends Controller
{
    public function index()
    {
        try {
            $dokter = Anggota::all();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'dokter' => $dokter,
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
