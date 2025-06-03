<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gurus')->insert([
            'nama' => 'Hendra Gunawan Parulian, S.Pd., M.Pd',
            'nip' => '198206212006041007',
            'mapel_id' => 1,
            'no_telp' => '081234567890',
            'alamat' => 'Jl. Budi Santoso',
        ]);

        DB::table('gurus')->insert([
            'nama' => 'Maria Goretti S. Pd',
            'nip' => '196502061989032003',
            'mapel_id' => 2,
            'no_telp' => '089876543210',
            'alamat' => 'Jl. Gunawan Efendi',
        ]);
    }
}