<?php

namespace App\Http\Controllers;
use App\ModelUser;
use App\ModelJabatan;
use App\ModelPegawai;
use App\ModelPelajaran;
use App\ModelType;
use App\ModelSiswa;
use App\ModelNilai;
use App\ModelPrestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use DataTables;
use File;
use DB;

class ControllerUser extends Controller
{
    //

	public function json() {
		return Dataables::of(ModelUser::all())->make(true);
	}

	

    public function profil() {
        if(!Session::get('loginguru')) {
             return redirect('login')->with('alert-error','Silakan login terlebih dahulu');
            } else {
            $user=ModelUser::where('username',session::get('nama_guru'))->get();
            return view('guru.profil',compact('user'));
        }
        }

	public function status() {
    	if(!Session::get('loginadmin')) {
        	return redirect('login')->with('alert-error','silakan login terlebih dahulu');
    	} else {
    	$user=ModelUser::where('username',session::get('nama_admin'))->get();
    	$pendaftar=ModelUser::where('type','4')->get();
    	return view('admin.status',compact('user','pendaftar'));
		}
	}

    public function pegawai(){
    	if(!session::get('loginadmin')){
    		return redirect('login')->with('alert-error','Silakan masuk terlebih dahulu');
    	} else {
			$jabatan=ModelJabatan::all();
			$pegawai=ModelPegawai::all();
			$user=ModelUser::where('username',session::get('nama_admin'))->get();
    		return view('admin.pegawai',compact('jabatan','pegawai','user'));
    	}
    }
	public function pengguna(){
		if(!session::get('loginadmin')) {
			return redirect('login')->with('alert-error','Silakan masuk terlebih dahulu');
		} else {
			$pengguna=ModelUser::all();
			$type = ModelType::where('id_type','!=','4')->get();
			$user=ModelUser::where('username',Session::get('nama_admin'))->get();
			$siswa = ModelSiswa::all();
			return view('admin.pengguna',compact('pengguna','user','type','siswa'));
		}
	}
	public function admin(){ 
		if(!session::get('loginadmin')){
			return redirect('login')->with('alert-error','Silakan masuk terlebih dahulu');
		} else {
			$user=ModelUser::where('username',session::get('nama_admin'))->get();
			return view('admin.dashboard',compact('user'));
		}
	}

	public function siswa(){
    	if(!session::get('loginsiswa')){
    		return redirect('login')->with('alert-error','Silakan masuk terlebih dahulu');
    	} else {
    		$user=ModelUser::where('username',session::get('nama_siswa'))->get();
    		$siswa=ModelSiswa::where('id',session::get('id_siswa'))->get();
    		$kode_mp=ModelPelajaran::all();
    		$pelajaran = ModelNilai::where('id_siswa',Session::get('id_siswa'))->get();
    		$status_tugas= DB::table('list_tugas')
    			->join('tb_tugas','tb_tugas.id_tugas','list_tugas.id_tugas')
    			->join('status','status.id_status','=','list_tugas.status')
    			->get();
    		$tugas = DB::table('tb_tugas')->get();
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
    		//dd(json_encode($data[1]));
    		return view('siswa.dashboard',compact('user','siswa','jml_tugas','categories','kode_mp','name','data','tugas','status_tugas'));
    	}
    }

	public function guru(){
		if(!session::get('loginguru')){
			return redirect('login')->with('alert-error','Silakan masuk terlebih dahulu');
		} else {
			$user=ModelUser::where('username',session::get('nama_guru'))->get();
			$siswa = ModelSiswa::where('kelas', Session::get('akses_siswa'))->get();
			$jml_siswa = count($siswa);
            return view('guru.dashboard',compact('user','jml_siswa','siswa'));
			
		}
	}

	public function userbaru(){
		if(!session::get('loginuser')) {
			return redirect('login')->with('alert-error','Silakan masuk terlebih dahulu');
		} else {
			$user=ModelUser::where('username',session::get('nama_user'))->get();
			$prestasi = ModelPrestasi::all();
			$pres = ModelPrestasi::all();
			return view('userbaru.userbaru',compact('user','prestasi','pres'));
		}
	}

public function prosesdaftar(Request $request){

$pesan = [
'required' => 'wajib diisi',
'min' => ':attribute minimal :min karakter',
'unique' => 'Nama Pengguna telah digunakan',
'same' => ':attribute kata sandi harus sama dengan kata sandi'];

$this->validate($request,
	['nama'=>'required|min:2',
	'username' => 'required|unique:tb_user,username',
	'password' => 'required|min:6',
	'konfirmasi' => 'required|same:password',
],$pesan);
	$data = new ModelUser();
	$data->nama = $request->nama;
	$data->username = $request->username;
	$data->password = bcrypt($request->password);
	if(($hakakses=$request->akses)==TRUE){
		$data->type=$hakakses;
	}
	$data->save();
	return redirect('login')->with('alert-success','Silakan masuk untuk proses selanjutnya');	
}

// CONTROLLER PENGGUNA
public function prosespengguna(Request $request){

$pesan = [
'required' => 'wajib diisi',
'min' => ':attribute minimal :min karakter',
'unique'=>'Nama Pengguna telah digunakan',
'same' => ':attribute kata sandi harus sama dengan kata sandi'];

$this->validate($request,
	['nama'=>'required',
	'username' => 'required|unique:tb_user',
	'password' => 'required|min:6',
	'pengguna' =>'required'
],$pesan);
	$data = new ModelUser();
	$data->nama = $request->nama;
	$data->username = $request->username;
	$data->password = bcrypt($request->password);
	$data->akses_siswa = $request->hakakses;
	$data->type = $request->pengguna;
	$data->id_siswa= $request->siswa;
	$data->save();
	return back()->with('alert-success','Pengguna telah ditambahkan');	
}

public function userupdate ($id, Request $request){
	$pesan = [
		'required' => 'Wajib diisi',
		'min' => ':attribute minimal :min karakter',
	];

	$this->validate($request,[
		'nama_lengkap' => 'required',
		'username' => 'required|',
		'fb' => 'required',
		'tw' => 'required',
		'ig' => 'required',
		'password' => 'min:6'
	],$pesan);

	$username = $request->username;
	$password = $request->password;
	$nama = $request->nama_lengkap;
	$fb = $request->fb;
	$tw = $request->tw;
	$ig = $request->ig;

	$user = ModelUser::find($id);
	if($nama == $user->nama){
		if($password == $user->password) { 
				if($username==$user->username) {
					$user->facebook=$request->fb;
					$user->twitter=$request->tw;
					$user->instagram=$request->ig;
						if ($request->has('foto_profil')) {
						$foto_profil = $request->file('foto_profil');
						$nama_foto = time().'-'.$foto_profil->getClientOriginalName();
						$folder = 'foto_profil';
						$foto_profil->move($folder,$nama_foto);
						$user->foto_profil=$nama_foto;
						}
					$user->save();
					return back()->with('alert-success','Profil berhasil diperbarui');
				} else {
					$user->nama = $nama;
					$user->username = $username;
					$user->password = $password;
					$user->facebook=$request->fb;
					$user->twitter=$request->tw;
					$user->instagram=$request->ig;
					if ($request->has('foto_profil')) {
						$foto_profil = $request->file('foto_profil');
						$nama_foto = time().'-'.$foto_profil->getClientOriginalName();
						$folder = 'foto_profil';
						$foto_profil->move($folder,$nama_foto);
						$user->foto_profil=$nama_foto;
						}
					if($password !== $user->password) {
					$user->nama=$nama;
					$user->username=$username; 
					$user->password=bcrypt($password);
					$user->facebook=$request->fb;
					$user->twitter=$request->tw;
					$user->instagram=$request->ig;
						if ($request->has('foto_profil')) {
							$foto_profil = $request->file('foto_profil');
							$nama_foto = time().'-'.$foto_profil->getClientOriginalName();
							$folder = 'foto_profil';
							$foto_profil->move($folder,$nama_foto);
							$user->foto_profil=$nama_foto;
							}
					$user->save();
					return redirect('login')->with('alert-success','Profil diperbarui, silakan login kembali');
					} else {	
					$user->save();
					return redirect('login')->with('alert-success','Profil berhasil diperbarui, silakan login kembali');
				}
			}
		} else {
			$user->nama = $nama;
			$user->username = $username;
			$user->password=bcrypt($password);
			$user->facebook=$request->fb;
			$user->twitter=$request->tw;
			$user->instagram=$request->ig;
				if ($request->has('foto_profil')) {
					$foto_profil = $request->file('foto_profil');
					$nama_foto = time().'-'.$foto_profil->getClientOriginalName();
					$folder = 'foto_profil';
					$foto_profil->move($folder,$nama_foto);
					$user->foto_profil=$nama_foto;
					}
			$user->save();
			return redirect('login')->with('alert-success','Profil berhasil diperbarui, silakan login kembali');
		} 
	} else {
					$user->nama = $nama;
					$user->username = $username;
					$user->facebook=$request->fb;
					$user->twitter=$request->tw;
					$user->instagram=$request->ig;
					if ($request->has('foto_profil')) {
						$foto_profil = $request->file('foto_profil');
						$nama_foto = time().'-'.$foto_profil->getClientOriginalName();
						$folder = 'foto_profil';
						$foto_profil->move($folder,$nama_foto);
						$user->foto_profil=$nama_foto;
						}
					if($password !== $user->password) {
					$user->nama=$nama;
					$user->username=$username; 
					$user->password=bcrypt($password);
					$user->facebook=$request->fb;
					$user->twitter=$request->tw;
					$user->instagram=$request->ig;
						if ($request->has('foto_profil')) {
							$foto_profil = $request->file('foto_profil');
							$nama_foto = time().'-'.$foto_profil->getClientOriginalName();
							$folder = 'foto_profil';
							$foto_profil->move($folder,$nama_foto);
							$user->foto_profil=$nama_foto;
							}
					$user->save();
					return redirect('login')->with('alert-success','Profil berhasil diperbarui, silakan login kembali');
					} else {
					$user->password= $password;
					$user->save();
					return redirect('login')->with('alert-success','Profil berhasil diperbarui, silakan login kembali');
					}
	}
			
}


public function proseslogin(Request $request) {

	$pesan =[
	'required' => 'Tolong isi semua bagian',
	'min' => ':attribute minimal :min karakter'];

	$this->validate($request, ['username'=>'required', 'password'=>'required|min:6'],$pesan); 
	
	$username=$request->username;
	$password=$request->password;
	$datauser=ModelUser::where('username',$username)->first();
	if($datauser) {
		if(hash::check($password, $datauser->password)) {
			if(($datauser->type) == 4) {
				Session::put('nama_user',$datauser->username);
				Session::put('user',$datauser->username);
				Session::put('type',$datauser->type);
				Session::put('loginuser', TRUE);
				Session::put('login',TRUE);
				return redirect('userbaru')->with('alert-success','Selamat Datang '.$datauser->nama);
			} else {
				if(($datauser->type)==1) {
					Session::put('nama_admin',$datauser->username);
					Session::put('user',$datauser->username);
					Session::put('type',$datauser->type);
					Session::put('loginadmin',TRUE);
					Session::put('login',TRUE);
					return redirect('admin')->with('alert-success','Selamat Datang '.$datauser->nama);
				} else {
					if(($datauser->type)==2) {
						Session::put('nama_guru',$datauser->username);
						Session::put('user',$datauser->username);
						Session::put('type',$datauser->type);
						Session::put('akses_siswa',$datauser->akses_siswa);
						Session::put('loginguru', TRUE);
						Session::put('login',TRUE);
						return redirect('guru')->with('alert-success','Selamat Datang '.$datauser->nama);
					} else {
						if (($datauser->type) == 3){
							Session::put('nama_siswa',$datauser->username);
							Session::put('user',$datauser->username);
							Session::put('type',$datauser->type);
							Session::put('id_siswa',$datauser->id_siswa);
							Session::put('loginsiswa', TRUE);
							Session::put('login',TRUE);
							return redirect('siswa')->with('alert-success','Selamat Datang'.$datauser->nama);
						}
					}
				}
			}
		} else {
			return redirect('login')->with('alert-error','Password yang anda masukkan salah');
		}
	} else {
		return redirect('login')->with('alert-error','Nama Pengguna yang anda masukkan tidak terdaftar');
	}
}

public function keluar() {
	session::flush();
	return redirect('login')->with('alert-success','Anda berhasil keluar');
}
}
