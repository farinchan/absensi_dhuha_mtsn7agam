<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard;

route::get('/', function () {
    return route('dashboard');
}
);

Route::get('/dashboard', dashboard::class)->name('dashboard');


