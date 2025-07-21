<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use App\Exports\UserAdminExport;
use App\Exports\UserMemberExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $admin = Anggota::where('spesialis', '')
            ->whereHas('user', function ($query) {
                $query->where('is_active', 0);
            })
            ->get();

        $dokter = Anggota::where('spesialis', '!=', '')
            ->whereHas('user', function ($query) {
                $query->where('is_active', 0);
            })
            ->get();

        return view('admin.user', compact('admin', 'dokter'));
    }

    /**
     * Mapping kode provinsi untuk nomor kartu anggota
     * REVISI: Perbaiki format kode dari 14 digit ke 12 digit
     */
    private $provinsiKode = [
        'Pengurus Pusat' => '122704221101',
        'DKI Jakarta' => '122704221102',
        'Nanggroe Aceh Darussalam' => '122704221103',
        'Aceh' => '122704221103', // Alternatif nama
        'Sumatera Utara' => '122704221104',
        'Sumatera Selatan' => '122704221105',
        'Sumatera Barat' => '122704221106',
        'Bengkulu' => '122704221107',
        'Riau' => '122704221108',
        'Kepulauan Riau' => '122704221109',
        'Jambi' => '122704221110',
        'Lampung' => '122704221111',
        'Bangka Belitung' => '122704221112',
        'Kalimantan Barat' => '122704221113',
        'Kalimantan Timur' => '122704221114',
        'Kalimantan Selatan' => '122704221115',
        'Kalimantan Tengah' => '122704221116',
        'Kalimantan Utara' => '122704221117',
        'Banten' => '122704221118',
        'Jawa Barat' => '122704221119',
        'Jawa Tengah' => '122704221120',
        'Daerah Istimewa Yogyakarta' => '122704221121',
        'DI Yogyakarta' => '122704221121', // Alternatif nama
        'Jawa Timur' => '122704221122',
        'Bali' => '122704221123',
        'Nusa Tenggara Timur' => '122704221124',
        'Nusa Tenggara Barat' => '122704221125',
        'Gorontalo' => '122704221126',
        'Sulawesi Barat' => '122704221127',
        'Sulawesi Tengah' => '122704221128',
        'Sulawesi Utara' => '122704221129',
        'Sulawesi Tenggara' => '122704221130',
        'Sulawesi Selatan' => '122704221131',
        'Maluku Utara' => '122704221132',
        'Maluku' => '122704221133',
        'Papua Barat' => '122704221134',
        'Papua' => '122704221135',
        'Papua Tengah' => '122704221136',
        'Papua Pegunungan' => '122704221137',
        'Papua Selatan' => '122704221138',
        'Papua Barat Daya' => '122704221139',
    ];

    private function generateNoKartuAnggota($provinsi)
    {
        // Ambil kode provinsi (12 digit)
        $kodeProvinsi = $this->provinsiKode[$provinsi] ?? null;

        if (!$kodeProvinsi) {
            throw new \Exception("Kode provinsi untuk '{$provinsi}' tidak ditemukan");
        }

        // Cari nomor urut tertinggi untuk provinsi ini
        $lastNumber = Anggota::where('provinsi', $provinsi)
            ->where('no_kartu_anggota', 'LIKE', $kodeProvinsi . '%')
            ->whereNotNull('no_kartu_anggota')
            ->orderBy('no_kartu_anggota', 'desc')
            ->value('no_kartu_anggota');

        if ($lastNumber) {
            // Ambil 5 digit terakhir dan increment
            $lastSequence = (int) substr($lastNumber, -5);
            $newSequence = $lastSequence + 1;
        } else {
            // Nomor pertama untuk provinsi ini
            $newSequence = 1;
        }

        // Format nomor dengan leading zeros (5 digit)
        $formattedSequence = str_pad($newSequence, 5, '0', STR_PAD_LEFT);

        return $kodeProvinsi . $formattedSequence;
    }


    public function verifikasi($id)
    {
        // Menggunakan database transaction untuk memastikan data consistency
        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);

            // Pastikan user belum diverifikasi sebelumnya
            if ($user->is_active == 1) {
                DB::rollBack();
                return redirect()->back()->with('warning', 'User sudah terverifikasi sebelumnya!');
            }

            // Ambil data anggota
            $anggota = Anggota::where('user_id', $user->id)->first();

            if (!$anggota) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Data anggota tidak ditemukan!');
            }

            // Pastikan anggota belum memiliki nomor kartu
            if ($anggota->no_kartu_anggota) {
                DB::rollBack();
                return redirect()->back()->with('warning', 'Anggota sudah memiliki nomor kartu: ' . $anggota->no_kartu_anggota);
            }

            // Generate nomor kartu anggota
            $noKartuAnggota = $this->generateNoKartuAnggota($anggota->provinsi);

            // Update status user
            $user->is_active = 1;
            $user->save();

            // Update nomor kartu anggota
            $anggota->no_kartu_anggota = $noKartuAnggota;
            $anggota->save();

            DB::commit();

            Log::info('User verified successfully', [
                'user_id' => $user->id,
                'email' => $user->email,
                'no_kartu_anggota' => $noKartuAnggota,
                'provinsi' => $anggota->provinsi
            ]);

            return redirect()->back()->with(
                'success',
                'User berhasil diverifikasi! Nomor Kartu Anggota: ' . $noKartuAnggota
            );
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('User verification error: ' . $e->getMessage(), [
                'user_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Gagal memverifikasi user: ' . $e->getMessage());
        }
    }

    /**
     * Method tambahan untuk debugging - cek nomor kartu anggota berdasarkan provinsi
     */
    public function checkKartuAnggota($provinsi)
    {
        try {
            $noKartu = $this->generateNoKartuAnggota($provinsi);

            return response()->json([
                'success' => true,
                'provinsi' => $provinsi,
                'next_no_kartu' => $noKartu
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            Anggota::where('user_id', $id)->delete();

            $user->delete();

            return redirect()->back()->with('success', 'User deleted successfully!');
        } catch (\Throwable $e) {
            Log::error('User delete error: ' . $e->getMessage(), [
                'User_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to delete User. Please try again.');
        }
    }

    public function exportAdmin()
    {
        try {
            Log::info('Export User Admin method called');

            // Test query dulu
            $adminData = Anggota::where('spesialis', '')
                ->whereHas('user', function ($query) {
                    $query->where('is_active', 0);
                })
                ->with('user')
                ->get();

            Log::info('User Admin data count: ' . $adminData->count());

            if ($adminData->isEmpty()) {
                return redirect()->back()->with('error', 'Tidak ada data admin yang belum terverifikasi untuk di export.');
            }

            $filename = 'user_admin_pending_' . date('Y-m-d_H-i-s') . '.xlsx';
            Log::info('Attempting to download: ' . $filename);

            return Excel::download(new UserAdminExport, $filename);
        } catch (\Exception $e) {
            Log::error('Export User Admin Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat export: ' . $e->getMessage());
        }
    }

    public function exportMember()
    {
        try {
            Log::info('Export User Member method called');

            // Test query dulu
            $memberData = Anggota::where('spesialis', '!=', '')
                ->whereHas('user', function ($query) {
                    $query->where('is_active', 0);
                })
                ->with('user')
                ->get();

            Log::info('User Member data count: ' . $memberData->count());

            if ($memberData->isEmpty()) {
                return redirect()->back()->with('error', 'Tidak ada data member yang belum terverifikasi untuk di export.');
            }

            $filename = 'user_member_pending_' . date('Y-m-d_H-i-s') . '.xlsx';
            Log::info('Attempting to download: ' . $filename);

            return Excel::download(new UserMemberExport, $filename);
        } catch (\Exception $e) {
            Log::error('Export User Member Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat export: ' . $e->getMessage());
        }
    }
}
