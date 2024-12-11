<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KinerjaController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard.index');

Route::get('/kinerja-pegawai/{id}', [KinerjaController::class, 'show'])->middleware('auth')->name('kinerja.show');
Route::get('/kinerja-pegawai/{id}/download', [KinerjaController::class, 'downloadLaporan'])->middleware('auth')->name('kinerja.download');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');