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

    public function updateStatusWithPayment(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'anggota_id' => 'required',
                'bukti_bayar' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048', // max 2MB
                'description' => 'nullable|string|max:500'
            ]);

            $anggotaId = $request->anggota_id;
            $description = $request->description;

            // Handle file upload
            $buktibayarPath = null;
            if ($request->hasFile('bukti_bayar')) {
                $file = $request->file('bukti_bayar');
                $fileName = time() . '_' . $anggotaId . '.' . $file->getClientOriginalExtension();
                $buktibayarPath = $file->storeAs('bukti_bayar', $fileName, 'public');
            }

            // Update database dengan bukti bayar dan description
            DB::table('iuran_anggotas')
                ->where('anggota_id', $anggotaId)
                ->update([
                    'status' => 2, // Status verification
                    'bukti_bayar' => $buktibayarPath,
                    'keterangan' => $description,
                    'updated_at' => now()
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Data pembayaran berhasil disimpan dan status diupdate'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->validator->errors()->first()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

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
