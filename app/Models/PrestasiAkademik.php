<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiAkademik extends Model
{
    use HasFactory;


    protected $table = 'prestasi_akademik'; // Menyebutkan nama tabel yang benar

    protected $fillable = [
        'nama_lengkap',
        'tanggal_pelaksanaan',
        'kejuruan',
        'tingkat',
        'penyelenggara',
    ];
}
