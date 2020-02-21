@extends('admin.master')
@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Daftar Kegiatan
      </h1>
      <ol class="breadcrumb">
        <li><a href="../admin"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="#">kegiatan</a>
      </ol>
    </section>
@endsection

@section('main-content')
<section class="content">
  @if(Session::has('alert-success'))<div class="container alert alert-success"><h4><center><i class="fa fa-lg fa-check"></i>{{Session::get('alert-success')}}</center></h4></div>@endif
  @if($errors->has('nama_kegiatan') || $errors->has('tanggal_kegiatan') || $errors->has('deskripsi_kegiatan') || $errors->has('foto'))
              <div class="container alert alert-error"><h4><center><i class="fa fa-lg fa-ban"></i> Mohon periksa kembali data yang diinput!</center></h4>
              </div>
              @endif
    <!--ALERT SUCCESS-->
    <div id="alert-success" class="container hidden alert alert-success"><h4><center><i class="fa fa-lg fa-check"></i>Data Kegiatan berhasil diperbarui</center></h4></div>
    <!--END ALERT SUCCESS-->
    <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Kegiatan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="kegiatan/proseskegiatan" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Judul Kegiatan</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"   name="nama_kegiatan" value="{{old('nama_kegiatan')}}">
                                  @if($errors->has('nama_kegiatan'))<div class="text-danger">{{$errors->first('nama_kegiatan')}}</div>@endif
                  </div>
                </div>
                <div class="form-group date">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Kegiatan</label>

                  <div class="col-sm-10">
                      
                  <input type="text" class="form-control" name="tanggal_kegiatan" id="datepicker" value="{{old('tanggal_kegiatan')}}">
                
                                  @if($errors->has('tanggal_kegiatan'))<div class="text-danger">{{$errors->first('tanggal_kegiatan')}}</div>@endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Deskripsi Kegiatan</label>

                  <div class="col-sm-10">
                    <textarea class="form-control summernote" name="deskripsi_kegiatan" > Jelaskan deskripsi kegiatan secara singkat!
                    </textarea>
                    @if($errors->has('deskripsi_kegiatan'))<div class="text-danger">{{$errors->first('deskripsi_kegiatan')}}</div>@endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="foto" class="col-sm-2 control-label">Foto Kegiatan</label>

                  <div class="col-sm-10">
                    <input type="file" class="form-control" accept="image/*" name="foto"> 
                    @if($errors->has('foto'))<div class="text-danger">{{$errors->first('foto')}}</div>@endif
                    <p>*) Pastikan ukuran gambar tidak melebihi 2MB.</p>
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="../admin" class="btn btn-default" type="button">Batal</a>
                <button type="submit" class="btn btn-primary pull-right">Tambah</button>
              </div>
              <!-- /.box-footer -->
            </form>
    </div>

      <!-- row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <a class="box-title" href="#" style="color: black">Daftar Kegiatan</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table  table-striped" id="table_kegiatan" style="width: 100%">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Kegiatan</th>
                  <th>Tanggal Kegiatan</th>
                  <th>Foto Kegiatan</th>
                  <th>Tindakan</th>
                </tr>
              </thead>
            </table>
            </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      <!-- /.row -->
</section>
@endsection
@include('template.modal')
                                    <!--Default modal-->
                  <div class="modal fade" id="edit">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Ubah Kegiatan</h4>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal" id="edit_data" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="box-body">
                          <input type="text" name="id" id="id" class="hidden" value="">
                          
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-3 control-label">Judul Kegiatan</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatan" >
                              </div>
                            </div>
                            <div class="form-group date">
                              <label for="inputEmail3" class="col-sm-3 control-label">Tanggal Kegiatan</label>

                              <div class="col-sm-9">
                                <input type="date" class="form-control"  name="tanggal_kegiatan" id="tanggal_kegiatan" >
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputPassword3" class=" col-sm-3 control-label">Deskripsi Kegiatan</label>

                              <div class="col-sm-9">
                                <textarea class="form-control summernote" name="deskripsi_kegiatan" id="deskripsi_kegiatan"></textarea>
                              </div>
                            </div>
                          
                          
                            <div class="form-group">
                              <label for="" class="col-sm-3 control-label">Foto Kegiatan </label>
                              <div class="col-sm-9">
                              <input type="file" class="form-control" accept="image/*" name="foto" id="foto" onchange="preview_image(event)">
                              <center><img src="" id="output_image" class="hidden" style="width: 70px; height: 100px"></center>
                              <p style="color: red">*) Pastikan ukuran gambar tidak melebihi 2MB.</p>
                            </div>
                          </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                        </div>
                          </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->

 