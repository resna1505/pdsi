<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

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
            $this->addError('email', trans('auth.failed'));
            return redirect()->back();
        }
    }


    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.master-without-nav');
    }
}
