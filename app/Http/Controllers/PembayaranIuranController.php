<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IuranAnggota;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;

class PembayaranIuranController extends Controller
{
    public function index()
    {
        // Anggap dokter login adalah anggota, ambil datanya
        $user = Auth::user();

        // Asumsinya: 1 user = 1 anggota (relasi bisa kamu sesuaikan)
        $anggota = Anggota::where('email', $user->email)->first();

        if (!$anggota) {
            return redirect()->back()->with('error', 'Data anggota tidak ditemukan.');
        }

        $iurans = IuranAnggota::with('masterIuran')
            ->where('anggota_id', $anggota->id)
            ->orderBy('master_iuran_id', 'asc')
            ->get();

        // Ambil status terakhir dari iuran yang belum selesai
        $currentStatus = $iurans->where('status', '<', 3)->sortByDesc('updated_at')->first()->status ?? 0;

        return view('member.pembayaran-iuran', compact('iurans', 'currentStatus', 'anggota'));
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
