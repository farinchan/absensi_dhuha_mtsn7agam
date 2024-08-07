<?php

use App\Http\Controllers\api\AbsensiController;
use App\Http\Controllers\api\loginController;
use App\Http\Controllers\api\piketController;
use App\Http\Controllers\api\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


route::post('/login', [loginController::class, "login"])->name("loginApi");
route::get('/profile', [ProfileController::class, "getProfile"])->name("profileApi");
route::get('/jadwal_Piket', [PiketController::class, "getJadwal"])->name("jadwalPiketApi");
route::post('/scan', [AbsensiController::class, "scan"])->name("scanApi");
route::post('/scanHaid', [AbsensiController::class, "scanHaid"])->name("scanHaidApi");
route::get('/historyAbsensi', [AbsensiController::class, "historyAbsensi"])->name("historyAbsensiApi");
route::get('/checkSiswa', [AbsensiController::class, "checkSiswa"])->name("checkSiswaApi");
route::get('/listKelas', [AbsensiController::class, "listKelas"])->name("listKelasApi");