<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ModelPelajaran;
use App\ModelNilai;
use App\ModelSiswa;
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
      ->setRowId(function ($user) {
         return $user->id;
      })
      ->addIndexColumn()   
      ->make(true);
   }

   public function storenilai(Request $request){
   	$pesan = [
   		'required'=>'wajib diisi',
         'unique' => 'Nilai untuk mata pelajaran ini sudah ada, silakan perbarui melalui tabel',
   	];
   	
      $id= $request->input('id');
      $kode_mp = $request->input('kode_mp');
      $id_siswa = ModelNilai::where('id_siswa',$id)->get();
      $kode_pelajaran = ModelNilai::where('kode_mp',$kode_mp)->get();
      $idpelajaran = ModelNilai::where('id_siswa',$id)->first();
      $hitung_kode_pelajaran = count($kode_pelajaran);
      $hitung_id_siswa= count($id_siswa);
      if ($hitung_id_siswa == 0) {
         if($hitung_kode_pelajaran == 0 ) {
            ModelNilai::create([
               'id_siswa' => $id,
               'kode_mp' => $kode_mp,
               'ulangan_umum'=>$request->input('ulu'),
               'ulangan_harian_1' =>$request->input('ulh1'),
               'ulangan_harian_2' =>$request->input('ulh2'),
               'ulangan_harian_3' =>$request->input('ulh3'),
               'ulangan_harian_4' =>$request->input('ulh4'),
               'ulangan_harian_5' =>$request->input('ulh5'),
               'ulangan_harian_6' =>$request->input('ulh6'),
               'ulangan_harian_7' =>$request->input('ulh7'),
               'ulangan_harian_8' =>$request->input('ulh8'),
               'ulangan_harian_9' =>$request->input('ulh9'),
               'ulangan_harian_10' =>$request->input('ulh10'),
               'uts' =>$request->input('uts'),
            ]);
         } else {
            ModelNilai::create([
               'id_siswa' => $id,
               'kode_mp' => $kode_mp,
               'ulangan_umum'=>$request->input('ulu'),
               'ulangan_harian_1' =>$request->input('ulh1'),
               'ulangan_harian_2' =>$request->input('ulh2'),
               'ulangan_harian_3' =>$request->input('ulh3'),
               'ulangan_harian_4' =>$request->input('ulh4'),
               'ulangan_harian_5' =>$request->input('ulh5'),
               'ulangan_harian_6' =>$request->input('ulh6'),
               'ulangan_harian_7' =>$request->input('ulh7'),
               'ulangan_harian_8' =>$request->input('ulh8'),
               'ulangan_harian_9' =>$request->input('ulh9'),
               'ulangan_harian_10' =>$request->input('ulh10'),
               'uts' =>$request->input('uts'),
            ]);
         }
      } else {
         if($hitung_kode_pelajaran==0){
            ModelNilai::create([
               'id_siswa' => $id,
               'kode_mp' => $kode_mp,
               'ulangan_umum'=>$request->input('ulu'),
               'ulangan_harian_1' =>$request->input('ulh1'),
               'ulangan_harian_2' =>$request->input('ulh2'),
               'ulangan_harian_3' =>$request->input('ulh3'),
               'ulangan_harian_4' =>$request->input('ulh4'),
               'ulangan_harian_5' =>$request->input('ulh5'),
               'ulangan_harian_6' =>$request->input('ulh6'),
               'ulangan_harian_7' =>$request->input('ulh7'),
               'ulangan_harian_8' =>$request->input('ulh8'),
               'ulangan_harian_9' =>$request->input('ulh9'),
               'ulangan_harian_10' =>$request->input('ulh10'),
               'uts' =>$request->input('uts'),
            ]);
         } else {
            if($kode_pelajaran->where('id_siswa',$id)->first()){
               if($kode_pelajaran->where('id_siswa',$id)->first()->kode_mp == $kode_mp){
                     $this->validate($request,[
                     'kode_mp' => 'unique:tb_nilai'
                     ],$pesan);
               }     
               } else {
                  ModelNilai::create([
                     'id_siswa' => $id,
                     'kode_mp' => $kode_mp,
                     'ulangan_umum'=>$request->input('ulu'),
                     'ulangan_harian_1' =>$request->input('ulh1'),
                     'ulangan_harian_2' =>$request->input('ulh2'),
                     'ulangan_harian_3' =>$request->input('ulh3'),
                     'ulangan_harian_4' =>$request->input('ulh4'),
                     'ulangan_harian_5' =>$request->input('ulh5'),
                     'ulangan_harian_6' =>$request->input('ulh6'),
                     'ulangan_harian_7' =>$request->input('ulh7'),
                     'ulangan_harian_8' =>$request->input('ulh8'),
                     'ulangan_harian_9' =>$request->input('ulh9'),
                     'ulangan_harian_10' =>$request->input('ulh10'),
                     'uts' =>$request->input('uts'),
                  ]);
               }   
         }
      } 
   }

   public function updatenilai(Request $request){
      $pesan = [
         'required'=>'wajib diisi',
      ];
      $this->validate($request,[
         /*'ulu1' => 'required',
         'ulh1' => 'required',
         'ulh2' => 'required',*/          
      ],$pesan);
      $id =  $request->get('pk');
      $nilai = ModelNilai::find($id);
      $name = $request->get('name');
      $value = $request->get('value');
      $nilai->$name = $value;
      $nilai->save();
      return back()->with('alert-success','nilai berhasil diperbarui');
   }

   function delete(Request $request){
      $id = $request->id;
      $nilai = ModelNilai::find($id);
      $nilai->delete();
   }

   function upjmltgs($id, Request $request){ 

   $siswa = ModelSiswa::find($id);
   $name = $request->get('name'); 
   $value = $request->get('value');
   $siswa->$name = $value; 
   $siswa->save(); 
   return back()->with('alert-success','nilai berhasil diperbarui');
   }

   public function fetch(Request $request){
      $id = $request->id;
      $kode_mp=ModelPelajaran::all();
      $pelajaran = ModelNilai::where('id_siswa',$id)->get();
      $categories=[];
      for ($i=1 ; $i<=12 ; $i++){
            $data[$i] = [];
            $nama[$i]= ['ulangan harian '.$i];
            $nama['11'] = ['UTS'];
            $nama['12'] = ['ulangan umum'];
         }
      foreach ($kode_mp as $mp){
            if ($pelajaran->where('kode_mp',$mp->nama_pelajaran)
               ->first()){
               $categories[] = $mp->nama_pelajaran;
               for ($i=1 ; $i<=10 ; $i++){
               $data[$i][] = $pelajaran->where('kode_mp',$mp->nama_pelajaran)
               ->first()->{'ulangan_harian_'.$i};
               }
               $data[11][]=$pelajaran->where('kode_mp',$mp->nama_pelajaran)
               ->first()->uts;
               $data[12][] =$pelajaran->where('kode_mp',$mp->nama_pelajaran)
               ->first()->ulangan_umum;
            }           
         }
         $gabungan = array($nama,$data);
         echo json_encode($gabungan);
    }
   
}
