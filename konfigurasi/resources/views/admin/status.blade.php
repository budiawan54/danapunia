@extends('admin.master')
    @section('content-header')
    <section class="content-header">
      <h1>
        Status
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="#"><i class="fa fa-check"></i>Status</a>
      </ol>
    </section>
    @endsection
@section('main-content')
<section class="content">
      <!-- row -->
      <div class="row">
        <div class="col-md-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Status Pendaftar</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Pendaftar</th>
                  <th>Tanggal Daftar</th>
                  <th>Status</th>
                  <th>Alasan</th>
                </tr>
                @foreach ($pendaftar as $pendaftar)
                <tr>
                  <td>{{$pendaftar->id}}</td>
                  <td>{{$pendaftar->nama}}</td>
                  <td>{{date('d M Y',strtotime($pendaftar->created_at))}}</td>
                  <td><span class="label label-success">Approved</span></td>
                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-6">
          <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-bullhorn"></i>

              <h3 class="box-title">Upload formulir pendaftaran!!!</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <div class="callout callout-danger">
                <p>Klik tombol unggah di bawah ini untuk mengunggah file pendaftaran!!!.</p>
              </div>
              <form action="{{route('uploadfile')}}" method="post" enctype="multipart/form-data" id="file-pendaftaran">
              {{csrf_field()}}
                 <input type="file" name="formulir" class="form-control">
                 @if($errors->has('formulir'))<strong class="text-danger">{{$errors->first('formulir')}}</strong>@endif
                 <center>
                    <a class="btn btn-app" type='button' onclick="document.getElementById('file-pendaftaran').submit()">
                      <i class="fa fa-cloud-upload">
                      </i>Unggah
                    </a>
                </center> 
              </form>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
      <!-- /.row -->
</section>
@endsection
