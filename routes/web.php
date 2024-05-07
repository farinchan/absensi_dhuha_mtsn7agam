<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HistoryAbsensiController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;

route::get('/', function () {
    return redirect('dashboard');
    }
);

route::get('/login', [LoginController::class, 'loginForm'])->name('login')->middleware('guest');
route::post('/login', [LoginController::class, 'authenticate'])->name('login')->middleware('guest');
route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::apiResource('/admin', AdminController::class)->except('show')->middleware('auth');

Route::get('/dashboard', DashboardController::class)->name('dashboard')->middleware('auth');

route::apiResource('absensi', AbsensiController::class)->except('show')->middleware('auth');
route::get('/history', [HistoryAbsensiController::class, "index"])->name("history.index")->middleware('auth');

route::apiResource('guru', GuruController::class)->except('show')->middleware('auth');

route::Resource('siswa', SiswaController::class)->except('show')->middleware('auth');
Route::get('siswa/ajax', [SiswaController::class , 'ajax'])->name('siswa.ajax')->middleware('auth');

route::apiResource('kelas', KelasController::class)->except('show')->middleware('auth');


