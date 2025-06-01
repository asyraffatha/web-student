<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id', 
        'question', 
        'options', 
        'answer',
        'image',
        'video',
        'options_images'
    ];

    protected $casts = [
        'options' => 'array', // Mengonversi kolom options menjadi array
        'options_images' => 'array'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
