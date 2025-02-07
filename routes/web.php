<?php

use App\Http\Controllers\DataPasienController;
use App\Http\Controllers\PasienController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/datapasien',[DataPasienController::class, 'dataPasien']);

Route::get('/cari-pasien', function () {
    return view('dataPasien');
})->name('cari.pasien');

Route::post('/cari-pasien', [PasienController::class, 'cariPasien'])->name('cari.pasien');

Route::post('/reset-antrian', function () {
    session()->forget('antrian');
    return redirect()->back();
})->name('reset.antrian');

Route::post('/panggil-pasien/{nomor_rm}', [PasienController::class, 'panggilPasien'])->name('panggil.pasien');
Route::post('/selesai-pasien/{nomor_rm}', [PasienController::class, 'selesaiPasien'])->name('selesai.pasien');
