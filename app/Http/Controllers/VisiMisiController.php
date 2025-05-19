<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VisiMisiController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'visimisi' => VisiMisi::where('type', 'visimisi')->pluck('description'),
                'value' => VisiMisi::where('type', 'value')->get(['title', 'description']),
                'motto' => VisiMisi::where('type', 'motto')->pluck('description')->first()
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
