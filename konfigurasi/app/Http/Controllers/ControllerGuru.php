<?php

namespace App\Http\Controllers;
use App\ModelPelajaran;
use App\ModelSiswa;
use App\ModelUser;
use App\ModelNilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use File;
use DataTables;
use DB;
class ControllerGuru extends Controller
{
	//
	public function absensi(){
		if(!Session::get('loginguru')){
			return redirect('login')->with('alert-error','Silakan Masuk terlebih dahulu');
		} else {
			$user=ModelUser::where('username',session::get('nama_guru'))->get();
			$siswa = ModelSiswa::where('kelas',session::get('akses_siswa'))->get();
			$ket_abs = DB::table('ket_absensi')->get();
			return view('guru.absensi',compact('user','siswa','ket_abs'));
		}
	}
	public function dtsiswa(){
        $siswa=DB::table('tb_siswa')->join('tb_agama','tb_siswa.faith','=','tb_agama.id_agama')
        	->join('tb_kelamin','tb_siswa.sex','=','tb_kelamin.id_kelamin')
        	->where('kelas',Session::get('akses_siswa'))
        	->get();
        return DataTables::of($siswa)
                ->addColumn('action',function($siswa){
                    $button = '<a  name="edit" id="'.$siswa->id.'" class="btn-edit label label-warning"><i class="fa fa-edit"></i></a>';
                    $button .='&nbsp';
                    $button .= '<a name="del" id="'.$siswa->id.'" class="btn-del label label-danger"><i class="fa fa-trash"></i></i></a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
    }

	public function studentschedule(){
		if(!Session::get('loginguru')){
			return redirect('login')->with('alert-error','Silakan Masuk terlebih dahulu');
		} else {
			$user=ModelUser::where('username',session::get('nama_guru'))->get();
			return view('guru.jadwal_pelajaran',compact('user'));
		}
	}


	public function cari(){
		if(!Session::get('loginguru')){
			return redirect('login')->with('alert-error','Silakan Masuk terlebih dahulu');
		} else {

			$user=ModelUser::where('username',session::get('nama_guru'))->get();
			return view('guru.cari_siswa',compact('user'));
		}
	}
	
	function fetch(Request $request)
    {
     if($request->get('query'))
     {
      $query = $request->get('query');
      $data = DB::table('tb_siswa')
        ->where('nama_siswa', 'LIKE', "%{$query}%")
        ->where('kelas','=',session::get('akses_siswa'))
        ->get();
      if ( count($data) > 0){
      foreach($data as $row){
      $output = '<div>';}
      foreach($data as $row)
      {
       $output .= '<form action="/guru/'.$row->id.'/nilai" method="post" class="list">
       '.csrf_field().''.method_field('put').'<button type="submit" class="sidebar-form btn-primary"><img src="'.url('/foto_siswa/'.$row->student_photos).'" style="margin-bottom: 5px; width: 50px; height: 50px" class="img-circle" alt="Ubah Profil"> '.$row->nama_siswa.'</button></form>
       ';
      }
      $output .= '</div>';
      echo $output;
     } else {
     	echo "<p class='alert list'>Tidak ada data</p>";
     }
 	}
    }

    public function nilai($id){
    	if(!Session::get('loginguru')){
    		return redirect ('login')->with('alert-error','Silakan masuk terlebih dahulu');
    	} else {
    		$siswa=ModelSiswa::find($id);
    		$pelajaran = ModelNilai::where('id_siswa',$id)->get();
    		$kode_mp=ModelPelajaran::all();
    		$user=ModelUser::where('username',session::get('nama_guru'))->get();
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
    				$name = 'ulangan_harian_$i';
	    			$data[$i][] = $pelajaran->where('kode_mp',$mp->nama_pelajaran)
	    			->first()->{'ulangan_harian_'.$i};
    				}
    				$data[11][] =$pelajaran->where('kode_mp',$mp->nama_pelajaran)
	    			->first()->uts;
	    			$data[12][] =$pelajaran->where('kode_mp',$mp->nama_pelajaran)
	    			->first()->ulangan_umum;
    			}   			
    		}
    		
    		

    		//dd($pelajaran->where('id_siswa',$id)->first()->kode_mp);
    		//dd($a);
    		//dd(json_encode($categories));
    		return view('guru.nilai',compact('siswa','pelajaran','kode_mp','user','categories','data','nama'));
    		
    	}
    }
    public function mpupdate($id, Request $request){
    	$pesan = [
		'required' => 'Wajib diisi',
		'unique' => 'kata kunci yang dimasukkan sudah digunakan',
		'max' => 'Maksimal kode pelajaran adalah :max karakter',
		];
		$this->validate($request, [
			'kode_mp' => 'required',
			'nama_mp' => 'required',
		],$pesan);

		$kode=$request->kode_mp;
		$mapel = $request->nama_mp;
		$pelajaran=ModelPelajaran::where('id_pelajaran',$id)->first();
		if($kode!=$pelajaran->kode_pelajaran) {
		$this->validate($request, [
			'kode_mp' => 'unique:tb_pelajaran,kode_pelajaran|max:5',
		],$pesan);
		}
		if($mapel!=$pelajaran->nama_pelajaran){
			$this->validate($request, [
			'nama_mp' => 'unique:tb_pelajaran,nama_pelajaran',
			],$pesan);
		}
		DB::table('tb_pelajaran')->where('id_pelajaran',$id)->update([
		'kode_pelajaran' => strtoupper($request->kode_mp),
		'nama_pelajaran' => strtoupper($request->nama_mp),	
		]);
		return back()->with('alert-success','Pelajaran berhasil diperbarui');
    }
	public function mpdel($id) {
		ModelPelajaran::destroy($id);
		return back()->with('alert-success','Mata pelajaran berhasil dihapus');
	}

	public function stddel($id) {
		$siswa=ModelSiswa::find($id);
		File::delete('foto_siswa/'.$siswa->student_photos);
		$siswa->delete();
		return back()->with('alert-success','Siswa berhasil dihapus');
	}

    public function student() {
    	if(!Session::get('loginguru')) {
    		return redirect('login')->with('alert-error','Silakan login terlebih dahulu');
    	} else {
    	$siswa1 = ModelSiswa::where('kelas','=',session::get('akses_siswa'))->get();
    	$user=ModelUser::where('username',session::get('nama_guru'))->get();
    	return view('guru.siswa',compact('siswa1','user'));
    	}

    }

    public function studentstore(Request $request) {
	$pesan = [
		'max' => 'Maksimal foto adalah :max MB',
		'mimes' => 'Gambar harus berekstensi :mimes',
		'required' => 'Wajib diisi',
	];
	$this->validate($request, [
		'nama_siswa' => 'required',
		'agama' => 'required',
		'kelamin' => 'required',
		'foto_siswa' => 'required|image|max:2048|mimes:png,jpeg',
		'alamat' => 'required',
		'lahir'=>'required',
	],$pesan);

	$foto = $request->file('foto_siswa');
	$nama_foto = time().''.$foto->getClientOriginalName();
	$folder = 'foto_siswa';
	$foto->move($folder,$nama_foto);
	ModelSiswa::create([
		'nama_siswa' => $request->nama_siswa,
		'faith' => $request->agama,
		'address' =>$request->alamat,
		'sex'=>$request->kelamin,
		'birth' =>date('Y-m-d',strtotime($request->lahir)),
		'student_photos'=>$nama_foto,
		'kelas' =>Session::get('akses_siswa'),
	]);
	return back()->with('alert-success','Siswa berhasil ditambahkan');
	}

	public function stdupdate(Request $request){
		$pesan = [
			'max' => 'Maksimal foto adalah :max MB',
			'mimes' => 'Gambar harus berekstensi :mimes',
			'required' => 'Wajib diisi',
		];

		$this->validate($request, [
			'nama_siswa' => 'required',
			'agama' => 'required',
			'kelamin' => 'required',
			'foto_siswa' => 'image|max:2048|mimes:png,jpeg',
			'alamat' => 'required',
			'lahir'=>'required',
		],$pesan);

		$id = $request->id;
		$siswa = ModelSiswa::find($id);
		$siswa->nama_siswa = $request->nama_siswa;
		$siswa->faith = $request->agama;
		$siswa->address = $request->alamat;
		$siswa->sex = $request->kelamin;
		$siswa->birth= date('Y-m-d',strtotime($request->lahir));
		if($request->has('foto_siswa')){
			$foto_siswa = $request->file('foto_siswa');
			$namafoto = $foto_siswa->getClientOriginalName();
			$folder = 'foto_siswa';
			$foto_siswa->move($folder,$namafoto);
			$siswa->student_photos = $namafoto;
		}
		$siswa->save();

		}

    public function delete($id, Request $request){
    	$pelajaran=ModelPelajaran::find($id);
    	$pelajaran->delete();
    	return back()->with('alert-success','Mata pelajaran berhasil dihapus');
    }

	public function storemp(Request $request) {
	$pesan = [
		'required' => 'Wajib diisi',
		'unique' => 'Kode mata pelajaran sudah digunakan',
		'max' => 'Maksimal Kode Pelajaran adalah :max',
	];
	$this->validate($request, [
		'kode_pelajaran' => 'required|unique:tb_pelajaran,kode_pelajaran|max:5',
		'nama_pelajaran' => 'required',
	],$pesan);

	ModelPelajaran::create([
		'kode_pelajaran' => strtoupper($request->input('kode_pelajaran')),
		'nama_pelajaran' => strtoupper($request->nama_pelajaran),	
	]);
	return back()->with('alert-success','Pelajaran berhasil ditambahkan');
	}

	public function pelajaran(){
		if(!session::get('loginadmin')) {
			return redirect ('login')->with('alert-error','Silakan login terlebih dahulu');
		} else {
			$user=ModelUser::where('username',session::get('nama_admin'))->get();
			return view('admin.mapel',compact('user'));
		}
	}

	public function fetcharraypelajaran(Request $request){

			$id=$request->input('id');
			$pelajaran=ModelPelajaran::where('id_pelajaran',$id)->first();
			echo json_encode($pelajaran);
	}

	public function json(){$pelajaran=ModelPelajaran::all();
		return DataTables::of($pelajaran)
				
				->addColumn('action',function($pelajaran){
					$button = '<a  name="edit" id="'.$pelajaran->id_pelajaran.'" class="btn-edit label label-warning"><i class="fa fa-edit"></i></a>';
					$button .='&nbsp';
					$button .= '<a name="del" id="'.$pelajaran->id_pelajaran.'" class="btn-del label label-danger"><i class="fa fa-trash"></i></i></a>'; 
					return $button;
				})
				->rawColumns(['action'])
				->addIndexColumn()
				->make(true);
			}
}
