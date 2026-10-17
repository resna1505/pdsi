<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\Perhimpunan;
use Illuminate\Support\Facades\Log;

class PerhimpunanController extends Controller
{
    /**
     * Daftar perhimpunan aktif untuk website profil.
     */
    public function index()
    {
        try {
            $data = Perhimpunan::active()->get()->map(fn (Perhimpunan $p) => [
                'id' => $p->id,
                'nama' => $p->nama,
                'singkatan' => $p->singkatan,
                'ringkasan' => $p->ringkasan,
                'logo' => $p->logo_url,
            ]);

            return response()->json(['data' => $data]);
        } catch (\Exception $e) {
            Log::error('Gagal mengambil data perhimpunan: ' . $e->getMessage());

            return response()->json(['status' => 'error', 'message' => 'Gagal mengambil data'], 500);
        }
    }

    /**
     * Detail profil satu perhimpunan aktif.
     */
    public function show($id)
    {
        $p = Perhimpunan::where('is_active', true)->find($id);

        if (!$p) {
            return response()->json(['status' => 'error', 'message' => 'Perhimpunan tidak ditemukan'], 404);
        }

        return response()->json(['data' => [
            'id' => $p->id,
            'nama' => $p->nama,
            'singkatan' => $p->singkatan,
            'ringkasan' => $p->ringkasan,
            'logo' => $p->logo_url,
            'filosofi' => $p->filosofi,
            'arti_lambang' => $p->arti_lambang,
            'visi' => $p->visi,
            'misi' => $p->misi_list,
            'tujuan' => $p->tujuan,
            'slogan' => $p->slogan,
            'nilai_dasar' => $p->nilai_dasar_list,
            'syarat' => $p->syaratDokumen(),
            'register_url' => url('/register'),
        ]]);
    }
}
