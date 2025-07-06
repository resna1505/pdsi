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

    public function verifikasi($id)
    {
        try {
            $user = User::findOrFail($id);

            $user->is_active = 1;
            $user->save();

            return redirect()->back()->with('success', 'User verified successfully!');
        } catch (\Throwable $e) {
            Log::error('User verification error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to verify user. Please try again.');
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
