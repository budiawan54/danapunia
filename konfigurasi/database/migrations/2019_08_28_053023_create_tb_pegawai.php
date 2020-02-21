<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pegawai', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_pegawai',50);
            $table->string('alamat_pegawai',255);
            $table->integer('nik')->unsigned();
            $table->date('tanggal_lahir');
            $table->integer('agama')->unsigned();
            $table->integer('status')->unsigned();
            $table->string('foto_pegawai',255);
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
        Schema::dropIfExists('tb_pegawai');
    }
}
