<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\PembayaranIuranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');

    return "Cache dan konfigurasi telah dibersihkan!";
});

Route::get('/migrate-fresh', function () {
    Artisan::call('migrate:fresh');
    return "Database telah di-reset dan migrasi ulang berhasil!";
});

Route::get('/login', \App\Http\Livewire\Auth\Login::class)->name('login');
Route::get('/register', \App\Http\Livewire\Auth\Register::class)->name('register');
Route::get('/forget-password', \App\Http\Livewire\Auth\ForgetPassword::class)->name('password.reset');
Route::get('/new-password/{email?}/{token?}', \App\Http\Livewire\Auth\NewPassword::class);
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout']);
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::get('/auth-404-basic', function () {
    return view('auth-404-basic');
})->name('auth.404');

Route::get('/auth-500', function () {
    return view('auth-500');
})->name('auth.500');

Route::get('/auth-offline', function () {
    return view('auth-offline');
})->name('auth.offline');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        $user = Auth::user();
        if (strtolower($user->level) === 'admin') {
            return view('admin.index'); // view untuk admin
        }

        if (strtolower($user->level) === 'dokter') {
            return view('member.index'); // view untuk pengguna
        }
    });

    Route::get('/member', function () {
        return view('admin.member');
    });

    Route::get('/faq', [FAQController::class, 'index']);

    Route::get('/training', function () {
        return view('admin.training');
    });

    // Berita
    Route::get('/announcement', [AnnouncementController::class, 'index'])->name('announcement.index');
    Route::get('/announcement/{id}', [AnnouncementController::class, 'show'])->name('announcement.show');

    // Iuran
    Route::get('/pembayaran-iuran', [PembayaranIuranController::class, 'index']);
    Route::post('/iuran/update-status/{anggota}', [PembayaranIuranController::class, 'updateStatus']);

    Route::get('/pengajuan-admin', function () {
        return view('admin.pengajuan-admin');
    });
    Route::get('/pengajuan-anggota', function () {
        return view('admin.pengajuan-anggota');
    });
    Route::get('/workshops', function () {
        return view('admin.workshops');
    });
    Route::get('/news-management', function () {
        return view('admin.news-management');
    });
    Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index']);
});
