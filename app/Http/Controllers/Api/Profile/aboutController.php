<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Anggota;
use App\Models\Article;
use App\Models\Mitra;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Video;

class aboutController extends Controller
{
    public function index()
    {
        try {
            $jumlahDokter = Anggota::count();
            $jumlahMitra = Mitra::count();
            $jumlahEvaluasi = 94;
            $videos = Video::with('learningMethods')->get();

            $activities = Activity::with('photos')->get();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'dokter' => $jumlahDokter,
                    'mitra' => $jumlahMitra,
                    'evaluasi' => $jumlahEvaluasi,
                    'videos' => $videos,
                    'activities' => $activities
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
