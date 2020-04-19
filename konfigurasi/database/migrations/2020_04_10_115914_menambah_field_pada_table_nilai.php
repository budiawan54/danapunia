<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MenambahFieldPadaTableNilai extends Migration
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
            $table->integer('ulangan_harian_4')->unsigned()->after('id_siswa');
            $table->integer('ulangan_harian_5')->unsigned()->after('id_siswa');
            $table->integer('ulangan_harian_6')->unsigned()->after('id_siswa');
            $table->integer('ulangan_harian_7')->unsigned()->after('id_siswa');
            $table->integer('ulangan_harian_8')->unsigned()->after('id_siswa');
            $table->integer('ulangan_harian_9')->unsigned()->after('id_siswa');
            $table->integer('ulangan_harian_10')->unsigned()->after('id_siswa');
            $table->integer('uts')->unsigned()->after('id_siswa');
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
