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
            <a href="#" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$jml_siswa}} %</h3>
              <p>Tugas terselesaikan</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>{{count($status_tugas->where('status','1'))}}</h3>
              <p>Siswa selesai mengerjakan tugas</p>
            </div>
            <div class="icon">
              <i class="fa fa-check-square-o"></i>
            </div>
            <a href="#" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{count($status_tugas->where('status','4'))}}</h3>
              <p>Siswa belum selesai mengerjakan tugas</p>
            </div>
            <div class="icon">
              <i class="fa fa-minus-square"></i>
            </div>
            <a href="#" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-sm-8">
          <div class="box box-warning">
            <div class="box box-header">
              <h3 class="box-title">Laporan tugas siswa terbaru</h3>
            </div>
            <div class="box-body">
            <div class="direct-chat-messages">
            @if($jml_stt == 0)
                <center><h1 style="margin:250px 250px"><i class="fa fa-warning"></i><br/>Belum ada yang upload tugas</h1></center>@endif
                <ul class="timeline">
                  <!-- timeline time label -->
                  @foreach ($status_tugas as $sttugas)
                  <li class="time-label">
                        <span class="bg-red">
                        {{date('d M Y',strtotime($sttugas->Updated_at))}}
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-user bg-blue"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> {{date('H:i',strtotime($sttugas->{'Updated_at'}))}}</span>
                      <h3 class="timeline-header"><strong>{{$sttugas->nama_siswa}}</strong>  telah mengupload tugas <a href='{{ url('/storage/file-tugas/'.$sttugas->file_siswa)}}'>{{$sttugas->judul_tugas}}</a></h3>
                      <div class="timeline-body">
                        {{$sttugas->comment}}
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs" href="{{ url('/storage/file-tugas/'.$sttugas->file_siswa)}}">Lihat Data</a>
                        <a class="btn btn-info btn-xs" data-pk='{{$sttugas->id_list}}' data-name = '{{$sttugas->id_siswa}}'>Terima</a>
                        <a class="btn btn-danger btn-xs" data-pk='{{$sttugas->id_list}}' data-name = '{{$sttugas->id_siswa}}'>Tolak</a>
                        <a class="btn btn-warning btn-xs" data-pk ='{{$sttugas->id_list}}' data-name = '{{$sttugas->id_siswa}}'>Minta Perbaikan</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
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
                  <tbody>
                    <?php $i=0; ?>
                      @foreach($tugas as $tugas)
                      <?php $i++; ?>
                    <tr>
                      <td>{{$i}}</td>
                      <td>{{$tugas->judul_tugas}}</td>
                      <td>
                        <div class="progress progress-xs">
                          @if ($persentasi[$tugas->judul_tugas] <=40)
                          <div class="progress-bar progress-bar-danger" style="width: {{$persentasi[$tugas->judul_tugas]}}%"></div>
                          @elseif ($persentasi[$tugas->judul_tugas]<=65)
                          <div class="progress-bar progress-bar-yellow" style="width: {{$persentasi[$tugas->judul_tugas]}}%"></div>
                          @elseif ($persentasi[$tugas->judul_tugas]<=85)
                          <div class="progress-bar progress-bar-primary" style="width: {{$persentasi[$tugas->judul_tugas]}}%"></div>
                          @else 
                          <div class="progress-bar progress-bar-success" style="width: {{$persentasi[$tugas->judul_tugas]}}%"></div>
                          @endif
                        </div>
                      </td>
                      <td>
                        @if ($persentasi[$tugas->judul_tugas] <=40)
                        <span class="badge bg-red">{{$persentasi[$tugas->judul_tugas]}}%</span>
                        @elseif ($persentasi[$tugas->judul_tugas]<=65)
                        <span class="badge bg-yellow">{{$persentasi[$tugas->judul_tugas]}}%</span>
                        @elseif ($persentasi[$tugas->judul_tugas]<=85)
                        <span class="badge bg-light-blue">{{$persentasi[$tugas->judul_tugas]}}%</span>
                        @else
                        <span class="badge bg-green">{{$persentasi[$tugas->judul_tugas]}}%</span>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
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
