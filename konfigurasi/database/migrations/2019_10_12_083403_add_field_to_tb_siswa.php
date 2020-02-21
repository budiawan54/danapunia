<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToTbSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       if(Schema::hasTable('tb_siswa')){
            Schema::table('tb_siswa', function (Blueprint $table) {
                //
                $table->integer('ulangan_harian_1')->unsigned()->after('ulangan_umum_1');
                $table->integer('ulangan_harian_2')->unsigned();
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
