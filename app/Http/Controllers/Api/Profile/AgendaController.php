<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

class AgendaController extends Controller
{
    public function index()
    {
        try {
            $today = Carbon::today();

            $agenda = Agenda::whereDate('dimulai', '<=', $today)
                ->whereDate('berakhir', '>=', $today)
                ->ordered()
                ->get();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'articles' => $agenda,
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
