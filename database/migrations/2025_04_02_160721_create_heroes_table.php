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
        Schema::create('heroes', function (Blueprint $table) {
            $table->id();
            $table->string('headmaster_name');
            $table->biginteger('user_id')->unsigned()->nullable();
            $table->text('message');
            $table->string('photo');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heroes');
    }
};
