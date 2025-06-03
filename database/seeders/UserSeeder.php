<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{   
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guru = Guru::all();
        $siswa = Siswa::all();

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin123'),
            'roles' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Hendra Gunawan Parulian, S.Pd., M.Pd',
            'email' => 'hendra@mail.com',
            'password' => Hash::make('hendra123'),
            'roles' => 'guru',
            'nip' => '198206212006041007',
        ]);

        DB::table('users')->insert([
            'name' => 'Maria Goretti S. Pd',
            'email' => 'maria@mail.com',
            'password' => Hash::make('maria123'),
            'roles' => 'guru',
            'nip' => '196502061989032003',
        ]);
       
        DB::table('users')->insert([
            'name' => 'Rizky Apryadi',
            'email' => 'riskiapriadi42@gmail.com',
            'password' => Hash::make('siswa123'),
            'roles' => 'siswa',
            'nis' => '52790516',
        ]);

        DB::table('users')->insert([
            'name' => 'Ferry B Siagian',
            'email' => 'ferry@gmail.com',
            'password' => Hash::make('siswa123'),
            'roles' => 'siswa',
            'nis' => '52790517',
        ]);

        // update user_id to guru table as user id
        foreach ($guru as $g) {
            DB::table('gurus')->where('nip', $g->nip)->update([
                'user_id' => DB::table('users')->where('nip', $g->nip)->first()->id
            ]);
        }

        // update user_id to siswa table as user id
        foreach ($siswa as $s) {
            DB::table('siswas')->where('nis', $s->nis)->update([
                'user_id' => DB::table('users')->where('nis', $s->nis)->first()->id
            ]);
        }
    }
}
