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

class Register extends Component
{
    use WithFileUploads;

    public $first_name;
    public $last_name;
    public $avatar;
    public $password;
    public $email;
    public $password_confirmation, $otp, $generatedOtp;

    protected $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048'
    ];

    // 🔹 Generate OTP & Kirim ke Email
    // public function sendOtp()
    // {
    //     $this->generatedOtp = rand(100000, 999999); // Generate OTP 6 digit
    //     Session::put('otp', $this->generatedOtp); // Simpan OTP ke session

    //     Mail::raw("Your OTP code is: {$this->generatedOtp}", function ($message) {
    //         $message->to($this->email)
    //             ->subject('Your OTP Code');
    //     });

    //     $this->otp = $this->generatedOtp; // Otomatis isi input OTP
    //     session()->flash('success', 'OTP sent to your email!');
    // }
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
        Mail::raw("Your OTP Code is: $otpCode", function ($message) {
            $message->to($this->email)->subject('Your OTP Code');
        });

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

        if ($this->avatar != null) {
            $avatar = $this->avatar;
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            Storage::putFileAs('public/images/users', $avatar, $avatarName);
        }
        $token = bin2hex(random_bytes(20));

        // create new user
        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'avatar' => $avatarName,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'remember_token' => $token,
            'created_at' => now()
        ]);

        return redirect('login')->with('success', 'User registered successfully.!');
    }
    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.master-without-nav');
    }
}
