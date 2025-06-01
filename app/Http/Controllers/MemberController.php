<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // dd($dokter);

        return view('admin.member', compact('admin', 'dokter'));
    }

    public function show($id)
    {
        $anggota = Anggota::where('user_id', $id)->first();
        $documents = Document::where('user_id', Auth::id())->orderBy('upload_date', 'desc')->get();

        return view('member.profile-dokter', compact('anggota', 'documents'));
    }
}
