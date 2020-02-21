<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelKegiatan extends Model
{
    //
    protected $table = 'tb_kegiatan';
    protected $fillable = ['judul_kegiatan', 'tanggal_kegiatan','deskripsi_kegiatan', 'foto_kegiatan'];
}
