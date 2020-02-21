<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelPrestasi extends Model
{
    //
    protected $table = 'tb_prestasi';
    protected $fillable = ['nama_prestasi','tanggal_peroleh','deskripsi_prestasi','foto_prestasi'];
}
