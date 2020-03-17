<?php

namespace App\Http\Controllers;
use App\ModelPrestasi;
use App\ModelJabatan;
use App\ModelPegawai;
use App\ModelUser;
use App\ModelEkskul;
use App\ModelKegiatan;
use App\ModelPelajaran;
use App\Event;
Use DataTables;
Use App\ModelSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use File;
use DB;
class ControllerAdmin extends Controller
{
    //

    public function pelajaran(){
        if(!session::get('loginadmin')){
            return redirect('login')->with('alert-error','Silakan masuk terlebih dahulu');
        } else {
            $user = ModelUser::where('username', Session::get('user'))
                ->get();
            $jabatan = ModelPegawai::where('status','like','guru%')->get();
            $pelajaran = ModelPelajaran::all();
            return view('admin.pelajaran',compact('user','jabatan','pelajaran')) ;       
        }


    }

    public function dtpegawai(){
        $pegawai=DB::table('tb_pegawai')->join('tb_agama','tb_pegawai.agama','=','tb_agama.id_agama')->get();
        return DataTables::of($pegawai)
                ->addColumn('action',function($pegawai){
                    $button = '<a  name="edit" id="'.$pegawai->id.'" class="btn-edit label label-warning"><i class="fa fa-edit"></i></a>';
                    $button .='&nbsp';
                    $button .= '<a name="del" id="'.$pegawai->id.'" class="btn-del label label-danger"><i class="fa fa-trash"></i></i></a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
    }

    public function dtprestasi(){
        $prestasi=ModelPrestasi::all();
        return DataTables::of($prestasi)
                ->addColumn('action',function($prestasi){
                    $button = '<a  name="edit" id="'.$prestasi->id.'" class="btn-edit label label-warning"><i class="fa fa-edit"></i></a>';
                    $button .='&nbsp';
                    $button .= '<a name="del" id="'.$prestasi->id.'" class="btn-del label label-danger"><i class="fa fa-trash"></i></i></a>'; 
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

    }

    public function delete($id){
        $kegiatan = ModelKegiatan::find($id);
        File::delete('foto_kegiatan/'.$kegiatan->foto_kegiatan);
        $kegiatan->delete();
        return redirect('admin/kegiatan')->with('alert-success','Data Kegiatan berhasil dihapus');

    }


    public function dtkegiatan(){
        $kegiatan=ModelKegiatan::all();

        return DataTables::of($kegiatan)
                
                ->addColumn('action',function($kegiatan){
                    $button = '<a  name="edit" id="'.$kegiatan->id.'" class="btn-edit label label-warning"><i class="fa fa-edit"></i></a>';
                    $button .='&nbsp';
                    $button .= '<a name="del" id="'.$kegiatan->id.'" class="btn-del label label-danger"><i class="fa fa-trash"></i></i></a>'; 
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            }



    public function fetcharray(Request $request){

            $id=$request->input('id');
            $kegiatan=ModelKegiatan::find($id);
            $ekskul = ModelEkskul::find($id);
            $prestasi=ModelPrestasi::find($id);
            $pegawai=ModelPegawai::find($id);
            $siswa = ModelSiswa::find($id);
            $gabungan = array($kegiatan,$ekskul,$prestasi,$pegawai,$siswa);
            echo json_encode($gabungan);
    }
    public function dtekskul(){$ekskul=ModelEkskul::all();
        return DataTables::of($ekskul)
                
                ->addColumn('action',function($ekskul){
                    $button = '<a  name="edit" id="'.$ekskul->id.'" class="btn-edit label label-warning"><i class="fa fa-edit"></i></a>';
                    $button .='&nbsp';
                    $button .= '<a name="del" id="'.$ekskul->id.'" class="btn-del label label-danger"><i class="fa fa-trash"></i></i></a>'; 
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            }

    public function newstudent(){
        if (!session::get('loginadmin')){
            return redirect ('login')->with('alert-error','Silakan masuk terlebih dahulu');
        } else {
           
        }
    }

    public function calendar(){
        if (!session::get('login')){
            return redirect('login')->with('alert-error','Silakan login terlebih dahulu');
        
        } else {
            $event = Event::all();
            $user = ModelUser::where('username', Session::get('user'))
                ->get();
            return view('admin.kalender_kegiatan',compact('user','event'));
        }
    }

    public function storeEx(Request $request){
        $pesan= [
            'required'=>'wajib diisi',
            'max'=>'Ukuran gambar tidak boleh melebihi :max MB',
            'unique' => 'Kode Ekstra telah digunakan',
            'mimes' => 'Ingat!, ekstensi file hanya boleh PNG dan JPG/JPEG'
        ];
        $this->validate($request,[
            'nama_ekstra' => 'required',
            'kode_ekstra' => 'required|unique:tb_ekskul,kode_ekskul',
            'thumbnail_photos' => 'required|mimes:jpeg,png|max:2048'
        ],$pesan);

        $foto = $request->file('thumbnail_photos');
        $namafoto = $foto->getClientOriginalName();
        $folder = 'galeri foto';
        $foto->move($folder, $namafoto);

        ModelEkskul::create([
            'kode_ekskul' => strtoupper($request->kode_ekstra),
            'nama_ekskul' => strtoupper($request->nama_ekstra),
            'foto' => $namafoto 
        ]);
        return back()->with('alert-success','Ekstra Kurikuler berhasil ditambahkan');
    }

    public function updateEx($id, Request $request){
        $pesan= [
            'required'=>'wajib diisi',
            'max'=>'Ukuran gambar tidak boleh melebihi :max MB',
            'unique' => 'Kode Ekstra telah digunakan',
            'mimes' => 'Ingat!, ekstensi file hanya boleh PNG dan JPG/JPEG'
        ];
        $this->validate($request,[
            'nama_mp' => 'required',
            'kode_mp' => 'required',
            'foto_thumbnail' => 'mimes:jpeg,png|max:2048'
        ],$pesan);

        

        $ekskul=ModelEkskul::find($id);
        if ($request->kode_mp != $ekskul->kode_ekskul){
            $this->validate($request, ['kode_mp' => 'unique:tb_ekskul,kode_ekskul|max:5'],$pesan);
            $ekskul->kode_ekskul = strtoupper($request->kode_mp);

        };
        $ekskul->nama_ekskul = strtoupper($request->nama_mp);
        
        if ($request->hasFile('foto_thumbnail')){
            $foto = $request->file('foto_thumbnail');
            $namafoto = $foto->getClientOriginalName();
            $folder = 'galeri foto';
            $foto->move($folder, $namafoto);
            $ekskul->foto =$namafoto;
        };
        $ekskul->save();
        return back()->with('alert-success','Ekstra Kurikuler berhasil diperbarui');
    }

    public function deleteEx($id){
        $ekskul = ModelEkskul::find($id);
        File::delete('galeri foto/'.$ekskul->foto_kegiatan);
        $ekskul->delete();
        return redirect('admin/extra')->with('alert-success','Data Ekskul berhasil dihapus');
    }

    public function extra() {
        if (!session::get('loginadmin')) {
            return redirect('login')->with('alert-error','Silakan login terlebih dahulu');
        } else {
            $ekstra = ModelEkskul::all();
            $user = ModelUser::where('username', Session::get('nama_admin'))->get();
            return view('admin.kurikuler',compact('ekstra','user'));
        }
    }

        public function profil() {
            if(!session::get('loginadmin')) {
                return redirect('login');
            } else {
            $user=ModelUser::where('username',session::get('nama_admin'))->get();
            return view('admin.profil',compact('user'));
        }
        }
        


    public function prosesjabatan(Request $request) {

        $this->validate($request, [
            'kode_jabatan' => 'required',
            'nama_jabatan'=> 'required'
        ]);

        ModelJabatan::create([
            'kode_jabatan'=> $request->kode_jabatan,
            'nama_jabatan'=>$request->nama_jabatan,
        ]);
        return back()->with('alert','jabatan berhasil ditambahkan');

    }

    public function hapusprestasi($id) {
        $hapusprestasi=ModelPrestasi::find($id);
        File::delete('/foto_prestasi/'.$hapusprestasi->foto_prestasi);
        $hapusprestasi->delete();
        return back()->with('alert-success','Data prestasi berhasil dihapus');
    }
    public function hapuspegawai($id) {
        $hapuspegawai=ModelPegawai::find($id);
        File::delete('/foto_pegawai/'.$hapuspegawai->foto_pegawai);
        $hapuspegawai->delete();
        return back()->with('alert-success','Data pegawai berhasil dihapus');
    }

    public function hapuspengguna($id) {
        $pengguna=ModelUser::find($id);
        File::delete('/foto_profil/'.$pengguna->foto_profil);
        $pengguna->delete();
        return back()->with('alert-success','Data pengguna berhasil dihapus');
    }

    public function ubahprestasi($id, Request $request) {
        $pesanerror = [
            'required' => 'Wajib diisi',
            'max' => 'gambar tidak boleh melebihi ukuran :max',
            
        ];

        $this->validate($request, [
        'nama_prestasi' => 'required',
        'tanggal_peroleh' => 'required',
        'foto_prestasi' =>'file|image|max:2048|mimes:png,jpeg',
        'deskripsi_prestasi' => 'required',
        //'foto_kegiatan' => 'required|file|image|mimes:png,jpeg|max:2048',
        ],$pesanerror);

        $dataprestasi=ModelPrestasi::find($id);
        $dataprestasi->nama_prestasi = $request->nama_prestasi;
        $dataprestasi->tanggal_peroleh = $request->tanggal_peroleh;
        $dataprestasi->deskripsi_prestasi = $request->deskripsi_prestasi;
        if($request->hasfile('foto_prestasi')) {
            $foto = $request->file('foto_prestasi');
            $namafoto =$foto->getClientOriginalName();
            $folder ='foto_prestasi';
            $foto->move($folder, $namafoto);
            $dataprestasi->foto_prestasi=$namafoto;
        }
        $dataprestasi->save();
        return back()->with('alert-success','Data prestasi berhasil diperbarui');
    }
    public function prestasi() {
        if(!session::get('loginadmin')) {
            return redirect('login')->with('alert-error','Silakan masuk terlebih dahulu');
        } else {
            $prestasi=ModelPrestasi::all();
            $user=ModelUser::where('username',session::get('nama_admin'))->get();
            return view('admin.prestasi',compact('prestasi','user'));
        }
    }
 
    public function prosesprestasi(Request $request) {
        $pesanerror = [
        	'required' => 'Wajib diisi',
        	'max' => 'gambar tidak boleh melebihi ukuran :max',
        	
        ];

    	$this->validate($request, [
    	'nama_prestasi' => 'required',
    	'tanggal_peroleh' => 'required',
    	'foto_prestasi' => 'required|file|image|max:2048|mimes:png,jpeg',
    	'deskripsi_prestasi' => 'required',
    	//'foto_kegiatan' => 'required|file|image|mimes:png,jpeg|max:2048',
    	],$pesanerror);

    	$foto = $request->file('foto_prestasi');
    	$fotoprestasi =$foto->getClientOriginalName();
    	$folder='foto_prestasi';
    	$foto->move($folder,$fotoprestasi);

    	ModelPrestasi::create([
    		'nama_prestasi' => $request->nama_prestasi,
    		'tanggal_peroleh' => $request->tanggal_peroleh,
    		'deskripsi_prestasi' => $request->deskripsi_prestasi,
    		'foto_prestasi' => $fotoprestasi,
    	]);
    	return back()->with('alert-success','Data Prestasi berhasil ditambahkan');
    }
    public function prosespegawai(Request $request) {
        $pesanerror = [
        	'required' => 'Wajib diisi',
        	'max' => 'gambar tidak boleh melebihi ukuran :max',
        	
        ];

    	$this->validate($request, [
    	'nama_pegawai' => 'required',
        'nik' => 'required',
        'tanggal_lahir'=>'required',
        'agama' => 'required',
        'alamat' => 'required',
        'jabatan'=> 'required',
    	'foto_pegawai' => 'required|image|max:2048|mimes:png,jpeg',
    	],$pesanerror);

    	$foto = $request->file('foto_pegawai');
    	$fotopegawai =time().'-'.$foto->getClientOriginalName();
    	$folder='foto_pegawai';
    	$foto->move($folder,$fotopegawai);

    	ModelPegawai::create([
    		'nama_pegawai' => $request->nama_pegawai,
    		'alamat_pegawai' => $request->alamat,
    		'nik' => $request->nik,
            'tanggal_lahir'=>date('Y-m-d',strtotime($request->tanggal_lahir)),
            'agama' =>$request->agama,
            'status'=>$request->jabatan,
            'foto_pegawai'=>$fotopegawai
    	]);
    	return back()->with('alert-success','Data Pegawai berhasil ditambahkan');
    }
    public function updatepegawai($id,Request $request) {
        $pesanerror = [
        	'required' => 'Wajib diisi',
        	'max' => 'gambar tidak boleh melebihi ukuran :max',
        	
        ];

    	$this->validate($request, [
    	'nama_pegawai' => 'required',
        'nik' => 'required',
        'tanggal_lahir'=>'required',
        'agama' => 'required',
        'alamat' => 'required',
        'jabatan'=> 'required',
    	'foto_pegawai' => 'image|max:2048|mimes:png,jpeg',
    	],$pesanerror);
        

    	$pegawai=ModelPegawai::find($id);
    	$pegawai->nama_pegawai = $request->nama_pegawai;
        $pegawai->alamat_pegawai = $request->alamat;
        $pegawai->nik = $request->nik;
        $pegawai->tanggal_lahir =date('Y-m-d',strtotime($request->tanggal_lahir));
        $pegawai->agama= $request->agama;
        $pegawai->status = $request->jabatan;
        if($request->has('foto_pegawai')) {
            $foto = $request->file('foto_pegawai');
            $fotopegawai =time().'-'.$foto->getClientOriginalName();
            $folder='foto_pegawai';
            $foto->move($folder,$fotopegawai);
            $pegawai->foto_pegawai = $fotopegawai;
            }
        $pegawai->save();
    	
    	return back()->with('alert-success','Data Pegawai berhasil diperbarui');
    }

    public function addevents(Request $request){

        $pesan = [
            'required' => 'Wajib diisi'
        ];
        $this->validate($request,[
            'nama_acara'=>'required',
            'start_event' => 'required',
            'end_event' => 'required',
            ],$pesan);
        Event::create([
            'nama_acara' => $request->nama_acara,
            'start_event' => date('Y-m-d H:i',strtotime($request->start_event)),
            'end_event' => date('Y-m-d H:i',strtotime($request->end_event)),
            'backcolor' => $request->backcolor,
        ]);
        return back()->with('alert-success','Event berhasil ditambahkan');
        
    }

    public function updateevents(Request $request){

        $pesan = [
            'required' => 'Wajib diisi'
        ];
        $this->validate($request,[
            'nama_acara'=>'required',
            'start_event' => 'required',
            'end_event' => 'required',
            ],$pesan);
        $id = $request->input('id');
        $events=Event::find($id);
        $events->nama_acara = $request->input('nama_acara');
        $events->start_event = date('Y-m-d H:i',strtotime($request->input('start_event')));
        $events->end_event = date('Y-m-d H:i',strtotime($request->input('end_event')));
        $events->backcolor = $request->input('backcolor');
        $events->save();
        return back()->with('alert-success','Acara berhasil diperbarui');
    }

    public function delevents(Request $request){
        $id = $request->input('id');
        $events = Event::find($id);
        $events->delete();
        return back()->with('alert-success','Event berhasil dihapus');

    }

    public function loadevents(){
        $event=Event::all();
       //return view('admin.kalender_kegiatan',compact('event'));

        foreach ($event as $e){
            $data[] = array(
                'id' => $e['id'],
                'start' => $e['start_event'], 
                'title' => $e['nama_acara'],
                'end' => $e['end_event'],
                'backgroundColor' => $e['backcolor'], 
                'borderColor' => $e['backcolor']
            );
        }
        echo json_encode($data);

    }


}
