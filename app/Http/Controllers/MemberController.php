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
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; // 🆕 TAMBAHAN
use Illuminate\Support\Facades\Storage; // 🆕 TAMBAHAN
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

        // Calculate profile completion percentage
        $profilePercentage = $this->calculateProfileCompletion($anggota);

        // Determine progress bar color based on percentage
        $progressColor = $this->getProgressColor($profilePercentage);

        return view('member.profile-dokter', compact(
            'anggota',
            'documents',
            'educations',
            'practices',
            'profilePercentage',
            'progressColor'
        ));
    }

    /**
     * Calculate profile completion percentage
     */
    private function calculateProfileCompletion($anggota)
    {
        $fields = [
            'nama',
            'email',
            'no_hp',
            'alamat',
            'kota',
            'provinsi',
            'tempat_lahir',
            'tanggal_lahir',
            'ktp',
            'profesi',
            'avatar'
        ];

        $completedFields = 0;
        $totalFields = count($fields);

        foreach ($fields as $field) {
            if (!empty($anggota->$field)) {
                $completedFields++;
            }
        }

        return round(($completedFields / $totalFields) * 100);
    }

    /**
     * Get progress bar color based on percentage
     */
    private function getProgressColor($percentage)
    {
        if ($percentage >= 80) {
            return 'bg-success';
        } elseif ($percentage >= 60) {
            return 'bg-warning';
        } elseif ($percentage >= 40) {
            return 'bg-info';
        } else {
            return 'bg-danger';
        }
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

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            // Cari user berdasarkan ID
            $user = User::findOrFail($id);

            // Cari anggota berdasarkan user_id
            $anggota = Anggota::where('user_id', $id)->first();

            if (!$anggota) {
                return redirect()->route('member.index')->with('error', 'Data anggota tidak ditemukan.');
            }

            // Pastikan hanya member (dokter) yang bisa dihapus, bukan admin
            if (empty($anggota->spesialis)) {
                return redirect()->route('member.index')->with('error', 'Admin tidak dapat dihapus melalui fitur ini.');
            }

            // Hapus file-file yang terkait jika ada
            $filesToDelete = [];

            if ($anggota->avatar) {
                $filesToDelete[] = public_path("storage/images/users/{$anggota->avatar}");
            }

            if ($anggota->ktp) {
                $filesToDelete[] = public_path("storage/images/users/{$anggota->ktp}");
            }

            if ($anggota->npwp) {
                $filesToDelete[] = public_path("storage/images/users/{$anggota->npwp}");
            }

            // 🆕 Jika ada field dokumen_persyaratan, hapus juga
            if (!empty($anggota->dokumen_persyaratan)) {
                $filesToDelete[] = public_path("storage/images/users/{$anggota->dokumen_persyaratan}");
            }

            // Hapus data terkait dari tabel lain
            Education::where('anggota_id', $anggota->id)->delete();
            Practice::where('anggota_id', $anggota->id)->delete();
            Document::where('user_id', $id)->delete();

            // Hapus data anggota
            $memberName = $anggota->nama;
            $anggota->delete();

            // Hapus user
            $user->delete();

            // Hapus file-file fisik setelah database berhasil dihapus
            foreach ($filesToDelete as $filePath) {
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            DB::commit();

            Log::info("Member deleted successfully: {$memberName} (ID: {$id})");

            return redirect()->route('member.index')->with('success', "Member {$memberName} berhasil dihapus.");
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error("Error deleting member: " . $e->getMessage());

            return redirect()->route('member.index')->with('error', 'Terjadi kesalahan saat menghapus member: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $anggota = Anggota::where('user_id', $id)->first();

        // Jika masih tidak ditemukan, redirect dengan error
        if (!$anggota) {
            return redirect()->back()->with('error', 'Data anggota tidak ditemukan');
        }

        // Gunakan view yang sama dengan edit-profile-dokter
        return view('member.edit-profile-dokter', compact('anggota'));
    }
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            // Cari anggota
            $anggota = Anggota::where('user_id', $id)->first();
            if (!$anggota) {
                return redirect()->back()->with('error', 'Data anggota tidak ditemukan');
            }

            // Validasi input
            $request->validate([
                'nama' => 'required|string|max:255',
                'email' => 'required|email|unique:anggotas,email,' . $anggota->id, // 🆕 PERBAIKI UNIQUE VALIDATION
                'no_hp' => 'required|string|max:20',
                'alamat' => 'nullable|string|max:500',
                'kota' => 'nullable|string|max:100',
                'provinsi' => 'nullable|string|max:100',
                'tempat_lahir' => 'nullable|string|max:100',
                'tanggal_lahir' => 'nullable|date',
                'profesi' => 'nullable|array',
                'description' => 'nullable|string|max:1000',
                'facebook_url' => 'nullable',
                'twitter_url' => 'nullable',
                'linkedin_url' => 'nullable',
                'instagram_url' => 'nullable',
            ]);

            $tanggalLahir = null;
            if ($request->tanggal_lahir) {
                $tanggalLahir = Carbon::parse($request->tanggal_lahir)->format('Y-m-d');
            }

            if ($request->hasFile('photo')) {
                if ($anggota->avatar && file_exists(public_path("storage/images/users/{$anggota->avatar}"))) {
                    unlink(public_path("storage/images/users/{$anggota->avatar}"));
                }

                $image = $request->file('photo');
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('storage/images/users'), $filename);
                $anggota->avatar = $filename;
            }

            $anggota->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $tanggalLahir,
                'profesi' => is_array($request->profesi) ? implode(', ', $request->profesi) : $request->profesi,
                'alamat' => $request->alamat,
                'kota' => $request->kota,
                'provinsi' => $request->provinsi,
                'description' => $request->description,
                'facebook_url' => $request->facebook_url,
                'twitter_url' => $request->twitter_url,
                'linkedin_url' => $request->linkedin_url,
                'instagram_url' => $request->instagram_url,
            ]);

            if ($anggota->user) {
                $anggota->user->update([
                    'name' => $request->nama,
                    'email' => $request->email,
                ]);
            }

            DB::commit();
            return back()->with('success', 'Profile Berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error updating member profile: " . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui profile: ' . $e->getMessage());
        }
    }
}
