@extends('admin.master')
@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengguna
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="#"><i class="fa fa-user"></i> Pengguna</a></li>
      </ol>
    </section>
@endsection
@section('main-content')
<section class="content">
    <div class="box box-fm-pengguna" style="display:none">
            <div class="box-header with-border">
              <h3 class="box-title">Formulir pengguna</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="pengguna/prosespengguna" method="post">
              {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Lengkap</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"    placeholder="Nama Lengkap" name="nama">
                                  @if($errors->has('nama'))<div class="text-danger">{{$errors->first('nama')}}</div>@endif
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-2 control-label">Nama Pengguna</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Nama Pengguna" name="username">
                                  @if($errors->has('username'))<div class="text-danger">{{$errors->first('username')}}</div>@endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Kata Sandi</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" placeholder="Kata Sandi" name="password">
                    @if($errors->has('password'))<div class="text-danger">{{$errors->first('password')}}</div>@endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Jenis Pengguna</label>
                  <div class="col-sm-6">
                    <div class="radio">
                    @foreach ($type as $type)
                    <label>
                      <input type="radio" name="pengguna" id="pengguna" value="{{$type->id_type}}">
                      {{$type->nama_type}}
                    </label>
                    @endforeach
                  </div>
                    @if($errors->has('pengguna'))<div class="text-danger">{{$errors->first('pengguna')}}</div>@endif
                  </div>
                </div>
                <div class="form-group" id="hakakses" style="display:none">
                  <label for="inputPassword3" class="col-sm-2 control-label">Hak Akses</label>
                  <div class="col-sm-10">
                    <select class="form-control select2" name="hakakses" style="width: 100%">
                      <option class="hidden" selected=""></option>
                      <option value="1">Kelas 1</option>
                      <option value="2">Kelas 2</option>
                      <option value="3">Kelas 3</option>
                      <option value="4">Kelas 4</option>
                      <option value="5">Kelas 5</option>
                      <option value="6">Kelas 6</option>
                    </select>
                    @if($errors->has('hakakses'))<div class="text-danger">{{$errors->first('hakakses')}}</div>@endif
                  </div>
                </div>
                <div class="form-group" id="link-to" style="display:none">
                  <label class="col-sm-2 control-label">Link to</label>
                  <div class="col-sm-10">
                    <select class="form-control select2" name="siswa" style="width: 100%">
                      <option class="hidden" selected=""></option>
                      @foreach($siswa as $siswa)
                      <option value="{{$siswa->id}}">{{$siswa->nama_siswa}}</option>
                      @endforeach
                    </select>
                    @if($errors->has('siswa'))<div class="text-danger">{{$errors->first('siswa')}}</div>@endif
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="/admin" class="btn btn-default" type="button">Batal</a>
                <button type="submit" class="btn btn-success pull-right">Tambah</button>
              </div>
              <!-- /.box-footer -->
            </form>
    </div>
  <!-- row -->
  <button class="btn btn-primary pull-left btn-add-user"><i class="fa fa-plus"></i> Tambah Pengguna</button>
      <div class="row rw-daftar-pengguna">
        <div class="col-xs-12">
          <div class="box" style="margin-top:5px">
            <div class="box-header">
              <h3 class="box-title"><span>Daftar Pengguna</span></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="table_pengguna">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Nama Pengguna</th>
                  <th>Jenis Pengguna</th>
                  <th>Hak Akses</th>
                  <th>Foto Profil</th>
                  <th>Aksi</th>
                </tr>
              </thead>
                <?php $no=0;?>
                @foreach ($pengguna as $p)
                <?php $no++;?>
                <tr>
                  <td>{{$no}}</td>
                  <td>{{$p->nama}}</td>
                  <td>{{$p->username}}</td>
                  <td>
                    @if (($p->type)==1) <span class="label label-info"> {{$p->hakakses->nama_type}}</span>@endif 
                    @if (($p->type)==2) <span class="label label-success"> {{$p->hakakses->nama_type}}</span>@endif 
                    @if (($p->type)==3) <span class="label label-warning"> {{$p->hakakses->nama_type}}</span>@endif 
                    @if (($p->type)==4) <span class="label label-danger"> {{$p->hakakses->nama_type}}</span>@endif 
                  </td>
                  <td>@if (($p->akses_siswa)==1) <span class="label label-info">Kelas {{$p->akses_siswa}}</span>@endif 
                    @if (($p->akses_siswa)==2) <span class="label label-success">Kelas {{$p->akses_siswa}}</span>@endif 
                    @if (($p->akses_siswa)==3) <span class="label label-warning">Kelas {{$p->akses_siswa}}</span>@endif 
                    @if (($p->akses_siswa)==4) <span class="label label-danger">Kelas {{$p->akses_siswa}}</span>@endif
                    @if (($p->akses_siswa)==5) <span class="label label-danger">Kelas {{$p->akses_siswa}}</span>@endif
                    @if (($p->akses_siswa)==6) <span class="label label-danger">Kelas {{$p->akses_siswa}}</span>@endif</td>
                  <td>@if (($p->foto_profil)==TRUE) <img src="{{url('/foto_profil/'.$p->foto_profil)}}" style="width: 50px; height: 70px"> @else belum mengisi foto @endif</td>
                  <td>
                    <a href="#k{{$p->id}}" data-toggle='modal'><span class="label label-danger"><i class="fa fa-trash"></i></span></a>
                    <a><span class="label label-info"><i class="fa fa-eye"></i></span></a>
                    <a data-nama="{{$p->nama}}" id="{{$p->id}}" class="btn-edit"><span class="label label-warning"><i class="fa fa-edit"></i> Ubah Password</span></a></td>
                </tr>
                      <!--MODAL HAPUS-->
                  <div class="modal fade" id="k{{$p->id}}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Hapus pengguna</h4>
                        </div>
                        <div class="modal-body">
                          <p>Apakah anda yakin ingin menghapus pengguna <b>{{$p->username}}</b> ???</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                          <a type="submit" class="btn btn-primary" href="pengguna/hapus/{{$p->id}}">Ya, saya yakin</a>
                        </div>
                        
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <div class="modal fade" id="edit">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h5 class="modal-title">Yakin ingin mengubah password untuk pengguna <strong id='nama'></strong> ???</h5>
                        </div>
                        <div class="modal-body">
                          <form class="fm-ubah-pwd" id='fm-ubah-pwd'>
                            {{csrf_field()}}
                            <!-- {{method_field('put')}} -->
                            <label>Ubah Password</label>
                            <input type="hidden" id="id" name="id">
                            <input type="password" class='form-control' name='pwd' placeholder="******" id="pwd">
                            <p>*) Gunakan minimal 6 karakter</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-danger">Ubah Password</button>
                        </div>
                          </form>
                        
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>              
                @endforeach
              </table>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->
</section>
@endsection