<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(FullQuizSeeder::class);

         $this->call([
        GuruDanKelasSeeder::class,
        AdminSeeder::class,
    ]);
    }
}
