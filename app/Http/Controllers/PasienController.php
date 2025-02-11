<?php

namespace App\Http\Controllers;

use App\Models\DataPasien;
use App\Models\AntrianPasien;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function cariPasien(Request $request){
        $request->validate([
            'nomor_rm' => 'required|string'
        ]);

        // Cari pasien berdasarkan Nomor RM
        $pasien = DataPasien::where('nomor_rm', $request->nomor_rm)->first();

        if (!$pasien) {
            return redirect()->back()->with('error', 'Data pasien tidak ditemukan.');
        }

        // Simpan ke database antrian jika belum ada
        $existingAntrian = AntrianPasien::where('nomor_rm', $pasien->nomor_rm)
                                        ->whereDate('waktu_antrian', Carbon::today())
                                        ->first();

        if (!$existingAntrian) {
            AntrianPasien::create([
                'nomor_rm'     => $pasien->nomor_rm,
                'waktu_antrian'=> Carbon::now(),
                'nama_pasien'  => $pasien->nama_pasien,
                'nama_dokter'  => $pasien->nama_dokter,
                'asal_pasien'  => $pasien->asal_pasien,
                'status'       => 'Menunggu',
            ]);
        }

        return redirect()->back();
    }

    // Fungsi untuk menampilkan daftar antrian
    public function tampilkanAntrian(){
        $antrian = AntrianPasien::whereDate('waktu_antrian', Carbon::today())->get();
        return view('dataPasien', compact('antrian'));
    }

    public function resetAntrian(){
        // Reset semua antrian ke status default atau hapus
        AntrianPasien::whereDate('waktu_antrian', now()->toDateString())->delete();

        return redirect()->back()->with('success', 'Antrian berhasil direset.');
    }

    public function panggilPasien($nomor_rm) {
        $pasien = AntrianPasien::where('nomor_rm', $nomor_rm)->first();
        if ($pasien) {
            $pasien->update(['status' => 'Dipanggil']);
        }
        return redirect()->back()->with('success', 'Pasien telah dipanggil.');
    }

    public function selesaiPasien($nomor_rm) {
        $pasien = AntrianPasien::where('nomor_rm', $nomor_rm)->first();
        if ($pasien) {
            $pasien->update(['status' => 'Selesai']);
        }
        return redirect()->back()->with('success', 'Pasien telah selesai.');
    }
}
