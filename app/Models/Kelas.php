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
    return $this->belongsToMany(\App\Models\User::class, 'guru_kelas', 'kelas_id', 'user_id');
}

}
