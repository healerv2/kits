<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('kategori')->insert([
            'id' => 1,
            'nama_kategori' => 'Administrasi Infrastruktur Jaringan',
            'kode_kategori' => 'C32',
            'note_kategori' => 'Administrasi Infrastruktur Jaringan',
        ]);
    }
}
