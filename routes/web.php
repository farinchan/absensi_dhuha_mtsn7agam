<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HistoryAbsensiController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PiketController;
use App\Http\Controllers\SiswaController;
use App\Models\JadwalPiket;

route::get('/', function () {
    return redirect('dashboard');
    }
);

route::get('/login', [LoginController::class, 'loginForm'])->name('login')->middleware('guest');
route::post('/login', [LoginController::class, 'authenticate'])->name('login')->middleware('guest');
route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::apiResource('/admin', AdminController::class)->except('show');

Route::get('/dashboard', DashboardController::class)->name('dashboard')->middleware('auth');
route::get('/dashboard/siswaPerKelas', [DashboardController::class, "siswaPerKelas"])->name("dashboard.siswaPerKelas");
Route::get('/dashboard/statAbsenHariIni', [DashboardController::class, "statAbsenHariIni"])->name("dashboard.statAbsenHariIni");
Route::get('/dashboard/statAbsenSebulanTerakhir', [DashboardController::class, "statAbsenSebulanTerakhir"])->name("dashboard.statAbsenSebulanTerakhir");

route::apiResource('absensi', AbsensiController::class)->except('show')->middleware('auth');
route::get('/absensi/ajax', [AbsensiController::class, "ajax"])->name("absensi.ajax");
route::get('/absensi/laporan', [AbsensiController::class, "laporan"])->name("absensi.laporan");

route::get('/history', [HistoryAbsensiController::class, "index"])->name("history.index")->middleware('auth');
route::get('/history/ajax', [HistoryAbsensiController::class, "ajax"])->name("history.ajax");
route::delete('/history/{id}', [HistoryAbsensiController::class, "destroy"])->name("history.destroy");
route::get('/history/siswabyKelas', [HistoryAbsensiController::class, "siswabyKelas"])->name("history.siswabyKelas");

route::apiResource('guru', GuruController::class)->except('show')->middleware('auth');
route::post('/guru/import', [GuruController::class, "import"])->name("guru.import");
route::get('/guru/export', [GuruController::class, "export"])->name("guru.export");
route::get('/guru/laporan', [GuruController::class, "laporan"])->name("guru.laporan");


route::Resource('siswa', SiswaController::class)->except('show')->middleware('auth');
Route::get('siswa/ajax', [SiswaController::class , 'ajax'])->name('siswa.ajax')->middleware('auth');
route::get('/siswa/laporan', [SiswaController::class, "laporan"])->name("siswa.laporan");
route::get('/siswa/cetak_kartu', [SiswaController::class, "cetak_kartu"])->name("siswa.cetak_kartu");
route::get('/siswa/export', [SiswaController::class, "export"])->name("siswa.export");
route::post('/siswa/import', [SiswaController::class, "import"])->name("siswa.import");



route::apiResource('jadwal_piket', PiketController::class)->except('show')->middleware('auth');

route::apiResource('kelas', KelasController::class)->except('show')->middleware('auth');
route::get('/kelas/export', [KelasController::class, "export"])->name("kelas.export");



