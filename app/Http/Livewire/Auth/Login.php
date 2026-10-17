<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Login extends Component
{
    public $email = "";
    public $password = "";

    protected $rules = [
        'email' => 'required|string|email|max:255',
        'password' => 'required',
    ];

    public function mount()
    {
        if (auth()->user()) {
            return redirect()->intended('/');
        }
    }

    public function submit()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
            'is_active' => 1,  // hanya user aktif yang bisa login
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        } else {
            // Password benar tapi akun belum aktif: beri tahu status pendaftarannya
            $user = User::with('anggota')->where('email', $this->email)->first();
            if ($user && !$user->is_active && Hash::check($this->password, $user->password)) {
                if ($user->anggota?->status_verifikasi === 'rejected') {
                    $this->addError('email', 'Pendaftaran Anda ditolak: ' . $user->anggota->alasan_penolakan);
                } else {
                    $this->addError('email', 'Akun Anda masih menunggu verifikasi admin.');
                }
                return;
            }

            $this->addError('email', trans('auth.failed'));
            return redirect()->back();
        }
    }

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.master-without-nav');
    }
}
