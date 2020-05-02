@extends('siswa.mastersiswa')
@section('content')
<section class="content-header">
      <h1>
        Data tugas <i class="fa fa-book"></i>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/siswa"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tugas</a>
      </ol>
    </section>
<section class="content">
  <button class="btn btn-success" id="cek-tugas"><i class="fa fa-check"></i> Cek status tugas</button>
  <button class="btn btn-info" id="upload-tugas"><i class="fa fa-upload"></i> Upload tugas</button>
  <div class="row" style="padding-top: 10px">
    <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
              <center><h2 class="box-title"><i class="fa fa-list"></i> Daftar tugas</h2></center>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped" id="table-tugas-siswa">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Judul Tugas</th>
                      <th>Deskripsi Tugas</th>
                      <th>File</th>
                    </tr>
                  </thead> 
                </table>
              </div>
          </div> 
          </div>
    </div>
    <div class="col-md-6">
        <!-- TUGAS LIST -->
      <div class="box box-primary hidden status-tugas">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-check"></i> Status tugas</h3>

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
                    <a href="{{ url('/storage/file-tugas/'.$st->file_siswa)}}" class="product-title">{{$st->judul_tugas}}
                    <span class="label @if($st->nama_status == 'Disetujui') label-success @elseif ($st->nama_status == 'Tidak disetujui') label-danger @elseif ($st->nama_status == 'Kurang Lengkap') label-warning @elseif ($st->nama_status == 'Belum diperiksa') label-info @endif pull-right">{{$st->nama_status}}</span>
                    </a>
                    <span class="product-description">
                          {{$st->comment}}
                          <span class="pull-right"><i class="fa fa-clock-o"></i> {{date('d-M-Y H:i',strtotime($st->{'Updated_at'}))}}</span>
                    </span>
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
  </div>
</section>
      
      
<div class="modal fade" id="modal-upload-tugas">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <center><h4><i class="fa fa-upload"></i> Upload tugas</h4></center>
      </div>
      <div class="modal-body">
        <form id="form-upload-tugas" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="form-group">
            <label>Pilih tugas:</label>
            <select class="form-control" id="judul_tugas" name="judul_tugas">
              @foreach($tugas as $tugas)
              <option value="{{$tugas->id_tugas}}">{{$tugas->judul_tugas}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <input type="file" class="form-control" name="file" id="file">
          </div>
          <div class="form-group"> 
            <textarea class="form-control" name="komentar" rows="4" placeholder="Tulis komentar disini..." id="jawaban">{{{ old('deskripsi') }}}</textarea>
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