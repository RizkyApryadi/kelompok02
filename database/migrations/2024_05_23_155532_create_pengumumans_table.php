<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengumumansTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengumumans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('file_path')->nullable();
            $table->foreignId('siswa_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('guru_id')->nullable()->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Membalik migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengumumans');
    }
}
