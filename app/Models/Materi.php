<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'kelas', 'deskripsi', 'file_path','deadline'];

    protected $casts = [
    'deadline' => 'datetime',
    ];

}

