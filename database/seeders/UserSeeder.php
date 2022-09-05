<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = array(
            [
                'name' => 'Administrator',
                'email' => 'alumni.kits.nglegok@gmail.com',
                'password' => bcrypt('123'),
                'level' => 1,
                'status_akun' => 'superadmin',
                'foto' => '/img/user.png',
                'aktivitas' => 'bekerja',
                'detail_aktivitas' => 'Web Developer',
            ],
            [
                'name' => 'pembina',
                'email' => 'taufikrizal43@gmail.com',
                'password' => bcrypt('123'),
                'level' => 2,
                'status_akun' => 'pembina',
                'foto' => '/img/user.png',
                'detail_aktivitas' => 'Pembina KITS',
            ],
            [
                'name' => 'alumni',
                'email' => 'cinecharmpayment@gmail.com',
                'password' => bcrypt('123'),
                'level' => 3,
                'status_akun' => 'alumni',
                'foto' => '/img/user.png',
                'aktivitas' => 'bekerja',
                'detail_aktivitas' => 'Kuliah di UB Malang Jurusan TI',
            ],
            [
                'name' => 'siswa',
                'email' => 'siswa@gmail.com',
                'password' => bcrypt('123'),
                'level' => 4,
                'status_akun' => 'siswa',
                'foto' => '/img/user.png',
                'aktivitas' => 'siswa',
                'detail_aktivitas' => 'Anggota KITS',
            ]
        );

        array_map(function (array $user) {
            User::query()->updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }, $users);
    }
}
