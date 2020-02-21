<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelNilai extends Model
{
    //
    protected $table = 'tb_nilai';
    protected $fillable = [
    	'id_siswa',
    	'kode_mp',
    	'ulangan_umum_1',
    	'ulangan_harian_1',
    	'ulangan_harian_2',
        'ulangan_harian_3',
    ];

    public function siswa(){
    	return $this->belongsTo('App\ModelSiswa','id_siswa','id');
    }
    public function kode(){
    	return $this->belongsTo('App\ModelPelajaran','kode_mp','kode_pelajaran');
    }
}
