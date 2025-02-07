<?php

namespace App\Http\Controllers;

use App\Models\DataPasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    // public function cariPasien(Request $request){
    //     $request->validate([
    //         'nomor_rm' => 'required|string'
    //     ]);
    //     $datapasien = DataPasien::where('nomor_rm', $request->nomor_rm)->get();
    //     return view('dataPasien', compact('datapasien'));
    // }

    public function cariPasien(Request $request){
        $request->validate([
            'nomor_rm' => 'required|string'
        ]);

        // Cari pasien berdasarkan Nomor RM
        $pasien = DataPasien::where('nomor_rm', $request->nomor_rm)->first();

        if (!$pasien) {
            return redirect()->back()->with('error', 'Data pasien tidak ditemukan.');
        }

        // Ambil antrian pasien dari session (jika ada)
        $antrian = session()->get('antrian', []);

        // Cek apakah pasien sudah ada dalam antrian
        $exists = collect($antrian)->contains('nomor_rm', $pasien->nomor_rm);

        if (!$exists) {
            // Tambahkan pasien baru ke antrian
            $antrian[] = [
                'nomor_rm' => $pasien->nomor_rm,
                'nama_pasien' => $pasien->nama_pasien,
                'nama_dokter' => $pasien->nama_dokter,
                'asal_pasien' => $pasien->asal_pasien,
            ];

            // Simpan kembali ke session
            session()->put('antrian', $antrian);
        }

        return redirect()->back();
    }

    public function panggilPasien($nomor_rm){
        // Ambil antrian dari session
        $antrian = session()->get('antrian', []);

        // Cari pasien berdasarkan nomor RM dan ubah statusnya
        foreach ($antrian as $key => $pasien) {
            if ($pasien['nomor_rm'] === $nomor_rm) {
                $antrian[$key]['status'] = 'Dipanggil';
                break;
            }
        }

        // Simpan kembali ke session
        session()->put('antrian', $antrian);

        return redirect()->back()->with('success', 'Pasien telah dipanggil.');
    }

    public function selesaiPasien($nomor_rm){
        // Ambil antrian dari session
        $antrian = session()->get('antrian', []);

        // Cari pasien berdasarkan nomor RM dan ubah statusnya
        foreach ($antrian as $key => $pasien) {
            if ($pasien['nomor_rm'] === $nomor_rm) {
                $antrian[$key]['status'] = 'Selesai';
                break;
            }
        }

        // Simpan kembali ke session
        session()->put('antrian', $antrian);

        return redirect()->back()->with('success', 'Pasien telah selesai.');
    }
}
