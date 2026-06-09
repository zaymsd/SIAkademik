<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;

// ── Root ──────────────────────────────────────────────────────────────────
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// ── Autentikasi ───────────────────────────────────────────────────────────
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ── Halaman yang Membutuhkan Login ────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/jurusan/cetak-csv', [JurusanController::class, 'exportCsv'])->name('jurusan.export-csv');
    Route::get('/jurusan/cetak-pdf', [JurusanController::class, 'print'])->name('jurusan.print');
    Route::get('/jurusan/export-excel', [JurusanController::class, 'exportExcel'])->name('jurusan.export-excel');
    Route::resource('jurusan', JurusanController::class);
    Route::get('/mahasiswa/cetak-csv', [MahasiswaController::class, 'exportCsv'])->name('mahasiswa.export-csv');
    Route::get('/mahasiswa/cetak-pdf', [MahasiswaController::class, 'print'])->name('mahasiswa.print');
    Route::get('/mahasiswa/export-excel', [MahasiswaController::class, 'exportExcel'])->name('mahasiswa.export-excel');
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::get('/matakuliah/cetak-csv', [MatakuliahController::class, 'exportCsv'])->name('matakuliah.export-csv');
    Route::get('/matakuliah/cetak-pdf', [MatakuliahController::class, 'print'])->name('matakuliah.print');
    Route::get('/matakuliah/export-excel', [MatakuliahController::class, 'exportExcel'])->name('matakuliah.export-excel');
    Route::resource('matakuliah', MatakuliahController::class);
});
