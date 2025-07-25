<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // 🆕 TAMBAHAN

class EditProfileController extends Controller
{
    public function index()
    {
        $anggota = Anggota::where('user_id', Auth::id())->first();

        return view('member.edit-profile-dokter', compact('anggota'));
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $anggota = Anggota::where('user_id', Auth::id())->first();

            if (!$anggota) {
                return redirect()->back()->with('error', 'Data anggota tidak ditemukan');
            }

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
            return redirect()->back()->with('success', 'Profile added successfully!');
        } catch (\Throwable $e) {
            DB::rollBack(); // 🆕 ROLLBACK JIKA ERROR

            Log::error('Profile update error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'user_id' => Auth::id(),
                'request_data' => $request->except(['photo']) // Log request tanpa file
            ]);

            return redirect()->back()
                ->withInput() // 🆕 KEMBALIKAN INPUT
                ->with('error', 'Gagal memperbarui profile. Silakan coba lagi.');
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $request->validate([
                'old_password' => 'required',
                'new_password' => [
                    'required',
                    'min:8',
                ],
            ]);

            $user = Auth::user();

            if (!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'Password lama salah.']);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return back()->with('success', 'Password berhasil diubah.');
        } catch (\Throwable $e) {
            Log::error('Profile store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Please try again.');
        }
    }

    public function updatePhoto(Request $request, $id)
    {
        try {
            $anggota = Anggota::where('user_id', Auth::id())->first();

            $request->validate([
                'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'twitter_url' => 'nullable|string|max:255',
                'linkedin_url' => 'nullable|string|max:255',
            ]);

            $imagePath = null;
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $filename = $image->hashName();
                $image->move(public_path('storage/images/users'), $filename);
                $imagePath = $filename;
            }

            $anggota->linkedin_url = $request->linkedin_url;
            $anggota->twitter_url = $request->twitter_url;
            $anggota->facebook_url = $request->facebook_url;
            $anggota->instagram_url = $request->instagram_url;

            if (!empty($request->photo)) {
                $anggota->avatar = $imagePath;
            }

            $anggota->save();

            return redirect()->back()->with('success', 'Data anggota berhasil diperbarui.');
        } catch (\Throwable $e) {
            Log::error('Profile store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to update profile. Please try again.');
        }
    }
}
