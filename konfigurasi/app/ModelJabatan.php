<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelJabatan extends Model
{
    //
    protected $table = 'tb_jabatan';
    protected $fillable = ['kode_jabatan','nama_jabatan'];
}
