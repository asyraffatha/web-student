<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\GuruDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\TekaTekiController;
use App\Http\Controllers\BossQuizController;
use App\Http\Controllers\FiturquizController;

// Rute Halaman Utama
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// // Rute Halaman Utama
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


// Rute Home (Tambahkan Nama Rute)
Route::get('/home', [HomeController::class, 'index'])
    ->middleware(['auth'])
    ->name('home');

// Rute Halaman Lainnya
Route::get('/material', [MateriController::class, 'listSiswa'])
    ->middleware(['auth'])
    ->name('material');

// Rute Halaman Lainnya
Route::get('/scientific-calculator', function () {
    return redirect('https://www.desmos.com/scientific');
});

Route::get('/siswa/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth'])
    ->name('siswa.dashboard');
    

// Route::get('/guru/dashboard', function () {
//     return view('guru.dashboardguru'); // view khusus guru
// })->middleware(['auth'])->name('guru.dashboard');

Route::get('/guru/dashboard', [GuruDashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('guru.dashboard');

Route::get('/guru/material', function () {
    return view('guru.managematerial'); // view khusus guru
})->middleware(['auth'])->name('guru.material');

Route::get('/materi/manage', [MateriController::class, 'index'])->name('materi.index');
Route::get('/materi/manage/create', [MateriController::class, 'create'])->name('materi.create');
Route::post('/materi/manage/store', [MateriController::class, 'store'])->name('materi.store');
Route::delete('/materi/{id}', [MateriController::class, 'destroy'])->name('materi.destroy');
Route::get('/materi/{id}/edit', [MateriController::class, 'edit'])->name('materi.edit');
Route::put('/materi/{id}', [MateriController::class, 'update'])->name('materi.update');
// SISWA ROUTE
Route::get('/materi/siswa', [MateriController::class, 'listSiswa'])->name('materi.siswa');

Route::middleware(['auth'])->group(function () {
    Route::get('/discussion', [DiscussionController::class, 'index'])->name('discussion.index'); // pilih siswa
    Route::get('/discussion/{receiver_id}', [DiscussionController::class, 'show'])->name('discussion.show'); // chat
    Route::post('/discussion/send', [DiscussionController::class, 'store'])->name('discussion.send'); // kirim
    Route::get('/guru/siswa', [GuruDashboardController::class, 'siswaDiampu'])->name('guru.siswa')->middleware('auth');
});
    

// Route::get('/information', function () {
//     return view('information');
// })->middleware(['auth'])->name('information');

Route::middleware(['auth'])->group(function () {
    Route::resource('forums', ForumController::class);
    Route::post('/forum/{forum}/comment', [CommentController::class, 'store'])->name('comments.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
    }); 

Route::middleware(['auth'])->group(function () {
    Route::get('/quiz/create', [QuizController::class, 'create'])->name('quiz.create');
    Route::post('/quiz', [QuizController::class, 'store'])->name('quiz.store');
    Route::get('/guru/quiz', [QuizController::class, 'listForGuru'])->name('quiz.guru.index');
    Route::get('/quiz/list', [QuizController::class, 'listForGuru'])->name('quiz.list');
    Route::delete('/quiz/{id}', [QuizController::class, 'destroy'])->name('quiz.destroy');
    Route::get('/quiz/{id}/preview', [QuizController::class, 'preview'])->name('quiz.preview');
});

Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
Route::get('/fetch-events', [CalendarController::class, 'fetchEvents']);
Route::post('/store-event', [CalendarController::class, 'storeEvent']);
Route::get('/events', [EventController::class, 'index']);
Route::post('/events', [EventController::class, 'store']);
Route::delete('/events/{id}', [EventController::class, 'destroy']);

Route::get('/setting', [SettingController::class, 'form'])->name('setting.form');
Route::post('/setting/store', [SettingController::class, 'store'])->name('setting.store');
Route::get('/setting/information', [SettingController::class, 'information'])->name('setting.information');
Route::get('/setting/home', [SettingController::class, 'home'])->name('setting.home');
Route::delete('/setting/delete/{id}', [SettingController::class, 'destroy'])->name('setting.destroy');  
Route::get('setting/{id}/edit', [ForumController::class, 'edit'])->name('setting.edit');

//Lupa Password
// Routes untuk forgot password
Route::post('/forgot-password/verify-email', [ResetPasswordController::class, 'verifyEmail'])->name('forgot-password.verify-email');
Route::post('/forgot-password/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('forgot-password.reset-password');

// Route untuk halaman forgot password (jika belum ada)
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('forgot-password');

// Route untuk halaman login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Rute Profile (Hanya Bisa Diakses oleh Pengguna yang Sudah Login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Add Goals Route
    Route::get('/goals', [\App\Http\Controllers\GuruGoalsController::class, 'index'])->name('goals');
});

// Pastikan File `auth.php` Ada
require __DIR__.'/auth.php';

require __DIR__.'/api.php';

// Group Fitur Quiz
Route::middleware(['auth'])->group(function () {
    Route::get('/siswa/Fiturquiz', [FiturquizController::class, 'show'])->name('siswa.fiturquiz');
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/teka-teki', [TekaTekiController::class, 'index'])->name('teka-teki.index');
    Route::get('/boss-quiz', [BossQuizController::class, 'index'])->name('boss-quiz.index');
});

