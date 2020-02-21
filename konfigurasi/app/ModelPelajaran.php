<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelPelajaran extends Model
{
    //
    protected $table = 'tb_pelajaran';
    protected $fillable = ['kode_pelajaran','nama_pelajaran'];
}
