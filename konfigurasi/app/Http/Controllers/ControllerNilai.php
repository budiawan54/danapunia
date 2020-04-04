<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ModelPelajaran;
use App\ModelNilai;
use DataTables;
use DB;

class ControllerNilai extends Controller
{
    //
   public function json($id){
   	$nilai = DB::table('tb_nilai')
      ->join('tb_pelajaran','tb_nilai.kode_mp','=','tb_pelajaran.nama_pelajaran')
      ->where('id_siswa',$id)
      ->get();

   	//$nilai = ModelNilai::with('ModelNilai')->select('tb_nilai.*');
   	//dd($nilai);
   	return DataTables::of($nilai)
      ->addColumn('action',function($nilai){
                    $button = '<a name="del" id="'.$nilai->id.'" class="btn-del label label-danger"><i class="fa fa-trash"></i></i></a>';
                    return $button;
                })
      ->rawColumns(['action'])
      ->addIndexColumn()
      ->make(true);
   }

   public function storenilai(Request $request){

   	$pesan = [
   		'required'=>'wajib diisi',
   	];
   	$this->validate($request,[
   		'ulu1' => 'required',
   		'ulh1' => 'required',
   		'ulh2' => 'required',
           
   	],$pesan);

   	ModelNilai::create([
   		'id_siswa' => $request->input('id'),
   		'kode_mp' => $request->input('kode_mp'),
   		'ulangan_umum_1'=>$request->input('ulu1'),
   		'ulangan_harian_1' =>$request->input('ulh1'),
   		'ulangan_harian_2' =>$request->input('ulh2'),
         'ulangan_harian_3' =>$request->input('ulh3'),
   	]);
   }
}
