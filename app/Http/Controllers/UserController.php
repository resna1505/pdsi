<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

            return redirect()->back()->with('success', 'User added successfully!');
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
}
