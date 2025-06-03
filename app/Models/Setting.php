<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = [
        'user_id','nama', 'nisn', 'kelas', 'tgl_lahir', 'alamat', 'jenis_kelamin','foto',
    ];
    
    public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}

}
