<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizAttemptsTable extends Migration
{
    public function up()
    {
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('quiz_id');
            $table->integer('score')->default(0); // kolom skor hasil kuis
            $table->timestamp('submitted_at')->nullable(); // waktu submit kuis
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'quiz_id']); // Supaya 1 user cuma bisa 1 record per quiz

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('quiz_attempts');
    }
}
