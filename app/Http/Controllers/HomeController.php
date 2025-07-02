<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Quiz;
use App\Models\TekaTekiResult;
use Illuminate\Support\Facades\Auth;
use App\Models\QuizResult;
use Carbon\Carbon;

class HomeController extends Controller
{
  public function index()
{
   $user = Auth::user(); // <-- Tambahkan baris ini

    $kelasNama = $user->kelas; // misal: "8.1"
    $kelasObj = \App\Models\Kelas::where('nama', $kelasNama)->first();
    $kelasId = $kelasObj ? $kelasObj->id : null;    

    $now = Carbon::now();

    $materis = Materi::where('kelas', $kelasId)
        ->whereNotNull('deadline')
        ->where('deadline', '>', $now) // hanya ambil materi yang deadlinenya belum lewat
        ->orderBy('deadline')
        ->get();

    $quizzes = Quiz::where('kelas', $kelasId)
        ->whereNotNull('deadline')
        ->where('deadline', '>', $now) // hanya ambil kuis yang deadlinenya belum lewat
        ->orderBy('deadline')
        ->get();


    // Ambil guru jika user adalah siswa
    $guru = null;
    if ($user->role === 'siswa') {
        // Sederhananya ambil satu guru saja
        $guru = \App\Models\User::where('role', 'guru')->first(); 
        // Nanti bisa kamu sesuaikan berdasarkan relasi siswa-kelas-guru
    }

    // Progress Teka-Teki
    $totalTekaTeki = \App\Models\Quiz::where('type', 'teka-teki')->count();
    $tekaTekiPassed = 0;
    $canAccessBossQuiz = false;
    if ($user->role === 'siswa') {
        $tekaTekiPassed = \App\Models\TekaTekiResult::where('user_id', $user->id)
            ->where('passed', true)
            ->count();
        $canAccessBossQuiz = ($totalTekaTeki > 0) && ($tekaTekiPassed == $totalTekaTeki);
    }

     // ✅ Tambahkan perhitungan kuis selesai
    $totalKuisSelesai = QuizResult::where('user_id', $user->id)
                            ->whereNotNull('score') // asumsi score = kuis selesai
                            ->count();

    $kuisSebelumnya = QuizResult::where('user_id', $user->id)
                            ->whereNotNull('score')
                            ->whereBetween('completed_at', [now()->subWeeks(2), now()->subWeek()])
                            ->count();

    // ✅ Tambahkan rata-rata nilai kuis
    $rataRataNilai = QuizResult::where('user_id', $user->id)
                    ->whereNotNull('score')
                    ->avg('score') ?? 0;

    $nilaiSebelumnya = QuizResult::where('user_id', $user->id)
                    ->whereNotNull('score')
                    ->whereBetween('completed_at', [now()->subWeeks(2), now()->subWeek()])
                    ->avg('score') ?? 0;

                    // Hitung total quiz dan materi untuk kelas user
$totalQuiz = Quiz::where('kelas', $kelasId)->count();
$totalMateri = Materi::where('kelas', $kelasId)->count();

// Hitung quiz yang sudah dikerjakan user
$quizSelesai = QuizResult::where('user_id', $user->id)->whereNotNull('score')->count();

// Jika ingin tracking materi yang sudah dibaca, tambahkan logika di sini
$materiSelesai = 0; // Jika belum ada tracking, biarkan 0

// Hitung progress
$totalTask = $totalQuiz + $totalMateri;
$doneTask = $quizSelesai + $materiSelesai;
$progress = $totalQuiz > 0 ? round(($quizSelesai / $totalQuiz) * 100) : 0;

                    // Tips Belajar Harian
$tips = [
    [
        'judul' => 'Teknik Pomodoro untuk Matematika',
        'deskripsi' => 'Belajar selama 25 menit, istirahat 5 menit. Ulangi 4 kali untuk hasil optimal!',
        'tags' => ['#FokusBelajar', '#TipsEfektif'],
        'icon' => 'fas fa-brain',
        'warna' => 'from-indigo-400 to-indigo-600'
    ],
    [
        'judul' => 'Buat Catatan Ringkas',
        'deskripsi' => 'Menuliskan ulang materi membantu memperkuat ingatanmu.',
        'tags' => ['#CatatanPintar', '#BelajarCerdas'],
        'icon' => 'fas fa-pencil-alt',
        'warna' => 'from-yellow-400 to-yellow-600'
    ],
    [
        'judul' => 'Jauhkan Gangguan Digital',
        'deskripsi' => 'Matikan notifikasi ponsel saat belajar agar lebih fokus.',
        'tags' => ['#BelajarTanpaGangguan', '#Produktif'],
        'icon' => 'fas fa-mobile-alt',
        'warna' => 'from-pink-400 to-pink-600'
    ],
    // Tambahkan tips lainnya jika kamu mau
];

// Pilih tips berdasarkan hari (otomatis ganti tiap hari)
$index = now()->dayOfWeek % count($tips);
$todayTip = $tips[$index];
// Tips Belajar Harian
$tips = [
    [
        'judul' => 'Teknik Pomodoro untuk Matematika',
        'deskripsi' => 'Belajar selama 25 menit, istirahat 5 menit. Ulangi 4 kali untuk hasil optimal!',
        'tags' => ['#FokusBelajar', '#TipsEfektif'],
        'icon' => 'fas fa-brain',
        'warna' => 'from-indigo-400 to-indigo-600'
    ],
    [
        'judul' => 'Buat Catatan Ringkas',
        'deskripsi' => 'Menuliskan ulang materi membantu memperkuat ingatanmu.',
        'tags' => ['#CatatanPintar', '#BelajarCerdas'],
        'icon' => 'fas fa-pencil-alt',
        'warna' => 'from-yellow-400 to-yellow-600'
    ],
    [
        'judul' => 'Jauhkan Gangguan Digital',
        'deskripsi' => 'Matikan notifikasi ponsel saat belajar agar lebih fokus.',
        'tags' => ['#BelajarTanpaGangguan', '#Produktif'],
        'icon' => 'fas fa-mobile-alt',
        'warna' => 'from-pink-400 to-pink-600'
    ],
   [
        'judul' => 'Jauhkan Gangguan Digital',
        'deskripsi' => 'Matikan notifikasi ponsel saat belajar agar lebih fokus.',
        'tags' => ['#BelajarTanpaGangguan', '#Produktif'],
        'icon' => 'fas fa-mobile-alt',
        'warna' => 'from-pink-400 to-pink-600'
    ],
    [
        'judul' => 'Belajar di Pagi Hari',
        'deskripsi' => 'Pagi hari adalah waktu terbaik karena otak masih segar dan belum banyak distraksi.',
        'tags' => ['#PagiProduktif', '#OtakSegar'],
        'icon' => 'fas fa-sun',
        'warna' => 'from-orange-400 to-orange-600'
    ],
    [
        'judul' => 'Latihan Soal Rutin',
        'deskripsi' => 'Semakin sering latihan soal, semakin terbiasa kamu dengan pola-pola matematika.',
        'tags' => ['#LatihanSoal', '#RutinBelajar'],
        'icon' => 'fas fa-calculator',
        'warna' => 'from-green-400 to-green-600'
    ],
    [
        'judul' => 'Tidur yang Cukup',
        'deskripsi' => 'Tidur minimal 7-8 jam agar otak mampu menyimpan informasi secara optimal.',
        'tags' => ['#IstirahatItuPenting', '#KesehatanBelajar'],
        'icon' => 'fas fa-bed',
        'warna' => 'from-purple-400 to-purple-600'
    ],
   [
        'judul' => 'Pahami Konsep, Bukan Hafalan',
        'deskripsi' => 'Matematika bukan soal menghafal rumus, tapi memahami konsep di baliknya.',
        'tags' => ['#PahamiDulu', '#BelajarCerdas'],
        'icon' => 'fas fa-lightbulb',
        'warna' => 'from-yellow-400 to-yellow-600'
    ],
    [
        'judul' => 'Kerjakan dari Soal Mudah Dulu',
        'deskripsi' => 'Mulai dari soal yang mudah untuk membangun rasa percaya diri.',
        'tags' => ['#StepByStep', '#Confidence'],
        'icon' => 'fas fa-arrow-down',
        'warna' => 'from-indigo-400 to-indigo-600'
    ],
    [
        'judul' => 'Gunakan Warna dalam Catatan Rumus',
        'deskripsi' => 'Gunakan stabilo warna-warni agar rumus lebih mudah diingat dan menarik untuk dibaca.',
        'tags' => ['#RumusBerwarna', '#VisualMath'],
        'icon' => 'fas fa-palette',
        'warna' => 'from-pink-400 to-pink-600'
    ],
    [
        'judul' => 'Bahas Soal Bersama Teman',
        'deskripsi' => 'Diskusi soal sulit bisa membantumu memahami cara berpikir yang berbeda.',
        'tags' => ['#DiskusiMatematika', '#TeamLearning'],
        'icon' => 'fas fa-users',
        'warna' => 'from-purple-400 to-purple-600'
    ],
    [
        'judul' => 'Gunakan Video YouTube untuk Visualisasi',
        'deskripsi' => 'Banyak channel matematika yang menjelaskan materi dengan visual menarik.',
        'tags' => ['#BelajarOnline', '#MathVisual'],
        'icon' => 'fab fa-youtube',
        'warna' => 'from-red-400 to-red-600'
    ],
    [
        'judul' => 'Jangan Takut Salah',
        'deskripsi' => 'Kesalahan adalah bagian dari proses belajar. Evaluasi dan coba lagi!',
        'tags' => ['#BelajarDariSalah', '#ProsesItuPenting'],
        'icon' => 'fas fa-undo',
        'warna' => 'from-gray-400 to-gray-600'
    ],
];

// Pilih tips berdasarkan hari (otomatis ganti tiap hari)
$index = now()->dayOfWeek % count($tips);
$todayTip = $tips[$index];

    return view('home', compact('materis', 'quizzes', 'guru', 'tekaTekiPassed', 'totalTekaTeki', 'canAccessBossQuiz', 'totalKuisSelesai',  'kuisSebelumnya', 'rataRataNilai',  'nilaiSebelumnya', 'todayTip', 'progress'));
}

}
