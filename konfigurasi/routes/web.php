<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'ControllerIndex@index');
Route::get('/login', function(){
	return view('auth.login');
});
Route::get('/daftar-online', function(){
	return view('daftar-online');
});
Route::get('/logout', 'ControllerUser@keluar');

//ROUTE PENDAFTAR
Route::get('/userbaru', 'ControllerUser@userbaru')->name('pendaftar');
Route::get('/userbaru/input-data', function(){
	return view('userbaru.data-diri');
});

//ROUTE ADMIN
Route::get('/admin', 'ControllerUser@admin')->name('dashboard');
Route::get('/admin/status', 'ControllerUser@status')->name('status');
Route::get('/admin/pengguna','ControllerUser@pengguna')->name('pengguna');
Route::get('/admin/kegiatan','KegiatanController@index')->name('kegiatan');
Route::get('/admin/prestasi','ControllerAdmin@prestasi')->name('prestasi');
Route::get('admin/pegawai','ControllerUser@pegawai')->name('pegawai');
Route::get('/admin/profil', 'ControllerAdmin@profil')->name('profil');
Route::post('admin/ekstra/store','ControllerAdmin@storeEx');
Route::get('admin/extra','ControllerAdmin@extra')->name('extra');
route::get('event','ControllerAdmin@calendar')->name('kalender');
route::get('guru/get/kegiatan','ControllerAdmin@dtkegiatan')->name('dtkegiatan');
route::get('admin/get/kegiatan','ControllerAdmin@dtprestasi')->name('dtprestasi');
route::get('guru/get/ekskul','ControllerAdmin@dtekskul')->name('dtekskul');
route::get('admin/getjson','ControllerAdmin@fetcharray')->name('json');
route::get('admin/kegiatan/{id}/delete','ControllerAdmin@delete')->name('delete_kegiatan');
route::post('admin/extra/update/{id}','ControllerAdmin@updateEx');
route::get('admin/extra/delete/{id}','ControllerAdmin@deleteEx');
route::get('data_pegawai','ControllerAdmin@dtpegawai')->name('dtpegawai');
route::post('admin/saveevent','ControllerAdmin@addevents')->name('storeevent');
route::get('loadevent','ControllerAdmin@loadevents')->name('loadevent');
route::get('guru/jadwal-pelajaran','ControllerAdmin@pelajaran')->name('jadwal-pelajaran');
route::get('guru/jadwal-mengajar','ControllerAdmin@pelajaran')->name('jm-guru');
route::get('dtjm','ControllerAdmin@dtjadwalmengajar')->name('dtjm');
route::get('jp','ControllerAdmin@dtjadwalpelajaran')->name('dtjp');
/*route::get('dtjp','ControllerAdmin@loadjadwalpelajaran')->name('loaddtjp');*/



//ROUTE GURU
Route::put('guru/siswa/update','ControllerGuru@stdupdate')->name('stdupdate');
Route::get('guru/siswa/get','ControllerGuru@dtsiswa')->name('dtsiswa');
Route::get('/guru','ControllerUser@guru')->name('dashboard-guru');
Route::get('/guru/siswa','ControllerGuru@student')->name('siswa');
Route::get('/guru/profil','ControllerUser@profil')->name('profil-guru');
Route::get('/admin/pelajaran', 'ControllerGuru@pelajaran')->name('pelajaran');
Route::post('guru/pelajaran/store','ControllerGuru@storemp');
Route::post('guru/siswa/store','ControllerGuru@studentstore');
Route::get('/guru/siswa/delete/{id}','ControllerGuru@stddel');
Route::get('guru/pelajaran/{id}/delete/','ControllerGuru@mpdel');
Route::post('admin/pelajaran/update/{id}','ControllerGuru@mpupdate');
Route::get('guru/pelajaran/getid/{id}','ControllerGuru@getid');
Route::get('guru/getpelajaran','ControllerGuru@json');
Route::get('guru/test', 'ControllerGuru@fetcharraypelajaran');
Route::put('guru/{id}/nilai','ControllerGuru@nilai');
Route::post('guru/siswa/cari','ControllerGuru@fetch')->name('fetchsiswa');
Route::get('guru/nilai', 'ControllerGuru@cari')->name('nilai_siswa');
Route::get('guru/schedule','ControllerGuru@studentschedule')->name('schedule');
Route::post('guru/updateevents','ControllerAdmin@updateevents')->name('updateevents');
Route::post('guru/delevents','ControllerAdmin@delevents')->name('delevents');

//ROUTE NILAI
Route::get('guru/nilai/get/{id}','ControllerNilai@json');
Route::get('guru/nilai/get','ControllerNilai@fetcharraypelajaran');
Route::post('guru/simpan/nilai','ControllerNilai@storenilai');
Route::post('/guru/nilai/','ControllerNilai@fetch')->name('getnilai');



//Proses Controler
Route::put('/guru/nilai/update/jmltgs/{id}','ControllerNilai@upjmltgs');
Route::put('/guru/nilai/update/','ControllerNilai@updatenilai')->name('updatenilai');
Route::post('admin/jadwal-pelajaran/proses','ControllerAdmin@storejadwalpelajaran')->name('prosesjadwalpelajaran');
Route::post('/daftar-online/prosesdaftar', 'ControllerUser@prosesdaftar');
Route::post('/proseslogin','ControllerUser@proseslogin');
Route::post('/admin/pengguna/prosespengguna','ControllerUser@prosespengguna');
Route::post('/admin/kegiatan/proseskegiatan','KegiatanController@proseskegiatan');
Route::post('/admin/kegiatan/ubah_kegiatan/{id}','KegiatanController@ubahkegiatan');
Route::post('/admin/prestasi/proses','ControllerAdmin@prosesprestasi');
Route::post('/admin/prestasi/proses/{id}','ControllerAdmin@ubahprestasi');
Route::get('/admin/kegiatan/hapus/{id}','KegiatanController@hapus');
Route::get('/admin/prestasi/hapus/{id}','ControllerAdmin@hapusprestasi');
Route::post('/admin/prosesjabatan','ControllerAdmin@prosesjabatan');
Route::post('/admin/pegawai/prosespegawai','ControllerAdmin@prosespegawai');
Route::post('/admin/pegawai/updatepegawai/{id}','ControllerAdmin@updatepegawai');
Route::get('/admin/pegawai/{id}/hapus','ControllerAdmin@hapuspegawai');
Route::get('/admin/pengguna/hapus/{id}','ControllerAdmin@hapuspengguna');
Route::post('/admin/updateadmin/{id}','ControllerUser@userupdate');
Route::post('/guru/updateguru/{id}','ControllerUser@userupdate');
Route::put('/admin/jadwal-pelajaran/update/','ControllerAdmin@updatejadwalpelajaran')->name('updatejadwalpelajaran');
route::get('admin/jadwal-pelajaran/{id}/delete','ControllerAdmin@deletejp');
route::get('/fetchnilai/{id}','ControllerNilai@fetch');
route::put('/guru/nilai/hapus','ControllerNilai@delete')->name('deletenilai');