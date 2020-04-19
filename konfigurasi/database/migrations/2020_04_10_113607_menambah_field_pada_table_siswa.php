<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MenambahFieldPadaTableSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('tb_siswa')){
            Schema::table('tb_siswa', function (Blueprint $table) {
            $table->integer('jumlah_ulangan')->unsigned()->after('id');
            $table->integer('tugas_selesai')->unsigned()->after('id');
            $table->integer('tugas_belum_selesai')->unsigned()->after('id');
        });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_siswa', function (Blueprint $table) {
            //
        });
    }
}
