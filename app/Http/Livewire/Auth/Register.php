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
use App\Mail\OtpEmail; // Tambahkan di bagian atas

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
        // validate the data
        $this->validate();

        // Cek OTP di database
        $otpRecord = Otp::where('email', $this->email)
            ->where('otp', $this->otp)
            ->where('expires_at', '>', now()) // OTP tidak expired
            ->first();

        if (!$otpRecord) {
            session()->flash('error', 'Invalid or expired OTP.');
            return;
        }

        // Hapus OTP setelah digunakan
        $otpRecord->delete();

        if ($this->ktp != null) {
            $ktp = $this->ktp;
            $ktpName = time() . '.' . $ktp->getClientOriginalExtension();
            Storage::putFileAs('public/images/users', $ktp, $ktpName);
        }
        if ($this->npwp != null) {
            $npwp = $this->npwp;
            $npwpName = time() . '.' . $npwp->getClientOriginalExtension();
            Storage::putFileAs('public/images/users', $npwp, $npwpName);
        }
        if ($this->avatar != null) {
            $avatar = $this->avatar;
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            Storage::putFileAs('public/images/users', $avatar, $avatarName);
        }
        if ($this->profesi == 'other') {
            $this->profesi = $this->otherProfesi;
        }
        $token = bin2hex(random_bytes(20));

        User::create([
            'email' => $this->email,
            'name' => $this->name,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'no_hp' => $this->no_hp,
            'alamat' => $this->alamat,
            'kota' => $this->kota,
            'provinsi' => $this->provinsi,
            'profesi' => $this->profesi,
            'ktp' => $ktpName,
            'npwp' => $npwpName,
            'password' => Hash::make($this->password),
            'email_verified_at' => now(),
            'avatar' => $avatarName,
            'remember_token' => $token,
            'created_at' => now(),
        ]);

        return redirect('login')->with('success', 'User registered successfully.!');
    }
    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.master-without-nav');
    }
}
