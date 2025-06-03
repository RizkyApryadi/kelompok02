<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;
    protected $table = 'aktivitas';  // Sesuaikan dengan nama tabel kamu
    protected $fillable = ['judul', 'deskripsi', 'tanggal', 'gambar'];
}
