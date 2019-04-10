<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => '1134010039',
            'name' => 'Supardi',
            'email' => 'supardi@supardi.com',
            'password' => bcrypt('1134010039'),
            'level' => 'kepala_sekolah',
            'nomor_telepon' => '081111111111',
            'alamat' => 'Jl Alpukat',
        ],
        [
            'username' => '1234010039',
            'name' => 'Lia Andriani',
            'email' => 'liaandriani@liaandriani.com',
            'password' => bcrypt('1234010039'),
            'level' => 'guru_bk',
            'nomor_telepon' => '081111111112',
            'alamat' => 'Jl Mangga',
        ],
        [
            'username' => '1334010039',
            'name' => 'Tuti Wibowo',
            'email' => 'tutiwibowo@tutiwibowo.com',
            'password' => bcrypt('1334010039'),
            'level' => 'guru',
            'nomor_telepon' => '081111111113',
            'alamat' => 'Jl Apel',
        ],
        [
            'username' => '1434010039',
            'name' => 'Suwandi',
            'email' => 'suwandi@suwandi.com',
            'password' => bcrypt('1434010039'),
            'level' => 'guru',
            'nomor_telepon' => '081111111114',
            'alamat' => 'Jl Melon',
        ],
        [
            'username' => '1534010039',
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('1534010039'),
            'level' => 'admin',
            'nomor_telepon' => '081111111115',
            'alamat' => 'Jl Rambutan',
        ]);
    }
}
