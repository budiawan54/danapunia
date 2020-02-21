<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelKegiatan;
use App\ModelPrestasi;
use App\ModelEkskul;
use App\ModelPegawai;

class ControllerIndex extends Controller
{
    //
    public function index() {
    	$kegiatan=ModelKegiatan::paginate(6);
    	$ekstra = ModelEkskul::all();
    	$prestasi=ModelPrestasi::all();
    	$pegawai = ModelPegawai::all();
    	return view('index',compact('kegiatan','prestasi','ekstra','pegawai'));
    }
}
