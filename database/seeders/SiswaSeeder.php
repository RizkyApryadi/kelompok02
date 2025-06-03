<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('siswas')->insert([
            'nama' => 'Rizky Apryadi',
            'nis' => '52790516',
            'kelas_id' => 1,
            'telp' => '082272139162',
            'alamat' => 'Soposurung',
        ]);

        DB::table('siswas')->insert([
            'nama' => 'Ferry B Siagian',
            'nis' => '52790517',
            'kelas_id' => 2,
            'telp' => '089876543210',
            'alamat' => 'Bondol',
        ]);
    }
}
