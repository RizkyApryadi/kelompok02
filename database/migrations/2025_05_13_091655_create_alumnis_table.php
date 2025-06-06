<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_alumnis_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnisTable extends Migration
{
    public function up()
    {
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();
            $table->biginteger('user_id')->unsigned()->nullable();
            $table->string('nama');
            $table->integer('angkatan');
            $table->text('keterangan')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('alumnis');
    }
}
