<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Anggota;
use App\Models\Article;
use App\Models\Mitra;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class indexController extends Controller
{
    public function index()
    {
        try {
            $jumlahDokter = Anggota::count();
            $jumlahMitra = Mitra::count();
            $mitras = Mitra::active()->ordered()->get();
            $articles = Article::ordered()->get();
            $agenda = Agenda::with('category')->ordered()->get();
            $testimonials = Testimonial::with('anggota')
                ->where('is_active', true)
                ->latest()
                ->take(10)
                ->get();


            return response()->json([
                'status' => 'success',
                'data' => [
                    'dokter' => $jumlahDokter,
                    'mitra' => $jumlahMitra,
                    'mitras' => $mitras,
                    'articles' => $articles,
                    'agenda' => $agenda,
                    'testimonials' => $testimonials
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengambil data counter: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data',
                'data' => [
                    'dokter' => 0,
                    'mitra' => 0
                ]
            ], 500);
        }
    }
}
