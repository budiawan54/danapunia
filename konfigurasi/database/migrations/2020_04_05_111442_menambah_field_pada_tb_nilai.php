<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MenambahFieldPadaTbNilai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('tb_nilai')){
            Schema::table('tb_nilai', function (Blueprint $table) {
            $table->integer('jumlah_ulangan')->unsigned()->after('id_siswa');
            $table->integer('tugas_selesai')->unsigned()->after('id_siswa');
            $table->integer('tugas_belum_selesai')->unsigned()->after('id_siswa');
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
        Schema::table('tb_nilai', function (Blueprint $table) {
            //
        });
    }
}
