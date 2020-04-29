<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelUser extends Model
{
    //
    protected $table = 'tb_user';
    protected $fillable = ['nama','username','password','type','foto_profil','facebook','twitter','instagram','pengguna','id_siswa'];

    public function hakakses(){
    	return $this->hasOne('App\ModelType','id_type','type');
    }
}
