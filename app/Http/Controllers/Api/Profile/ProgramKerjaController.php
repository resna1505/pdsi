<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\ProgramKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProgramKerjaController extends Controller
{
    public function index()
    {
        try {

            $programKerja = ProgramKerja::all();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'programKerja' => $programKerja,
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengambil data counter: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data',
            ], 500);
        }
    }
}
