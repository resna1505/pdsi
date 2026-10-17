<?php

namespace App\Http\Controllers;

use App\Models\Anggota;

class KtaVerificationController extends Controller
{
    /**
     * Halaman publik hasil scan QR pada KTA.
     */
    public function show($token)
    {
        $anggota = Anggota::with(['perhimpunan', 'user'])
            ->where('kta_token', $token)
            ->whereNotNull('no_kartu_anggota')
            ->first();

        $status = null;
        if ($anggota) {
            if (!$anggota->user || !$anggota->user->is_active) {
                $status = 'nonaktif';
            } elseif ($anggota->isKtaExpired()) {
                $status = 'kedaluwarsa';
            } else {
                $status = 'aktif';
            }
        }

        return view('member.kta.verify', compact('anggota', 'status'));
    }
}
