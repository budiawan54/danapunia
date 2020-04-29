@extends('admin.master')
@section('content-header')
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>
<section class="content">
@endsection
@section('main-content')
@if(Session::has('alert-success'))<div class="container">
          <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-bullhorn"></i>

              <h3 class="box-title">{{Session::get('alert-success')}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="callout callout-danger">
                <h4>Lihat batas pendaftaran siswa di situs resmi <a href="">SD Dana Punia Singaraja</a> sebelum terlambat.</h4>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>@endif
      <!-- row -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$jml_siswa}}</h3>
              <p>Jumlah Siswa Didik</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-sm-4">
           <!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Laporan tugas siswa terbaru</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                <li class="item">
                  <div class="product-img">
                    <img src="dist/img/default-50x50.gif" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">Samsung TV
                      <span class="label label-warning pull-right">$1800</span></a>
                    <span class="product-description">
                          Samsung 32" 1080p 60Hz LED Smart HDTV.
                        </span>
                  </div>
                </li>
                <!-- /.item -->
                <li class="item">
                  <div class="product-img">
                    <img src="dist/img/default-50x50.gif" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">Bicycle
                      <span class="label label-info pull-right">$700</span></a>
                    <span class="product-description">
                          26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                        </span>
                  </div>
                </li>
                <!-- /.item -->
                <li class="item">
                  <div class="product-img">
                    <img src="dist/img/default-50x50.gif" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">Xbox One <span
                        class="label label-danger pull-right">$350</span></a>
                    <span class="product-description">
                          Xbox One Console Bundle with Halo Master Chief Collection.
                        </span>
                  </div>
                </li>
                <!-- /.item -->
                <li class="item">
                  <div class="product-img">
                    <img src="dist/img/default-50x50.gif" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">PlayStation 4
                      <span class="label label-success pull-right">$399</span></a>
                    <span class="product-description">
                          PlayStation 4 500GB Console (PS4)
                        </span>
                  </div>
                </li>
                <!-- /.item -->
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="javascript:void(0)" class="uppercase">Lihat semua data</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-sm-6">
          <div class="box box-primary">
            <div class="box-header">
              <h2 class="box-title">Daftar tugas</h2>
               <div class="box-tools pull-right">
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                  <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="javascript:void(0)" id="btn-add-tugas">Tambah Tugas Baru</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped" id="table-tugas">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Judul Tugas</th>
                      <th>Progress</th>
                      <th>Label</th>
                      
                    </tr>
                  </thead> 
                </table>
              </div>
          </div> 
          </div>
      </div>
      </div>
</section>
<div class="modal fade" id="add-tugas">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <center><h4><i class="fa fa-edit"></i> Tambah Tugas Baru</h4></center>
      </div>
      <div class="modal-body">
        <form id="form-add-tugas" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="form-group">
            <input type="text" class="form-control" name="judul" placeholder="Judul tugas atau mata pelajaran" id="judul">
          </div>
          <div class="form-group"> 
            <textarea class="form-control" name="deskripsi" rows="8" placeholder="Tulis soal disini..." id="deskripsi">{{{ old('deskripsi') }}}</textarea>
          </div>
          <center><label>Atau</label></center>
          <div class="form-group">
            <input type="file" class="form-control" name="file" id="file">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
