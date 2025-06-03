<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('prestasi_akademik', function (Blueprint $table) {
            $table->id();
            $table->biginteger('user_id')->unsigned()->nullable();
            $table->string('nama_lengkap');
            $table->date('tanggal_pelaksanaan');
            $table->string('kejuruan');
            $table->string('tingkat');
            $table->string('penyelenggara');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi_akademik');
    }
};
