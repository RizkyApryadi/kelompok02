<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mapels')->insert([
            'nama_mapel' => 'Bahasa Inggris',
            'jurusan_id' => 1,
        ]);

        DB::table('mapels')->insert([
            'nama_mapel' => 'Bahasa Indonesia',
            'jurusan_id' => 2,
        ]);

        // DB::table('mapels')->insert([
        //     'nama_mapel' => 'Pendidikan Agama dan Budi Pekerti',
        //     'jurusan_id' => 1,
        // ]);

        // DB::table('mapels')->insert([
        //     'nama_mapel' => 'Pendidikan Pancasila',
        //     'jurusan_id' => 2,
        // ]);
        // DB::table('mapels')->insert([
        //     'nama_mapel' => 'Pendidikan Jasmani, Olahraga dan Kesehatan',
        //     'jurusan_id' => 1,
        // ]);
        // DB::table('mapels')->insert([
        //     'nama_mapel' => 'Sejarah',
        //     'jurusan_id' => 2,
        // ]);
        // DB::table('mapels')->insert([
        //     'nama_mapel' => 'P5',
        //     'jurusan_id' => 2,
        // ]);
        // DB::table('mapels')->insert([
        //     'nama_mapel' => 'Prakarya',
        //     'jurusan_id' => 1,
        // ]);
        // DB::table('mapels')->insert([
        //     'nama_mapel' => 'Seni Budaya',
        //     'jurusan_id' => 2,
        // ]);
        
    }
}
