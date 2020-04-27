@extends('admin.master')
@section('content-header')
    <section class="content-header">
      <h1>
        Tambah Siswa
      </h1>
      <ol class="breadcrumb">
        <li><a href="/siswa"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#"><i class="fa fa-user"></i> Siswa</a></li>
      </ol>
    </section>
    <!-- Akhir Content Header (Page header) -->
@endsection
@section('main-content')
<section class="content">
                @if (count($errors)>0)
                <div class="container alert alert-danger"><h4><center><i class="fa fa-lg fa-ban"></i>Mohon lengkapi semua data</center></h4></div>@endif
  <div class="box box-info">
            <!-- form start -->
            <form class="form-horizontal" action="/guru/siswa/store" method="post" enctype="multipart/form-data" id="tambah_siswa">
              <div class="box-body">
                {{csrf_field()}}
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Siswa</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Nama Siswa" name="nama_siswa" value="{{old('nama_siswa')}}">
                    @if($errors->has('nama_siswa'))<p class="text-danger">{{$errors->first('nama_siswa')}}</p>@endif
                  </div>
                </div>
                <div class="form-group date">
                  <label  class="col-sm-2 control-label">Tanggal Lahir</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="lahir" value="{{old('lahir')}}" id="lahir" placeholder="Tanggal lahir">
                     @if($errors->has('lahir'))<p class="text-danger">{{$errors->first('lahir')}}</p>@endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="kelamin" class="col-sm-2 control-label">Jenis Kelamin</label>
                  <div class="col-sm-10">
                    <input type="radio" name="kelamin" value="1"> Laki-laki<br>
                    <input type="radio" name="kelamin" value="2"> Perempuan<br>
                     @if($errors->has('kelamin'))<p class="text-danger">{{$errors->first('kelamin')}}</p>@endif
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
                     @if($errors->has('agama'))<p class="text-danger">{{$errors->first('agama')}}</p>@endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="alamat">{{old('alamat')}}</textarea>
                     @if($errors->has('alamat'))<p class="text-danger">{{$errors->first('alamat')}}</p>@endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Foto</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" accept="image/*" name="foto_siswa">
                    <p>)* Pastikan ukuran gambar tidak melebihi 2MB</p>
                     @if($errors->has('foto_siswa'))<p class="text-danger">{{$errors->first('foto_siswa')}}</p>@endif
                  </div>
                </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <center><button type="submit" class="btn btn-primary">Tambah</button></center>
              </div>
            </div>
              <!-- /.box-footer -->
            </form>
  </div>
  @if (Session::has('alert-success'))<div class="alert alert-success"><center><i class="fa fa-lg fa-check"></i>{{Session::get('alert-success')}}</center></div>@endif
  <!--SISWA KELAS 1-->
  <div class="box box-danger">
              <div class="box-header">
                <h2 class="box-title">Daftar Siswa Kelas {{Session::get('akses_siswa')}}</h2>
                <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-red btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
                </div>
              </div>
              <div class="box-body table-responsive">
                <table class="table table-bordered table-striped" id="table_siswa">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Siswa</th>
                      <th>Tanggal Lahir</th>
                      <th>Jenis Kelamin</th>
                      <th>Agama</th>
                      <th>Alamat</th>
                      <th>foto</th>
                      <th>Aksi</th>
                    </tr>
                  </thead> 
                </table>
              </div>
  </div>
  <!--SISWA KELAS 1-->
</section>
<!--MODAL EDIT-->
                  <div class="modal fade" id="edit">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Edit Data Siswa</h4>
                        </div>
                        <div class="modal-body">
                            <form id="edit_data">
                                {{csrf_field()}}
                                {{method_field('put')}}
                                <input type="hidden" id="id" name="id">
                                <div class="form-group">
                                  <label for="inputEmail3" class=" control-label">Nama Siswa</label>
                                  <div class="">
                                    <input type="text" class="form-control" id="nama_siswa" placeholder="Nama Siswa" name="nama_siswa">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label  class=" control-label">Tanggal Lahir</label>
                                  <div class="">
                                    <input type="date" class="form-control" name="lahir" id="lahir">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="kelamin" class=" control-label">Jenis Kelamin</label>
                                  <div id="kelamin">
                                    <input type="radio" name="kelamin" value="1" id="kelamin"> Laki-laki<br>
                                    <input type="radio" name="kelamin" value="2" id="kelamin">  Perempuan<br>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="inputPassword3" class=" control-label">Agama</label>
                                  <div class="">
                                    <select class="select2 form-control" name="agama" id="agama"> 
                                      <option value="1">Hindu</option>
                                      <option value="2">Budha</option>
                                      <option value="3">Islam</option>
                                      <option value="4">Kristen/Protestan</option>
                                      <option value="5">Konghucu</option>
                                      <option value="6">Katholik</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="inputEmail3" class=" control-label">Alamat</label>
                                  <div>
                                    <textarea class="form-control" name="alamat" id="alamat"></textarea>
                                </div>
                                </div>
                                <div class="form-group">
                                  <label for="inputEmail3" class=" control-label">Foto</label>
                                  <div class="">
                                    <input type="file" class="form-control col-sm-2" accept="image/*" name="foto_siswa" onchange="preview_image(event)">
                                    <p style="color: red">)* Pastikan ukuran gambar tidak melebihi 2MB</p>
                                    <center><img src=""  class="img-thumbnail" id="output_image" style="width: 80px; height: 90px"> </center>
                                  </div>
                                </div>
                              <!-- /.box-body -->
                              <div class="box-footer">
                                  <button type="submit" class="btn btn-primary pull-right">Perbarui</button>
                            </form>
                                  <form action="" id="get-nilai" method="post">
                                    {{csrf_field()}}
                                    {{method_field('put')}}
                                    <button class="btn btn-warning pull-left get-nilai" >Edit Nilai</button>
                                  </form>
                              </div>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
<!--BATAS MODAL EDIT-->
@include('template.modal')
@endsection

    
