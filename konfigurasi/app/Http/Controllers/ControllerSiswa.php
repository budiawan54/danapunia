<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
class ControllerSiswa extends Controller
{
    //
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
    		'file' => $namafile,
    	]);
    }
}
