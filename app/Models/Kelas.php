<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = ['nama'];

public function guru()
{
    return $this->belongsToMany(User::class, 'guru_kelas', 'kelas_id', 'user_id')->where('role', 'guru');
}

public function siswa()
{
    return $this->hasMany(User::class, 'kelas', 'nama');
}

}
