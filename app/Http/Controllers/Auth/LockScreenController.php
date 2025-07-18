<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LockScreenController extends Controller
{
    /**
     * Show the lock screen form.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Set session bahwa screen sedang terkunci
        Session::put('screen_locked', true);

        return view('auth-lockscreen-basic');
    }

    /**
     * Handle unlock screen request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unlock(Request $request)
    {
        // Validasi input
        $request->validate([
            'password' => 'required|string',
        ], [
            'password.required' => 'Password wajib diisi.',
        ]);

        // Pastikan user masih login
        if (!Auth::check()) {
            return redirect()->route('login')
                ->withErrors(['error' => 'Session telah berakhir. Silakan login kembali.']);
        }

        $user = Auth::user();

        // Verifikasi password dengan yang ada di database
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Password yang Anda masukkan salah.'
            ])->withInput();
        }

        // Jika password benar, unlock screen
        Session::forget('screen_locked');

        // Redirect ke dashboard atau halaman yang diinginkan
        return redirect()->intended(route('dashboard'))
            ->with('success', 'Screen berhasil di-unlock!');
    }

    /**
     * Lock the screen manually.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function lock()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Set session screen locked
        Session::put('screen_locked', true);

        return redirect()->route('lockscreen.show')
            ->with('info', 'Screen telah dikunci. Masukkan password untuk membuka kembali.');
    }
}
