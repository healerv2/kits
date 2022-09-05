<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'id' => 1,
            'nama_komunitas' => 'KITS SMKN 1 Nglegok',
            'nama_pembina' => 'Very Setiawan',
            'alamat' => 'Jl. Raya Penataran No.1, Nglegok, Kec. Nglegok, Kabupaten Blitar',
            'telepon' => '085123332112',
            'path_logo' => '/logo/kits.png',
        ]);
    }
}
