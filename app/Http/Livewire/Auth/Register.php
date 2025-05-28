<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\Otp;
use Carbon\Carbon;
use App\Mail\OtpEmail;
use App\Models\Anggota;
use Illuminate\Support\Facades\DB;

class Register extends Component
{
    use WithFileUploads;

    public $email;
    public $name;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $no_hp = '08';
    public $alamat;
    public $kota;
    public $provinsi;
    public $profesi;
    public $ktp;
    public $npwp;
    public $avatar;
    public $password;
    public $password_confirmation, $otp, $generatedOtp, $remember;


    public $otherProfesi = '';

    protected $rules = [
        'email' => 'required|string|email|max:255|unique:users',
        'name' => 'required',
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required',
        'no_hp' => 'required',
        'alamat' => 'required',
        'kota' => 'required',
        'provinsi' => 'required',
        'profesi' => 'required',
        'ktp' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'npwp' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'password' => 'required|string|min:8|confirmed',
        'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'remember' => 'required|accepted',
        'otp' => 'required',
    ];

    public function sendOtp()
    {
        $this->validate(['email' => 'required|email']);

        // Generate OTP
        $otpCode = rand(100000, 999999);

        // Simpan OTP ke database
        Otp::updateOrCreate(
            ['email' => $this->email],
            ['otp' => $otpCode, 'expires_at' => Carbon::now()->addMinutes(10)]
        );

        // Kirim OTP ke email
        // Mail::raw("Your OTP Code is: $otpCode", function ($message) {
        //     $message->to($this->email)->subject('Your OTP Code');
        // });
        Mail::to($this->email)->send(new OtpEmail($otpCode));

        session()->flash('success', 'OTP has been sent to your email.');
    }

    public function submit()
    {
        $this->validate();

        $otpRecord = Otp::where('email', $this->email)
            ->where('otp', $this->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$otpRecord) {
            session()->flash('error', 'Invalid or expired OTP.');
            return;
        }

        $otpRecord->delete();

        $ktpName = $this->ktp ? time() . '_ktp.' . $this->ktp->getClientOriginalExtension() : null;
        if ($this->ktp) Storage::putFileAs('public/images/users', $this->ktp, $ktpName);

        $npwpName = $this->npwp ? time() . '_npwp.' . $this->npwp->getClientOriginalExtension() : null;
        if ($this->npwp) Storage::putFileAs('public/images/users', $this->npwp, $npwpName);

        $avatarName = $this->avatar ? time() . '_avatar.' . $this->avatar->getClientOriginalExtension() : null;
        if ($this->avatar) Storage::putFileAs('public/images/users', $this->avatar, $avatarName);

        if ($this->profesi == 'other') {
            $this->profesi = $this->otherProfesi;
        }

        $token = bin2hex(random_bytes(20));

        // ⛑️ Transaksi database
        DB::beginTransaction();
        try {
            $user = User::create([
                'email' => $this->email,
                'level' => 'Dokter',
                'password' => Hash::make($this->password),
                'email_verified_at' => now(),
                'remember_token' => $token,
                'created_at' => now(),
            ]);

            Anggota::create([
                'user_id' => $user->id,
                'email' => $this->email,
                'nama' => $this->name,
                'tempat_lahir' => $this->tempat_lahir,
                'tanggal_lahir' => $this->tanggal_lahir,
                'no_hp' => $this->no_hp,
                'alamat' => $this->alamat,
                'kota' => $this->kota,
                'provinsi' => $this->provinsi,
                'profesi' => $this->profesi,
                'spesialis' => $this->profesi,
                'ktp' => $ktpName,
                'npwp' => $npwpName,
                'avatar' => $avatarName,
            ]);

            DB::commit();
            return redirect('login')->with('success', 'User registered successfully.!');
        } catch (\Throwable $e) {
            DB::rollBack();
            dd($e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat registrasi. Silakan coba lagi.');
        }
    }
    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.master-without-nav');
    }
}
