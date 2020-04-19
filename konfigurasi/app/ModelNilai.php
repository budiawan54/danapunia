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
        'uts',
    	'ulangan_umum',
    	'ulangan_harian_1',
    	'ulangan_harian_2',
        'ulangan_harian_3',
        'ulangan_harian_4',
        'ulangan_harian_5',
        'ulangan_harian_6',
        'ulangan_harian_7',
        'ulangan_harian_8',
        'ulangan_harian_9',
        'ulangan_harian_10',
    ];

    public function siswa(){
    	return $this->belongsTo('App\ModelSiswa','id_siswa','id');
    }
    public function kode(){
    	return $this->belongsTo('App\ModelPelajaran','kode_mp','kode_pelajaran');
    }
}
