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
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\Admin\UserController;

// Rute Halaman Utama
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// // Rute Halaman Utama
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


// Rute Home (Tambahkan Nama Rute)
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

// Rute Halaman Lainnya
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/material', [MateriController::class, 'listSiswa'])->name('material');
});

// Rute Halaman Lainnya
Route::get('/scientific-calculator', function () {
    return redirect('https://www.desmos.com/scientific');
})->middleware(['auth', 'role:siswa'])->name('calculator.siswa');

// Route::get('/siswa/dashboard', [HomeController::class, 'index'])
//     ->middleware(['auth'])
//     ->name('siswa.dashboard');
    

// Route::get('/guru/dashboard', function () {
//     return view('guru.dashboardguru'); // view khusus guru
// })->middleware(['auth'])->name('guru.dashboard');

// Route::get('/guru/dashboard', [GuruDashboardController::class, 'index'])
//     ->middleware(['auth'])
//     ->name('guru.dashboard');

// Halaman view khusus guru
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/material', function () {
        return view('guru.managematerial');
    })->name('guru.material');

    // Group untuk materi (CRUD) hanya untuk guru
    Route::prefix('materi')->group(function () {
        Route::get('/manage', [MateriController::class, 'index'])->name('materi.index');
        Route::get('/manage/create', [MateriController::class, 'create'])->name('materi.create');
        Route::post('/manage/store', [MateriController::class, 'store'])->name('materi.store');
        Route::delete('/{id}', [MateriController::class, 'destroy'])->name('materi.destroy');
        Route::get('/{id}/edit', [MateriController::class, 'edit'])->name('materi.edit');
        Route::put('/{id}', [MateriController::class, 'update'])->name('materi.update');
    });
});

// SISWA ROUTE
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/materi/siswa', [MateriController::class, 'listSiswa'])->name('materi.siswa');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/discussion', [DiscussionController::class, 'index'])->name('discussion.index'); // list diskusi
    Route::get('/select-guru', [DiscussionController::class, 'selectGuru'])->name('select.guru'); // pilih guru
    Route::get('/discussion/{id}', [DiscussionController::class, 'show'])->name('discussion.show'); // chat dengan guru
    Route::post('/discussion/send', [DiscussionController::class, 'store'])->name('discussion.send'); // kirim pesan
    Route::post('/discussion', [DiscussionController::class, 'store'])->name('discussion.store');
    Route::get('/guru/siswa', [GuruDashboardController::class, 'siswaDiampu'])->name('guru.siswa');
    Route::delete('/discussion/message/{id}', [DiscussionController::class, 'deleteMessage'])->name('discussion.message.delete');
});
    

// Route::get('/information', function () {
//     return view('information');
// })->middleware(['auth'])->name('information');

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/riwayat-kuis', [App\Http\Controllers\QuizResultController::class, 'index'])
        ->name('quiz.results');
});

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::resource('forums', ForumController::class);
    Route::post('/forum/{forum}/comment', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
});


Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
});

Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/quiz/create', [QuizController::class, 'create'])->name('quiz.create');
    Route::post('/quiz', [QuizController::class, 'store'])->name('quiz.store');
    Route::get('/guru/quiz', [QuizController::class, 'listForGuru'])->name('quiz.guru.index');
    Route::get('/quiz/list', [QuizController::class, 'listForGuru'])->name('quiz.list');
    Route::delete('/quiz/{id}', [QuizController::class, 'destroy'])->name('quiz.destroy');
    Route::get('/quiz/{id}/preview', [QuizController::class, 'preview'])->name('quiz.preview');
});

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/fetch-events', [CalendarController::class, 'fetchEvents']);
    Route::post('/store-event', [CalendarController::class, 'storeEvent']);
    Route::get('/events', [EventController::class, 'index']);
    Route::post('/events', [EventController::class, 'store']);
    Route::delete('/events/{id}', [EventController::class, 'destroy']);
});

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/setting', [SettingController::class, 'form'])->name('setting.form');
    Route::post('/setting/store', [SettingController::class, 'store'])->name('setting.store');
    Route::get('/setting/information', [SettingController::class, 'information'])->name('setting.information');
    Route::get('/setting/home', [SettingController::class, 'home'])->name('setting.home');
    Route::delete('/setting/{id}', [SettingController::class, 'destroy'])->name('setting.destroy');
    Route::get('/setting/{id}/edit', [SettingController::class, 'edit'])->name('setting.edit');
    Route::put('/setting/{id}', [SettingController::class, 'update'])->name('setting.update');
});

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

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Rute Profile (Hanya Bisa Diakses oleh Pengguna yang Sudah Login)
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

 Route::get('/goals', [\App\Http\Controllers\GuruGoalsController::class, 'index'])
    ->middleware(['auth', 'role:guru'])
    ->name('goals');

// Middleware binding
Route::middleware('auth')->group(function () {

    // Rute untuk siswa
    Route::middleware(RoleMiddleware::class.':siswa')->group(function () {
        Route::get('/siswa/dashboard', [HomeController::class, 'index'])->name('siswa.dashboard');
    });

    // Rute untuk guru
    Route::middleware(RoleMiddleware::class.':guru')->group(function () {
        Route::get('/guru/dashboard', [GuruDashboardController::class, 'index'])->name('guru.dashboard');
    });
});

// Pastikan File `auth.php` Ada
require __DIR__.'/auth.php';

require __DIR__.'/api.php';

// Group Fitur Quiz
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa/Fiturquiz', [FiturquizController::class, 'show'])->name('siswa.fiturquiz');
    Route::get('/teka-teki', [TekaTekiController::class, 'index'])->name('teka-teki.index');
    Route::get('/boss-quiz', [BossQuizController::class, 'index'])->name('boss-quiz.index');
});
// Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'admin'])->name('admin.dashboard');
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('/user', [UserController::class, 'store'])->name('admin.user.store');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('admin.user.update');
});