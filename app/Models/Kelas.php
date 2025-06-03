<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kelas', 'guru_id', 'jurusan_id'];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'kelas_user', 'kelas_id', 'user_id');
    }
}