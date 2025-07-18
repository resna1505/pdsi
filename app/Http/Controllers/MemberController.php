<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Document;
use App\Exports\AdminExport;
use App\Exports\MemberExport;
use App\Models\Education;
use App\Models\Practice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{
    public function index()
    {
        $admin = Anggota::where('spesialis', '')
            ->whereHas('user', function ($query) {
                $query->where('is_active', 1);
            })
            ->get();

        $dokter = Anggota::where('spesialis', '!=', '')
            ->whereHas('user', function ($query) {
                $query->where('is_active', 1);
            })
            ->get();

        return view('admin.member', compact('admin', 'dokter'));
    }

    public function show($id)
    {
        // Coba cari berdasarkan user_id dulu, jika tidak ada coba berdasarkan id
        $anggota = Anggota::where('user_id', $id)->first();

        // Jika tidak ditemukan berdasarkan user_id, coba berdasarkan id
        if (!$anggota) {
            $anggota = Anggota::where('id', $id)->first();
            $userId = $anggota ? $anggota->user_id : $id;
        } else {
            $userId = $id;
        }

        // Jika masih tidak ditemukan, redirect dengan error
        if (!$anggota) {
            return redirect()->route('member.index')->with('error', 'Data anggota tidak ditemukan.');
        }

        $documents = Document::where('user_id', $userId)->orderBy('upload_date', 'desc')->get();

        // Load educations dengan sorting berdasarkan tahun mulai
        $educations = Education::byAnggota($id)
            ->orderBy('start_year', 'desc')
            ->get();

        // Load practices dengan sorting berdasarkan tanggal mulai
        $practices = Practice::byAnggota($id)
            ->orderBy('start_date', 'desc')
            ->get();

        return view('member.profile-dokter', compact('anggota', 'documents', 'educations', 'practices'));
    }

    public function exportAdmin()
    {
        try {
            Log::info('Export Admin method called');

            // Test query dulu
            $adminData = Anggota::where('spesialis', '')
                ->whereHas('user', function ($query) {
                    $query->where('is_active', 1);
                })
                ->with('user')
                ->get();

            Log::info('Admin data count: ' . $adminData->count());

            if ($adminData->isEmpty()) {
                return redirect()->back()->with('error', 'Tidak ada data admin untuk di export.');
            }

            $filename = 'admin_list_' . date('Y-m-d_H-i-s') . '.xlsx';
            Log::info('Attempting to download: ' . $filename);

            return Excel::download(new AdminExport, $filename);
        } catch (\Exception $e) {
            Log::error('Export Admin Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat export: ' . $e->getMessage());
        }
    }

    public function exportMember()
    {
        try {
            Log::info('Export Member method called');

            // Test query dulu
            $memberData = Anggota::where('spesialis', '!=', '')
                ->whereHas('user', function ($query) {
                    $query->where('is_active', 1);
                })
                ->with('user')
                ->get();

            Log::info('Member data count: ' . $memberData->count());

            if ($memberData->isEmpty()) {
                return redirect()->back()->with('error', 'Tidak ada data member untuk di export.');
            }

            $filename = 'member_list_' . date('Y-m-d_H-i-s') . '.xlsx';
            Log::info('Attempting to download: ' . $filename);

            return Excel::download(new MemberExport, $filename);
        } catch (\Exception $e) {
            Log::error('Export Member Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat export: ' . $e->getMessage());
        }
    }
}
