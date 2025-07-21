<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\Struktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StrukturController extends Controller
{
    public function index()
    {
        try {
            $struktur = Struktur::where('is_active', 1)->first();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'struktur' => $struktur,
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengambil data: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data',
            ], 500);
        }
    }
}
