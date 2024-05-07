<?php

use App\Http\Controllers\api\loginController;
use App\Http\Controllers\api\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


route::post('/login', [loginController::class, "login"])->name("loginApi");
route::get('/profile', [ProfileController::class, "getProfile"])->name("profileApi");