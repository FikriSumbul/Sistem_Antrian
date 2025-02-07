<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Container\Attributes\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('data_pasien')->insert([
            'nomor_rm' => '00147653',
            'nama_pasien' => 'Rapi Duruk'
        ]);
    }
}
