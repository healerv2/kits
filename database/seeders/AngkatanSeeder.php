<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AngkatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('angkatan')->insert([
            'id' => 1,
            'nama_angkatan' => 'Angkatan 1 KITS',
            'note_angkatan' => '2013-2014',
        ]);
    }
}
