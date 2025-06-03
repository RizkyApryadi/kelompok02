<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aktivitas', function (Blueprint $table) {
            $table->id();
            $table->biginteger('user_id')->unsigned()->nullable();
            $table->string('judul');              // untuk judul aktivitas
            $table->text('deskripsi');             // untuk deskripsi aktivitas
            $table->date('tanggal');               // untuk tanggal aktivitas
            $table->string('gambar')->nullable();  // untuk path gambar (opsional)
            $table->timestamps();                  // created_at dan updated_at

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aktivitas');
    }
};
