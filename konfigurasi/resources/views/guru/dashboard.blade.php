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
           <!-- TUGAS LIST -->
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
                @foreach($status_tugas as $st)
                <li class="item">
                  <div class="product-img">
                    <img src="{{url('/foto_siswa/'.$st->student_photos)}}" alt="Product Image">
                  </div>
                  <div class="product-info">
                    {{$st->nama_siswa}} :
                    <a href="javascript:void(0)" class="product-title">{{$st->judul_tugas}}
                      <span data-pk='{{$st->id_list}}' class="label @if($st->nama_status == 'Disetujui') label-success @elseif ($st->nama_status == 'Tidak disetujui') label-danger @elseif ($st->nama_status == 'Kurang Lengkap') label-warning @elseif ($st->nama_status == 'Belum diperiksa') label-info @endif pull-right">{{$st->nama_status}}</span>
                    <span class="product-description">
                          {{$st->comment}}
                        </span>
                  </div>
                </li>
                @endforeach
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
            <input type="file" class="form-control" name="file" id="file">
          </div>
          <div class="form-group"> 
            <textarea class="form-control" name="deskripsi" rows="8" placeholder="Tulis komentar disini..." id="deskripsi">{{{ old('deskripsi') }}}</textarea>
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
