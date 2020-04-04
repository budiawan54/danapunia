@extends('admin.master')
@section('main-content')
<section class="content-header">
      <h1>
        Jadwal Mengajar Siswa
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-calendar"></i>Jadwal Mengajar</li>
      </ol>
    </section>
<section class="content">
<!-- row -->
      <div class="box">
      	<div class="box-info">
          <div class="box">
            <div class="box-header">
              <a class="box-title" href="#" style="color: black">Tabel Jadwal Mengajar</a>
              <div class="box-tools pull-right">
              	<button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>	
            </div>
            <!-- /.box-header -->
            
            <div class="box-body table-responsive">
              <table class="table  table-striped table-bordered" id="table_jadwal_mengajar" style="width: 100%">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Hari/Tanggal</th>
                  <th>Kelas</th>
                  <th>Jam Pelajaran</th>
                  <th>Mata Pelajaran</th>
                  <th>Jam Mulai</th>
                  <th>Jam Selesai</th>
                </tr>
              </thead>
            </table>
            </div>
            </div>
            <!-- /.box-body -->
          <!-- /.box -->
        </div>
    </div>
      <!-- /.row -->
</section>
@endsection
