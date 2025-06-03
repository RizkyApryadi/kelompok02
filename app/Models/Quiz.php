<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'quiz_title',
        'quiz_description',
        'quiz_duration',
        'show_answers',
        'target_class'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}