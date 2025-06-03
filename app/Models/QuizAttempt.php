<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'score',
        'submitted_at',
        'completed_at',
    ];

    // Casting tanggal supaya bisa pakai format() di view
    protected $casts = [
        'submitted_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Quiz
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
