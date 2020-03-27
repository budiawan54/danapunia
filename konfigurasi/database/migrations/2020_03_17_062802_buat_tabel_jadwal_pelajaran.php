<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelJadwalPelajaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwalpelajaran', function (Blueprint $table) {
            $table->datetime('tanggal');
            $table->string('matapelajaran');
            $table->time('jammulai');
            $table->time('jamselesai');
            $table->string('namapengajar');
            $table->bigIncrements('id');
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
        Schema::dropIfExists('jadwalpelajaran');
    }
}
