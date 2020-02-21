<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelPegawai extends Model
{
    //
    protected $table='tb_pegawai';
    protected $fillable =['nama_pegawai','alamat_pegawai','nik','tanggal_lahir','agama','status','foto_pegawai'];
    public function religi(){
        return $this->hasOne('App\ModelAgama','id','agama');
    }

}
