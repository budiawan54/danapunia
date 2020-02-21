<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_siswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_siswa',100);
            $table->string('birth',100);
            $table->string('sex',10);
            $table->string('address',100);
            $table->string('faith',100);
            $table->string('student_photos',100);
            $table->string('class',50);
            $table->integer('ulangan_umum_1')->unsigned();
            $table->integer('ulangan_harian_1')->unsigned();
            $table->integer('ulangan_harian_2')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_siswa');
    }
}
