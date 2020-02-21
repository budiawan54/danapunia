@extends('admin.master')
@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Prestasi Siswa
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="#">prestasi siswa</a>
      </ol>
    </section>
@endsection
@section('main-content')
<section class="content">
  @if(Session::has('alert-success'))<div class="container">
          <div class="box box-default">
            <div class="box-header with-border alert-success alert">
                <center><i class="fa fa-bullhorn"></i>
              <h3 class="box-title ">{{Session::get('alert-success')}}</h3></center>
            </div>
            <!-- /.box-header -->
          </div>
        </div>@endif
    <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Prestasi Siswa</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="prestasi/proses" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Prestasi</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Nama Prestasi" name="nama_prestasi">
                                  @if($errors->has('nama_prestasi'))<div class="text-danger">{{$errors->first('nama_prestasi')}}</div>@endif
                  </div>
                </div>
                <div class="form-group date">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Diperoleh</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="datepicker" placeholder="Tulis tanggalnya disini" name="tanggal_peroleh">
                                  @if($errors->has('tanggal_peroleh'))<div class="text-danger">{{$errors->first('tanggal_peroleh')}}</div>@endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Deskripsi Singkat</label>

                  <div class="col-sm-10">
                    <textarea class="form-control summernote" name="deskripsi_prestasi" placeholder="Jelaskan secara singkat mengenai prestasi ini"></textarea>
                    @if($errors->has('deskripsi_prestasi'))<div class="text-danger">{{$errors->first('deskripsi_prestasi')}}</div>@endif
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Foto Prestasi</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" name="foto_prestasi" accept="image/*"> 
                    @if($errors->has('foto_prestasi'))<div class="text-danger">{{$errors->first('foto_prestasi')}}</div>@endif
                    <p>*) Maksimal ukuran gambar adalah 2MB.</p>
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
              <a class="box-title" href="#" style="color: black">Daftar Prestasi Siswa</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table class="table table-bordered" id="table_prestasi">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Prestasi</th>
                    <th>Tangal diperoleh</th>
                    <th>Keterangan</th>
                    <th>Foto</th>
                    <th>Lakukan Aksi</th>
                  </tr>
                </thead>
                </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->
</section>
<!---modal-->
        <div class="modal fade" id="edit">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Prestasi</h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" id="edit_data" >
              {{csrf_field()}}
              <div class="box-body">
                <input type="text" class="hidden" id="id" value="">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Prestasi</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Nama Prestasi" name="nama_prestasi" id="nama_prestasi">
                                  
                  </div>
                </div>
                <div class="form-group date">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Diperoleh</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="Tulis tanggalnya disini" name="tanggal_peroleh" >
                                  
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Deskripsi Singkat</label>

                  <div class="col-sm-10">
                    <textarea class="form-control" id="deskripsi_prestasi" name="deskripsi_prestasi" placeholder="Jelaskan secara singkat mengenai prestasi ini"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Foto Prestasi</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" name="foto_prestasi" accept="image/*" onchange="preview_image(event)"> 
                    <p style="color: red">*) Maksimal ukuran gambar adalah 2MB.</p>
                    <center><img src="" id="output_image" style="width: 70px; height: 100px"></center>
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
@include('template.modal')
@endsection
