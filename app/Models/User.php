<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    use Notifiable;

    protected $fillable = [
        'is_active',
        'level',
        'email',
        'password',
        'remember_token'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean'
    ];

    // app/Models/User.php
    // public function anggota()
    // {
    //     return $this->hasOne(\App\Models\Anggota::class, 'user_id', 'id');
    // }
    public function anggota()
    {
        return $this->hasOne(Anggota::class, 'user_id');
    }
    /**
     * Relasi ke Testimonial melalui Anggota
     */
    public function testimonials()
    {
        return $this->hasManyThrough(Testimonial::class, Anggota::class, 'user_id', 'anggota_id');
    }
}
