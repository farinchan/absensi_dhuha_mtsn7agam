<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;

route::get('/', function () {
    return redirect('dashboard');
}
);

Route::get('/dashboard', DashboardController::class)->name('dashboard');

route::resource('guru', GuruController::class);

route::Resource('siswa', SiswaController::class)->except('show');
Route::get('siswa/ajax', [SiswaController::class , 'ajax'])->name('siswa.ajax');

route::apiResource('kelas', KelasController::class)->except('show');


