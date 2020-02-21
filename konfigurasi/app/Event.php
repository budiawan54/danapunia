<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $table = 'tb_events';
    protected $fillable = ['nama_acara','start_event','end_event','backcolor'];
}
