<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;

    protected $table = 'heroes'; // Sesuaikan dengan nama tabel di database

    protected $fillable = [ 
        'photo', 'message', 'headmaster_name'
    ];
}
