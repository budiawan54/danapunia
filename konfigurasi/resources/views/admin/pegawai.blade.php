@extends('admin.master')
@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Daftar Pegawai
      </h1>
      <ol class="breadcrumb">
        <li><a href="../admin"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="#">pegawai</a>
      </ol>
    </section>
@endsection
@section('main-content')
<section class="content">
@if (Session::has('alert')) 
<script>window.alert("{{Session::get('alert')}}")
</script>@endif
    @if(Session::has('alert-success'))<div class="container alert alert-success"><h4><center><i class="fa fa-lg fa-check"></i>{{Session::get('alert-success')}}</center></h4></div>@endif
    <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Pegawai</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="pegawai/prosespegawai" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Lengkap</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3"  name="nama_pegawai" value="{{old('nama_pegawai')}}">
                                  @if($errors->has('nama_pegawai'))<div class="text-danger">{{$errors->first('nama_pegawai')}}</div>@endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NIK (Nomor Induk Karyawan)</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3"  name="nik">
                                  @if($errors->has('nik'))<div class="text-danger">{{$errors->first('nik')}}</div>@endif
                  </div>
                </div>
                <div class="form-group date">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Lahir</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="datepicker"  name="tanggal_lahir">
                                  @if($errors->has('tanggal_lahir'))<div class="text-danger">{{$errors->first('tanggal_lahir')}}</div>@endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Agama</label>

                  <div class="col-sm-10">
                    <select class="select2 form-control" name="agama">
                      <option value="1">Hindu</option>
                      <option value="2">Budha</option>
                      <option value="3">Islam</option>
                      <option value="4">Kristen/Protestan</option>
                      <option value="5">Konghucu</option>
                      <option value="6">Katholik</option>
                    </select>
                    @if($errors->has('agama'))<div class="text-danger">{{$errors->first('agama')}}</div>@endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Alamat Lengkap</label>

                  <div class="col-sm-10">
                    <textarea class="form-control" name="alamat"></textarea>
                    @if($errors->has('alamat'))<div class="text-danger">{{$errors->first('alamat')}}</div>@endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Jabatan</label>

                  <div class="col-sm-10">
                    <select class="select2 form-control" name="jabatan">
                    @foreach ($jabatan as $j)
                      <option name="jabatan">{{$j->nama_jabatan}}</option>
                    @endforeach
                    </select>
                    @if($errors->has('jabatan'))<div class="text-danger">{{$errors->first('jabatan')}}</div>@endif
                  <p>)* Jika jabatan belum muncul silakan <a href="#jabatan" data-toggle="modal">klik disini</a> </p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="foto" class="col-sm-2 control-label">Foto</label>
                  <div class="col-sm-10">
                    <input type="file" name="foto_pegawai" accept="image/*" class="form-control">
                    @if($errors->has('foto_pegawai')) <div class="text-danger">{{$errors->first('foto_pegawai')}}</div>@endif
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="../admin" class="btn btn-default" type="button">Batal</a>
                <button type="submit" class="btn btn-success pull-right">Tambah</button>
              </div>
              <!-- /.box-footer -->
            </form>
    </div>

      <!-- row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <a class="box-title" href="#" style="color: black">Daftar Pegawai</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="table_pegawai">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Lengkap</th>
                  <th>Tanggal Lahir</th>
                  <th>NIK</th>
                  <th>Agama</th>
                  <th>Alamat</th>
                  <th>Jabatan</th>
                  <th>Foto</th>
                  <th>Tindakan</th>
                </tr>
                </thead>

                   

              </table>
            <!-- /.box-body -->
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
      <!-- /.row -->
  <!-- /.content-wrapper -->
        <!--Default modal-->
        <div class="modal fade" id="jabatan">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Jabatan</h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" action="/admin/prosesjabatan" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Kode Jabatan</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputEmail3"  name="kode_jabatan" >
                                  @if($errors->has('kode_jabatan'))<div class="text-danger">{{$errors->first('kode_jabatan')}}</div>@endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Nama Jabatan</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputEmail3"  name="nama_jabatan" >
                                  @if($errors->has('nama_jabatan'))<div class="text-danger">{{$errors->first('nama_jabatan')}}</div>@endif
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah Jabatan</button>
              </div>
            </form>
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  @include('template.modal')
   <!--MODAL EDIT-->
                    <div class="modal fade" id="edit">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Ubah Pegawai</h4>
                          </div>
                          <div class="modal-body">
                          <form class="form-horizontal" id='edit_data' action="pegawai/updatepegawai/" method="post" enctype="multipart/form-data">
                          {{csrf_field()}}
                          <div class="box-body">
                            <input type="text" class="hidden" id="id" value="">
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-2 control-label">Nama Lengkap</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_pegawai"  name="nama_pegawai" >
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-2 control-label">NIK (Nomor Induk Karyawan)</label>

                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="nik"  name="nik">
                                              
                              </div>
                            </div>
                            <div class="form-group date">
                              <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Lahir</label>

                              <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggal_lahir"  name="tanggal_lahir" >                                            
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-2 control-label">Agama</label>

                              <div class="col-sm-10">
                                <select class="select2 form-control" name="agama" id="agama">
                                  <option value="1" >Hindu</option>
                                  <option value="2" >Budha</option>
                                  <option value="3" >Islam</option>
                                  <option value="4" >Kristen/Protestan</option>
                                  <option value="5" >Konghucu</option>
                                  <option value="6" >Katholik</option>
                                </select>
                                
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-2 control-label">Alamat Lengkap</label>

                              <div class="col-sm-10">
                                <textarea class="form-control" name="alamat" id="alamat"></textarea>
                       
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class="col-sm-2 control-label">Jabatan</label>
                              <div class="col-sm-10">
                                <select class="select2 form-control" id="jabatan" name="jabatan">
                                @foreach ($jabatan as $j)
                                  <option >{{$j->nama_jabatan}}</option>
                                @endforeach
                                     
                               </select>
                                
                              <p>)* Jika jabatan belum muncul silakan <a href="#jabatan" data-toggle="modal">klik disini</a> </p>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="foto" class="col-sm-2 control-label">Foto</label>
                              <div class="col-sm-10">
                                 <input type="file" class="form-control" name="foto_pegawai" accept="image/*" onchange="preview_image(event)"> 
                                <p style="color: red">*) Maksimal ukuran gambar adalah 2MB.</p>
                                <center><img src="" id="output_image" style="width: 70px; height: 100px"></center>
                              </div>
                            </div>
                          </div>
                          <!-- /.box-body -->
                          <div class="box-footer">
                            <button type="reset" class="btn btn-default" data-dismiss="modal" >Batal</button>
                            <button type="submit" class="btn btn-primary pull-right">Perbarui</button>
                          </div>
                          <!-- /.box-footer -->
                          </form>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div> 
@endsection


 
