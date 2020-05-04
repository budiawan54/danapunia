<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\ModelPelajaran;
use App\ModelSiswa;
use App\ModelUser;
use App\ModelNilai;
use Illuminate\Support\Facades\Session;
class ControllerSiswa extends Controller
{
    //
    function loadabsensi(){
        $absensi= DB::table('absensi_siswa')
        ->where('id_siswa',Session::get('id_siswa'))->get();
        foreach ($absensi as $abs){
            if ($abs->ket_absensi == 1){
                $data[] = array(
                'title' => 'absensi',
                'start' => $abs->tanggal,
                'rendering' => 'background',
                'color' => '#00c0ef'
                 );
                }
            if ($abs->ket_absensi == 2){
                $data[] = array(
                'title' => 'absensi',
                'start' => $abs->tanggal,
                'rendering' => 'background',
                'color' => '#dd4b39'
                 );
                }
            if ($abs->ket_absensi == 3){
                $data[] = array(
                'title' => 'absensi',
                'start' => $abs->tanggal,
                'rendering' => 'background',
                'color' => '#00a65a !important'
                 );
                }
            if ($abs->ket_absensi == 4){
                $data[] = array(
                'title' => 'absensi',
                'start' => $abs->tanggal,
                'rendering' => 'background',
                'color' => '#f39c12 !important'
                 );
                }  
            if ($abs->ket_absensi == 5){
                $data[] = array(
                'title' => 'absensi',
                'start' => $abs->tanggal,
                'rendering' => 'background',
                'color' => '#d2d6de'
                 );
                }    
        }
       echo json_encode($data);
    }

    function absensi(){
    	if(!session::get('loginsiswa')){
    		return redirect('login')->with('alert-error','Silakan masuk terlebih dahulu');
    	} else {
    		$siswa=ModelSiswa::where('id',session::get('id_siswa'))->get();
    		$tugas = DB::table('tb_tugas')
    			->where('kelas',$siswa->where('id',Session::get('id_siswa'))->first()->kelas)
    			->get();
    		$jml_tugas = count($tugas);
    		return view('siswa.absensi',compact('siswa','jml_tugas'));
    	}
    }
	function tugas(){
		if(!session::get('loginsiswa')){
    		return redirect('login')->with('alert-error','Silakan masuk terlebih dahulu');
    	} else {
    	$user=ModelUser::where('username',session::get('nama_siswa'))->get();
		$siswa=ModelSiswa::where('id',session::get('id_siswa'))->get();
		$pelajaran = ModelNilai::where('id_siswa',Session::get('id_siswa'))->get();
		$kode_mp=ModelPelajaran::all();
		$tugas = DB::table('tb_tugas')
    			->where('kelas',$siswa->where('id',Session::get('id_siswa'))->first()->kelas)
    			->get();
    	$status_tugas= DB::table('list_tugas')
    			->join('tb_tugas','tb_tugas.id_tugas','list_tugas.id_tugas')
    			->join('status','status.id_status','=','list_tugas.status')
    			->where('id_siswa',Session::get('id_siswa'))
    			->get();
    	$jml_tugas = count($tugas);
    	$categories = [];
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
    				$name[$i] = 'Ulangan Harian '.$i;
    				$name[11] = 'UTS';
    				$name[12] = 'Ulangan Umum';
	    			$data[$i][] = $pelajaran->where('kode_mp',$mp->nama_pelajaran)
	    			->first()->{'ulangan_harian_'.$i};
    				}
    				$data[11][] =$pelajaran->where('kode_mp',$mp->nama_pelajaran)
	    			->first()->uts;
	    			$data[12][] =$pelajaran->where('kode_mp',$mp->nama_pelajaran)
	    			->first()->ulangan_umum;
    			}   			
    		}
    	return view('siswa.tugas',compact('status_tugas','jml_tugas','siswa','user','tugas','categories','kode_mp','pelajaran'));
    	}
	}

	function updatestatus(Request $request){
		$name = $request->get('name');
		$value = $request->get('value');
		$id = $request->get('pk');
		DB::table('list_tugas')->where('id_list',$id)->update([
				'status' => $value
			]);
	}

    function uploadtugas(Request $request){
    	$pesan = [
    		'required' => 'Wajib diisi',
    		'mimes' => 'format file yang didukung adalah pdf, doc, docx, dan txt',
    		'max' => 'maksimal file adalah :max'
    	];
    	$this->validate($request,[
    		'file' => 'required|mimes:pdf,doc,docx,txt|file|max:5000'
    	],$pesan);

    	$file = $request->file('file');
				$namafile = $file->getClientOriginalName();
				$folder = 'storage/file-tugas';
				$file->move($folder,$namafile);

    	DB::table('list_tugas')->insert([
    		'id_tugas' => $request->judul_tugas,
    		'id_siswa' => Session::get('id_siswa'),
    		'comment' => $request->komentar,
    		'status' => '4',
    		'file_siswa' => $namafile,
    	]);
    }
}
