<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToTbNilai extends Migration
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
            $table->integer('jumlah_tugas')->unsigned()->after('id_siswa');
            
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
