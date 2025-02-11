<?php

use App\Http\Controllers\DataPasienController;
use App\Http\Controllers\PasienController;
use App\Models\AntrianPasien;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pasien', function () {
    return view('dataPasien');
})->name('cari.pasien');

Route::post('/cari-pasien', [PasienController::class, 'cariPasien'])->name('cari.pasien');

Route::post('/panggil/{nomor_rm}', [PasienController::class, 'panggilPasien'])->name('panggil.pasien');
Route::post('/selesai/{nomor_rm}', [PasienController::class, 'selesaiPasien'])->name('selesai.pasien');

Route::post('/reset-antrian', [PasienController::class, 'resetAntrian'])->name('reset.antrian');

Route::get('/data-antrian', [PasienController::class, 'tampilkanAntrian'])->name('data.antrian');
