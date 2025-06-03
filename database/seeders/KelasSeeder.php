<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kelas')->insert([
            'nama_kelas' => '10 MIA 5',
            'jurusan_id' => 1,
            'guru_id' => 1,
        ]);

        DB::table('kelas')->insert([
            'nama_kelas' => '10 IIS 1',
            'jurusan_id' => 2,
            'guru_id' => 2,
        ]);
    }
}
