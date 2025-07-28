<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\BalitaOrangtua;
use Illuminate\Support\Facades\Hash;

class DummySeeder extends Seeder
{
    public function run(): void
    {
        $kader = User::create([
            'nik_ortu' => '1234567890123456',
            'nama_ortu' => 'Kader Posyandu',
            'password' => Hash::make('password'),
            'role' => 'kader',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Contoh Kader',
            'rt' => '01',
            'rw' => '03',
        ]);

        $ortu = User::create([
            'nik_ortu' => '1111222233334444',
            'nama_ortu' => 'Ibu Bayi',
            'password' => Hash::make('password'),
            'role' => 'orangtua',
            'no_hp' => '089876543210',
            'alamat' => 'Jl. Contoh Ibu',
            'rt' => '02',
            'rw' => '03',
        ]);

        BalitaOrangtua::create([
            'anak_ke' => 1,
            'nomor_kk' => '1234567890',
            'nik_balita' => '3216549876543210',
            'nama_balita' => 'Bayi Contoh',
            'tgl_lahir' => '2022-05-01',
            'jenis_kelamin' => 'Laki-laki',
            'bbl' => 3.5,
            'pbl' => 50.0,
            'user_id' => $ortu->user_id
        ]);
    }
}
