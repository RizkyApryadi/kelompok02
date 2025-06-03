<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('quiz_title'); // Judul kuis
            $table->text('quiz_description'); // Deskripsi kuis
            $table->integer('quiz_duration'); // Durasi kuis dalam menit
            $table->boolean('show_answers')->default(false); // Menampilkan kunci jawaban setelah submit
            $table->foreignId('target_class')->constrained('kelas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};