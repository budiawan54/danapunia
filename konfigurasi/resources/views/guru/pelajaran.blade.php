@extends('admin.master')
@section('content-header')
    <section class="content-header">
      <h1>
      Mata Pelajaran
      </h1>
      <ol class="breadcrumb">
        <li><a href="/guru"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#"><i class="fa fa-user"></i> Mata pelajaran</a></li>
      </ol>
    </section>
@endsection
@section('main-content')
<section class="content">
  @if (Session::has('alert-success'))
    <script>
    window.alert('{{Session::get('alert-success')}}')
    </script>
  @endif
  @if($errors->has('kode_pelajaran') || $errors->has('nama_pelajaran'))
  <div class="container alert alert-error"><h4><center><i class="fa fa-lg fa-ban"></i> Mohon periksa kembali data yang diinput!</center></h4>
  </div>
  @endif
          <div class="col-sm-6">
              <div class="box box-info">
                <div class="box-header">
                  <h2 class="box-title">Tambah Mata Pelajaran</h2>
                </div>
                <!-- form start --> 
                <form action="/guru/pelajaran/store" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    {{csrf_field()}}
                    <div class="form-group">
                      <label for="inputEmail3" class="control-label">Kode Mata Pelajaran</label>     
                        <input type="text" class="form-control" placeholder="Kode Mata Pelajaran" name="kode_pelajaran">
                        @if ($errors->has('kode_pelajaran'))<p class="text-danger">{{$errors->first('kode_pelajaran')}}</p>@endif
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="control-label">Nama Mata Pelajaran</label>
                        <input type="text" class="form-control" placeholder="Nama Mata Pelajaran" name="nama_pelajaran" value="{{old('nama_pelajaran')}}">
                        @if($errors->has('nama_pelajaran'))<p class="text-danger">{{$errors->first('nama_pelajaran')}}</p>@endif
                    </div>
                  </div>
                  <!-- /.box-body -->
                    <div class="box-footer">
                      <button type="submit" class="btn btn-default">Cancel</button>
                      <button type="submit" class="btn btn-primary pull-right">Tambah</button>
                    </div>
                  <!-- /.box-footer -->
                </form>
              </div>
          </div>
          <div class="col-sm-6">
            <div class="box">
              <div class="box-header">
                <h2 class="box-title">Daftar Mata Pelajaran</h2>
              </div>
              <div class="box-body table-responsive">
                <table class="table table-bordered table-striped" id="example1">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Mata Pelajaran</th>
                      <th>Nama Mata Pelajaran</th>
                      <th>Tindakan</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $no=0; ?>
                      <?php $no++ ?>
                      <tr>
                      <th>{{$no}}</th>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
</section>
@endsection
@include('template.modal')
                <!--MODAL EDIT-->
                  <div class="modal fade edit" id="edit">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Edit Mata Pelajaran</h4>
                        </div>
                        <div class="modal-body">

                          <div class="alert alert-success hidden" id="success-msg" ></div>
                          <form id="edit_data" enctype="multipart/form-data">
                            <div class="box-body" >
                            {{csrf_field()}}
                            <input type="hidden" name="id" id='id'>
                            <div class="form-group">
                              <label for="kode_mp">Kode Mata Pelajaran</label>
                              <input type="text" class="form-control" id="kode_mp" name="kode_mp" >                            
                            </div>
                            <div class="form-group">
                              <label for="nama_pelajaran">Nama Mata Pelajaran</label>
                              <input type="text" class="form-control" id="nama_mp"  name="nama_mp">
                             
                            </div>
                              <div class="box-footer">
                                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                  <button type="submit" class="btn btn-primary pull-right" id="submit">Perbarui</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                <!--BATAS MODAL EDIT-->