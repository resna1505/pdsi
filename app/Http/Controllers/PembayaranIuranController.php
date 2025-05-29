<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IuranAnggota;
use App\Models\Anggota;
use App\Models\MasterIuranAnggota;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PembayaranIuranController extends Controller
{
    public function index()
    {
        $anggotaId = Anggota::where('user_id', Auth::id())->first()->id;
        $today = Carbon::today();

        $masterIuranList = MasterIuranAnggota::all();

        foreach ($masterIuranList as $masterIuran) {
            if (Carbon::parse($masterIuran->periode)->gt($today)) {
                continue;
            }

            $sudahAda = IuranAnggota::where('anggota_id', $anggotaId)
                ->where('master_iuran_id', $masterIuran->id)
                ->exists();

            // dd($anggotaId);
            if (!$sudahAda) {
                IuranAnggota::create([
                    'anggota_id' => $anggotaId,
                    'master_iuran_id' => $masterIuran->id,
                    'status' => 0,
                ]);
            }
        }

        $iurans = IuranAnggota::with('masterIuran')
            ->where('anggota_id', $anggotaId)
            ->get();

        $currentStatus = $iurans->where('status', '<', 3)->sortByDesc('updated_at')->first()->status ?? 0;

        return view('member.pembayaran-iuran', compact('iurans', 'currentStatus', 'anggotaId'));
    }

    // Tambahkan method ini di Controller yang menangani halaman iuran anggota
    public function updateStatusPayment(Request $request)
    {
        try {
            $anggotaId = $request->anggota_id;

            DB::table('iuran_anggotas')
                ->where('anggota_id', $anggotaId)
                ->where('status', 0) // Assuming 0 is initial status
                ->update(['status' => 1]);

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diupdate'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $anggotaId = $request->anggota_id;
            $status = $request->status;

            // Update status sesuai parameter
            DB::table('iuran_anggotas')
                ->where('anggota_id', $anggotaId)
                ->update(['status' => $status]);

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diupdate ke ' . $status
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate status: ' . $e->getMessage()
            ], 500);
        }
    }
}
