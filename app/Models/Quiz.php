<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'passing_score', 'kelas', 'deadline', 'type', 'image_path', 'video_path'];

    protected $casts = [
    'deadline' => 'datetime',
    ];

    // Relasi ke soal
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // Relasi ke hasil kuis
    public function results()
    {
        return $this->hasMany(QuizResult::class);
    }

    // Untuk cek apakah user sudah mengerjakan kuis
   public function getIsCompletedAttribute()
{
    $user = Auth::user();

    if (!$user) {
        return false;
    }

    return $this->results->where('user_id', $user->id)->isNotEmpty();
}

    // Hapus otomatis pertanyaan & hasil kuis jika quiz dihapus
    protected static function booted()
    {
        static::deleting(function ($quiz) {
            $quiz->questions()->delete();
            $quiz->results()->delete();
        });
    }
}
