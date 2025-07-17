<?php

namespace App\Http\Controllers;

use App\Models\IuranAnggota;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class VerifikasiIuranController extends Controller
{
    public function index()
    {
        $data = DB::table('iuran_anggotas as ia')
            ->join('anggotas as ag', 'ag.id', '=', 'ia.anggota_id')
            ->select(
                'ia.anggota_id',
                'ia.status',
                'ia.bukti_bayar',
                'ag.nama',
                'ag.profesi',
                'ag.email',
                'ag.avatar'
            )
            ->where('ia.status', 2)
            ->groupBy(
                'ia.anggota_id',
                'ia.status',
                'ia.bukti_bayar',
                'ag.nama',
                'ag.profesi',
                'ag.email',
                'ag.avatar'
            )
            ->get();

        $details = DB::table('iuran_anggotas as ia')
            ->join('anggotas as ag', 'ag.id', '=', 'ia.anggota_id')
            ->join('master_iuran_anggotas as mia', 'mia.id', '=', 'ia.master_iuran_id')
            ->select(
                'ia.anggota_id',
                'mia.nama_iuran',
                'mia.jumlah'
            )
            ->where('ia.status', 2)
            ->get();

        return view('admin.verifikasi-iuran', compact('data', 'details'));
    }

    public function verifikasi($id)
    {
        try {
            IuranAnggota::where('anggota_id', $id)->update(['status' => 3, 'tanggal_lunas' => now(), 'diverifikasi_oleh' => auth()->user()->anggota->id]);

            return redirect()->back()->with('success', 'Iuran added successfully!');
        } catch (\Throwable $e) {
            Log::error('Article store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to add article. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            IuranAnggota::where('anggota_id', $id)->update(['status' => 1]);

            return redirect()->back()->with('success', 'Iuran added successfully!');
        } catch (\Throwable $e) {
            Log::error('Article store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to add article. Please try again.');
        }
    }
}
