@extends('admin.master')
@section('content-header')
    <section class="content-header">
      <h1>
      Absensi Siswa
      </h1>
      <ol class="breadcrumb">
        <li><a href="/guru"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="javascript:void(0)"><i class="fa fa-calendar-o"></i> Absensi Siswa</a></li>
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
    <div class="col">
      <div class="box box-success">
        <div class="box-header">
          <h2 class="box-title">Absensi Siswa</h2>
        </div>
          <!-- form start --> 
          <form method="post" action="{{route('storeabs')}}">
            <div class="box-body">
              {{csrf_field()}}
              <div class="form-group">
                <label class="control-label">Tanggal</label>     
                        <input type="date" class="form-control" placeholder="Tanggal" name="tanggal">
                        @if ($errors->has('tanggal'))<p class="text-danger">{{$errors->first('tanggal')}}</p>@endif
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                    <label  class="control-label">Nama Siswa</label> @if ($errors->has('nama_siswa'))<strong class="text-danger">{{$errors->first('nama_siswa')}}</strong>@endif<br/>

                    @foreach ($siswa as $siswa)
                    <label>
                      <input type="checkbox" class="minimal" value="{{$siswa->id}}" name="nama_siswa[]"> {{$siswa->nama_siswa}}
                    </label> <br/>
                    @endforeach
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Keterangan</label> @if ($errors->has('ket_absensi'))<strong class="text-danger">{{$errors->first('ket_absensi')}}</strong>@endif<br/>
                    @foreach ($ket_abs as $ket)
                      <label>
                        <input type="radio" name="ket_absensi" class="minimal" value="{{$ket->id_absensi}}">
                      </label> {{$ket->nama_keterangan}}<br/>
                    @endforeach
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                      <button type="submit" class="btn btn-default">Cancel</button>
                      <button type="submit" class="btn btn-success pull-right">Tambah</button>
            </div>
            <!-- /.box-footer -->
          </form>
      </div>
    </div>
    <div class="col">
      <div class="box box-info">
        <div class="box-header">
          <title>Tabel Absensi Siswa</title>
        </div>
        <div class="box-body table-responsive">
          <table class="table table-bordered table-striped" id="table_absensi">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Siswa</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="body_tb_abs"></tbody>
          </table>
        </div>
      </div>
    </div>
</section>
@include('template.modal')
@endsection