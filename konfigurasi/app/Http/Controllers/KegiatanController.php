<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelKegiatan;
use File;
use App\ModelUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class KegiatanController extends Controller
{
    //
    public function hapus($id) {
        $hapuskegiatan=ModelKegiatan::find($id);
        File::delete('foto_kegiatan/'.$hapuskegiatan->foto_kegiatan);
        $hapuskegiatan->delete();
        return back()->with('alert-success','Data kegiatan berhasil dihapus');
    } 

    public function ubahkegiatan($id, Request $request) {
        $pesanerror = [
        	'required' => 'Wajib diisi',
        	'max' => 'gambar tidak boleh melebihi ukuran :max',
        	
        ];

    	$this->validate($request, [
    	'nama_kegiatan' => 'required',
    	'tanggal_kegiatan' => 'required',
    	'foto' =>'file|image|max:2048|mimes:png,jpeg',
    	//'foto_kegiatan' => 'required|file|image|mimes:png,jpeg|max:2048',
    	],$pesanerror);

    	$datakegiatan=ModelKegiatan::find($id);
    	$datakegiatan->judul_kegiatan = $request->nama_kegiatan;
    	$datakegiatan->tanggal_kegiatan = $request->tanggal_kegiatan;
    	$datakegiatan->deskripsi_kegiatan = $request->deskripsi_kegiatan;
    	if($request->has('foto')) {
    		$foto = $request->file('foto');
    		$namafoto =$foto->getClientOriginalName();
    		$folder ='foto_kegiatan';
    		$foto->move($folder, $namafoto);
    		$datakegiatan->foto_kegiatan=$namafoto;
    	};
    	$datakegiatan->save();
    	return back()->with('alert-success','Data Kegiatan berhasil diperbarui');
    }

    public function index() {
    	if(!Session::get('loginadmin')) {
    		return redirect('login')->with('alert-error','Silakan masuk terlebih dahulu');
    	} else {
    		$kegiatan=ModelKegiatan::all();
            $user=ModelUser::where('username',Session::get('nama_admin'))->get();
    		return view('admin.kegiatan',compact('kegiatan','user'));
    	}
    }
    public function proseskegiatan(Request $request) {
        $pesanerror = [
        	'required' => 'Wajib diisi',
        	'max' => 'gambar tidak boleh melebihi ukuran :max',
        	
        ];

    	$this->validate($request, [
    	'nama_kegiatan' => 'required',
    	'tanggal_kegiatan' => 'required',
    	'foto' => 'required|file|image|max:2048|mimes:png,jpeg',
    	'deskripsi_kegiatan' => 'required',
    	//'foto_kegiatan' => 'required|file|image|mimes:png,jpeg|max:2048',
    	],$pesanerror);

    	$foto = $request->file('foto');
    	$namafoto =$foto->getClientOriginalName();
    	$folder='foto_kegiatan';
    	$foto->move($folder,$namafoto);

    	ModelKegiatan::create([
    		'judul_kegiatan' => $request->nama_kegiatan,
    		'tanggal_kegiatan' => date('Y-m-d',strtotime($request->tanggal_kegiatan)),
    		'deskripsi_kegiatan' => $request->deskripsi_kegiatan,
    		'foto_kegiatan' => $namafoto
    	]);
    	return back()->with('alert-success','Data Kegiatan berhasil ditambahkan');
    }
}
