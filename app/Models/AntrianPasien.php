<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntrianPasien extends Model
{
    use HasFactory;

    protected $table = 'antrian_pasien';
    protected $fillable = ['nomor_rm', 'nama_pasien', 'nama_dokter', 'asal_pasien', 'waktu_antrian', 'status'];
}
