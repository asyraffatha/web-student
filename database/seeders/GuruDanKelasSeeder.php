<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Support\Facades\Hash;

class GuruDanKelasSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat semua kelas dari 7.1 sampai 9.9
        for ($tingkat = 7; $tingkat <= 9; $tingkat++) {
            for ($sub = 1; $sub <= 9; $sub++) {
                Kelas::firstOrCreate(['nama' => "{$tingkat}.{$sub}"]);
            }
        }

        // 2. Daftar guru dan kelas yang diajarnya
        $dataGuru = [
            [
                'name' => 'Guru 1',
                'email' => 'guru1@example.com',
                'password' => 'passwordguru1',
                'kelas' => ['8.1', '8.2', '8.3','8.4'],
            ],
            [
                'name' => 'Guru 2',
                'email' => 'guru2@example.com',
                'password' => 'passwordguru2',
                'kelas' => ['7.1', '7.2', '7.3', '7.4'],
            ],
            [
                'name' => 'Guru 3',
                'email' => 'guru3@example.com',
                'password' => 'passwordguru3',
                'kelas' => ['9.1', '9.2', '9.3', '9.4'],
            ],
        ];

        // 3. Loop data guru dan simpan ke database
        foreach ($dataGuru as $data) {
            $guru = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make($data['password']),
                    'role' => 'guru',
                ]
            );

            $kelasIds = Kelas::whereIn('nama', $data['kelas'])->pluck('id')->toArray();
            $guru->kelasDiampu()->sync($kelasIds);
        }
    }
}


