<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IuranAnggota;
use App\Models\Anggota;
use App\Models\MasterIuranAnggota;
use Illuminate\Support\Facades\Auth;

class PembayaranIuranController extends Controller
{
    public function index()
    {
        // $user = Auth::user();
        // $anggota = Anggota::where('user_id', $user->id)->first();

        // if (!$anggota) {
        //     return redirect()->back()->with('error', 'Data anggota tidak ditemukan.');
        // }

        // $iurans = IuranAnggota::with('masterIuran')
        //     ->where('anggota_id', $anggota->id)
        //     ->orderBy('master_iuran_id', 'asc')
        //     ->get();
        // // dd($iurans);

        // // Ambil status terakhir dari iuran yang belum selesai
        // $currentStatus = $iurans->where('status', '<', 3)->sortByDesc('updated_at')->first()->status ?? 0;

        // return view('member.pembayaran-iuran', compact('iurans', 'currentStatus', 'anggota'));

        // $anggotaId = Auth::id();
        $anggotaId = Anggota::where('user_id', Auth::id())->first()->id;

        // Ambil semua master iuran
        $masterIuranList = MasterIuranAnggota::all();

        foreach ($masterIuranList as $masterIuran) {
            $sudahAda = IuranAnggota::where('anggota_id', $anggotaId)
                ->where('master_iuran_id', $masterIuran->id)
                ->exists();

            // dd($anggotaId);
            if (!$sudahAda) {
                IuranAnggota::create([
                    'anggota_id' => $anggotaId,
                    'master_iuran_id' => $masterIuran->id,
                    'status' => 0,
                    // 'tanggal_dibuat' => now(),
                ]);
            }
        }

        // Setelah dipastikan semua iuran tersedia, ambil dan tampilkan
        $iurans = IuranAnggota::with('masterIuran')
            ->where('anggota_id', $anggotaId)
            ->get();

        $currentStatus = $iurans->where('status', '<', 3)->sortByDesc('updated_at')->first()->status ?? 0;

        return view('member.pembayaran-iuran', compact('iurans', 'currentStatus', 'anggotaId'));
    }

    public function updateStatus(Request $request, $anggotaId)
    {
        dd($anggotaId);
        IuranAnggota::where('anggota_id', $anggotaId)
            ->where('status', 0)
            ->update(['status' => 1]);

        return response()->json(['message' => 'Status updated']);
    }
}
