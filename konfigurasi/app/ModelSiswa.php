<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelSiswa extends Model
{
    //
    protected $table = 'tb_siswa';
    protected $fillable = ['nama_siswa','birth','sex','faith','address','student_photos','kelas'];
    public function agama (){
    	return $this->hasOne('App\ModelAgama','id_agama','faith');
    }
}
