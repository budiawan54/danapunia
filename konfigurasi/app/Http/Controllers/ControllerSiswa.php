<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
class ControllerSiswa extends Controller
{
    //
    function uploadtugas(Request $request){
    	$pesan = ['required' => 'Wajib diisi'];
    	$this->validate($request,[
    		'file' => 'required|mimes:pdf,doc,docx,txt'
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
