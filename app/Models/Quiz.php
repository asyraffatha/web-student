<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'passing_score','kelas','deadline','type','image_path','video_path'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function results()
    {
    return $this->hasMany(QuizResult::class);
    }

    protected static function booted()
    {
    static::deleting(function ($quiz) {
        $quiz->questions()->delete();
        $quiz->results()->delete();
    }); 
    }
}
