<?php

use App\Http\Controllers\Api\Profile\aboutController;
use App\Http\Controllers\Api\Profile\AgendaController;
use App\Http\Controllers\Api\Profile\DokterController;
use App\Http\Controllers\Api\Profile\FaqController;
use App\Http\Controllers\Api\Profile\indexController;
use App\Http\Controllers\Api\Profile\NewsController;
use App\Http\Controllers\Api\Profile\ProgramKerjaController;
use App\Http\Controllers\Api\Profile\StrukturController;
use App\Http\Controllers\VisiMisiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/index', [indexController::class, 'index']);
Route::get('/about', [aboutController::class, 'index']);
Route::get('/visimisi', [VisiMisiController::class, 'index']);
Route::get('/dokter', [DokterController::class, 'index']);
Route::get('/program-kerja', [ProgramKerjaController::class, 'index']);
Route::get('/faqs', [FaqController::class, 'index']);
Route::get('/news', [NewsController::class, 'index']);
Route::get('/agenda', [AgendaController::class, 'index']);
Route::get('/struktur', [StrukturController::class, 'index']);
