<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            $request->validate([
                'nama' => 'nullable|string|max:255',
                'email' => 'nullable|email',
                'no_hp' => 'nullable|string',
                'tempat_lahir' => 'nullable|string',
                // 'tanggal_lahir' => 'nullable|date',
                'profesi' => 'nullable|array',
                'alamat' => 'nullable|string',
                'kota' => 'nullable|string',
                'provinsi' => 'nullable|string',
                'description' => 'nullable|string',
            ]);

            $anggota = Anggota::where('user_id', Auth::id())->first();

            $tanggalLahir = Carbon::parse($request->tanggal_lahir)->format('Y-m-d');

            $anggota->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $tanggalLahir,
                'profesi' => implode(',', $request->profesi ?? []),
                'alamat' => $request->alamat,
                'kota' => $request->kota,
                'provinsi' => $request->provinsi,
                'description' => $request->description,
            ]);

            return redirect()->back()->with('success', 'Profile added successfully!');
        } catch (\Throwable $e) {
            Log::error('Profile store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to add Profile. Please try again.');
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
            $anggota->avatar = $imagePath;

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
