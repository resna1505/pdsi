<?php

use App\Http\Controllers\AboutController as ControllersAboutController;
use App\Http\Controllers\AgendaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\EditProfileController;
use App\Http\Controllers\FAQDokterController;
use App\Http\Controllers\MasterIuranController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\PembayaranIuranController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ProfileDokterController;
use App\Http\Controllers\ProgramKerjaController as ControllersProgramKerjaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifikasiIuranController;
use App\Http\Controllers\VisiMisiValueController;
use App\Http\Controllers\WorkshopsController;
use App\Models\Workshops;

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

Route::get('/migrate', function () {
    Artisan::call('migrate');
    return "Migrasi database berhasil tanpa menghapus data!";
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
    Route::get('/index', function () {
        return redirect('/');
    });
    Route::get('/', function () {
        $user = Auth::user();
        if (strtolower($user->level) === 'admin') {
            return view('admin.index');
        }

        if (strtolower($user->level) === 'dokter') {
            return view('member.index');
        }
    });

    Route::get('/training', [ProductController::class, 'index'])->name('training.index');
    Route::get('/workshop/{id}', [ProductDetailController::class, 'index'])->name('workshop.index');
    Route::post('/comments', [ProductDetailController::class, 'store'])->name('comments.store');

    // -> Dokter
    // Profile
    Route::get('/profile-dokter', [ProfileDokterController::class, 'index'])->name('profile-dokter.index');
    Route::post('/documents', [ProfileDokterController::class, 'store'])->name('documents.store');
    Route::get('/documents/{id}/view', [ProfileDokterController::class, 'view'])->name('documents.view');
    Route::get('/documents/{id}/download', [ProfileDokterController::class, 'download'])->name('documents.download');
    Route::delete('/documents/{id}', [ProfileDokterController::class, 'destroy'])->name('documents.destroy');

    Route::get('/edit-profile-dokter', [EditProfileController::class, 'index'])->name('edit-profile-dokter.index');
    Route::post('/edit-profile-dokter', [EditProfileController::class, 'update'])->name('edit-profile-dokter.update');
    Route::post('/change-password', [EditProfileController::class, 'changePassword'])->name('change-password');
    Route::put('/edit-photo-dokter/{id}', [EditProfileController::class, 'updatePhoto'])->name('edit-photo-dokter.update');

    // Berita
    Route::get('/announcement', [AnnouncementController::class, 'index'])->name('announcement.index');
    Route::get('/announcement/{id}', [AnnouncementController::class, 'show'])->name('announcement.show');

    // Iuran
    Route::get('/pembayaran-iuran', [PembayaranIuranController::class, 'index']);
    Route::post('/iuran/update-status-payment', [PembayaranIuranController::class, 'updateStatusPayment'])->name('iuran.updateStatusPayment');
    Route::post('/iuran/update-status', [PembayaranIuranController::class, 'updateStatus'])->name('iuran.updateStatus');
    Route::post('/iuran/update-status-with-payment', [PembayaranIuranController::class, 'updateStatusWithPayment'])->name('iuran.updateStatusWithPayment');

    // FAQ
    Route::get('/faq-dokter', [FAQDokterController::class, 'index']);

    // -> Admin
    // Workshop
    // Route::get('/workshops', function () {
    //     return view('admin.workshops');
    // });
    Route::get('/workshops', [WorkshopsController::class, 'index']);
    Route::post('/workshops', [WorkshopsController::class, 'store'])->name('workshops.store');
    Route::delete('/workshops/{id}', [WorkshopsController::class, 'destroy'])->name('workshops.destroy');
    Route::get('/workshops/{id}/edit', [WorkshopsController::class, 'edit'])->name('workshops.edit');
    Route::put('/workshops/{id}', [WorkshopsController::class, 'update'])->name('workshops.update');

    Route::get('/member', [MemberController::class, 'index']);
    Route::get('/member/{id}', [MemberController::class, 'show'])->name('member.show');

    Route::get('/user', [UserController::class, 'index']);
    Route::post('/verifikasi-user/{id}', [UserController::class, 'verifikasi']);
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/verifikasi-iuran', [VerifikasiIuranController::class, 'index']);
    Route::post('/data-verifikasi-iuran/{id}', [VerifikasiIuranController::class, 'verifikasi']);
    Route::delete('/verifikasi-iuran/{id}', [VerifikasiIuranController::class, 'destroy'])->name('verifikasi-iuran.destroy');

    Route::get('/masteriuran', [MasterIuranController::class, 'index']);
    Route::post('/masteriuran', [MasterIuranController::class, 'store'])->name('masteriuran.store');
    Route::delete('/masteriuran/{id}', [MasterIuranController::class, 'destroy'])->name('masteriuran.destroy');
    Route::get('/masteriuran/{id}/edit', [MasterIuranController::class, 'edit'])->name('masteriuran.edit');
    Route::put('/masteriuran/{id}', [MasterIuranController::class, 'update'])->name('masteriuran.update');

    // Profile
    Route::get('/articles', [ArticleController::class, 'index']);
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');

    Route::get('/agenda', [AgendaController::class, 'index']);
    Route::post('/agenda', [AgendaController::class, 'store'])->name('agenda.store');
    Route::delete('/agenda/{id}', [AgendaController::class, 'destroy'])->name('agenda.destroy');
    Route::get('/agenda/{id}/edit', [AgendaController::class, 'edit'])->name('agenda.edit');
    Route::put('/agenda/{id}', [AgendaController::class, 'update'])->name('agenda.update');

    Route::get('/mitra', [MitraController::class, 'index']);
    Route::post('/mitra', [MitraController::class, 'store'])->name('mitra.store');
    Route::delete('/mitra/{id}', [MitraController::class, 'destroy'])->name('mitra.destroy');
    Route::get('/mitra/{id}/edit', [MitraController::class, 'edit'])->name('mitra.edit');
    Route::put('/mitra/{id}', [MitraController::class, 'update'])->name('mitra.update');

    Route::get('/about', [ControllersAboutController::class, 'index']);
    Route::post('/about', [ControllersAboutController::class, 'store'])->name('about.store');
    Route::delete('/about/{id}', [ControllersAboutController::class, 'destroy'])->name('about.destroy');
    Route::get('/about/{id}/edit', [ControllersAboutController::class, 'edit'])->name('about.edit');
    Route::put('/about/{id}', [ControllersAboutController::class, 'update'])->name('about.update');

    Route::get('/about/{id}/editmetode', [ControllersAboutController::class, 'editmetode'])->name('about.editmetode');
    Route::put('/metode/{id}', [ControllersAboutController::class, 'updatemetode'])->name('about.updatemetode');

    Route::post('/galeri', [ControllersAboutController::class, 'storegaleri'])->name('galeri.storegaleri');
    Route::get('/galeri/{id}/editgaleri', [ControllersAboutController::class, 'editgaleri'])->name('about.editgaleri');
    Route::put('/galeri/{id}', [ControllersAboutController::class, 'updategaleri'])->name('galeri.updategaleri');

    Route::get('/visimisi', [VisiMisiValueController::class, 'index']);
    Route::post('/visimisi', [VisiMisiValueController::class, 'store'])->name('visimisi.store');
    Route::delete('/visimisi/{id}', [VisiMisiValueController::class, 'destroy'])->name('visimisi.destroy');
    Route::get('/visimisi/{id}/edit', [VisiMisiValueController::class, 'edit'])->name('visimisi.edit');
    Route::put('/visimisi/{id}', [VisiMisiValueController::class, 'update'])->name('visimisi.update');

    Route::get('/programkerja', [ControllersProgramKerjaController::class, 'index']);
    Route::post('/programkerja', [ControllersProgramKerjaController::class, 'store'])->name('programkerja.store');
    Route::delete('/programkerja/{id}', [ControllersProgramKerjaController::class, 'destroy'])->name('programkerja.destroy');
    Route::get('/programkerja/{id}/edit', [ControllersProgramKerjaController::class, 'edit'])->name('programkerja.edit');
    Route::put('/programkerja/{id}', [ControllersProgramKerjaController::class, 'update'])->name('programkerja.update');

    Route::get('/faq', [FAQController::class, 'index']);
    Route::post('/faq', [FAQController::class, 'store'])->name('faq.store');
    Route::delete('/faq/{id}', [FAQController::class, 'destroy'])->name('faq.destroy');
    Route::get('/faq/{id}/edit', [FAQController::class, 'edit'])->name('faq.edit');
    Route::put('/faq/{id}', [FAQController::class, 'update'])->name('faq.update');

    Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index']);
});
