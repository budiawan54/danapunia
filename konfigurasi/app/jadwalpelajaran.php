<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jadwalpelajaran extends Model
{
    //
    protected $table = 'jadwalpelajaran';
    protected $fillable = ['hari','tanggal','jampelajaran','matapelajaran','jammulai','jamselesai','namapengajar','color','kelas'];

    public function mapel(){
    	return $this->hasOne('App\ModelPelajaran','id','matapelajaran');
    }
    public function class(){
    	return $this->hasOne('App\Kelas','id','kelas');
    }
}
