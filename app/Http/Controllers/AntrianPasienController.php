<?php

namespace App\Http\Controllers;

use App\Models\AntrianPasien;
use Illuminate\Http\Request;

class AntrianPasienController extends Controller
{
    /**
     * Menampilkan daftar antrian pasien.
     */
    public function antrianPasien()
    {
        // Mengambil semua data antrian pasien
        $antrianPasien = AntrianPasien::orderBy('waktu_antrian', 'asc')->get();
        // Mengirim data ke view
        return view('halamanClient', compact('antrianPasien'));
    }
}
