<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    //
    protected $table = 'absensi_siswa';
    protected $fillable = ['id_siswa','tanggal','ket_absensi'];

}
