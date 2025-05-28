<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuizResult;
use App\Models\User; // Kalau mau sekalian buat dummy user
use Illuminate\Support\Facades\Hash;

class FullQuizSeeder extends Seeder
{
    public function run(): void
{
    // Seeder ini tidak lagi digunakan karena kuis dibuat langsung oleh guru.
}
}
