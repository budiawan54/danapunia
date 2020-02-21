<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelEkskul extends Model
{
    //
    protected $table= 'tb_ekskul';
    protected $fillable=['kode_ekskul','nama_ekskul','foto'];
}
