@extends('admin.master')
@section('content-header')
    <section class="content-header">
      <h1>
        Nilai Siswa
        <small>Silakan Cari Siswa Terlebih Dahulu !!!</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Widgets</li>
      </ol>
    </section>
@endsection
@section('main-content')
    <!-- Main content -->
    <section class="content">
      <!-- search form (Optional) -->
        <div class="input-group">
          <input type="text" name="query" class="cari form-control" placeholder="Masukkan Nama Siswa...">
          <span class="input-group-btn">
              <a href="{{route('fetchsiswa')}}" class="btn btn-primary" type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </a>
            </span>
        </div>
        {{csrf_field()}}

      <!-- /.search form -->
      <div id="countryList">
      </div>
      
    </section>
    <!-- /.content -->
@endsection
