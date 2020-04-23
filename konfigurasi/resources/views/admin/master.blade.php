<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
@include('template.header')
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-green-light sidebar-mini" >
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <img class="logo-mini" src="{{asset('img/logo.png')}}" alt="logo" style="width: 50px;">
      <!-- logo for regular state and mobile devices -->
      <img src="{{asset('img/baner.png')}}" class="logo-lg" alt="baner" style="width: 180px">
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li><a href="/logout"><i class="fa fa-sign-out"></i>Keluar</a></li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      @foreach ($user as $u)
      <div class="user-panel">
        <div class="pull-left image">
          <img src="@if (($u->foto_profil)==TRUE){{url('/foto_profil/'.$u->foto_profil)}} @else {{asset('dist/img/avatar5.png')}} @endif" class="img-circle" alt="User Image" id="foto_profil">
        </div>
        <div class="pull-left info">
          <p>{{$u->nama}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> {{$u->hakakses->nama_type}}</a>
        </div>
      </div>
      @endforeach

      <!-- search form (Optional) -->
        <div class="input-group sidebar-form">
          <input type="text" class=" form-control" placeholder="Cari Siswa..."  id="cari">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
        {{csrf_field()}}
        <div id="listsiswa">
        </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu Utama</li>
        <!-- Optionally, you can add icons to the links -->
        <li id="li_dsb"><a id="ln-dsb" href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
        <li id="li_stts"><a href="{{route('status')}}"><i class="fa fa-check"></i><span>Status Pendaftar</span></a></li>
        <li id="li_kgt"><a href="{{route('kegiatan')}}"><i class="fa fa-newspaper-o"></i><span>Data Kegiatan</span></a></li>
        <li id="li_xtr"><a href="{{route('extra')}}"><i class="fa fa-futbol-o"></i><span>Data Ekstra Kurikuler</span></a></li>
        <li id="li_prt"><a href="{{route('prestasi')}}"><i class="fa fa-gift"></i><span>Data Prestasi Siswa</span></a></li>
        <li id="li_pelajaran"><a href="{{route('pelajaran')}}"><i class="fa fa-book"></i> <span>Tambah Mata Pelajaran</span></a></li>
        <li id="li_siswa"><a href="{{route('siswa')}}"><i class="fa fa-user"></i> <span>Data Siswa</span></a></li>
        <li id="li_nilai_siswa"><a href="{{route('nilai_siswa')}}"><i class="fa fa-edit"></i> <span>Edit Nilai Siswa</span></a></li>
        <li id="li_schedule"><a href="{{route('jadwal-pelajaran')}}"><i class="fa fa-book"></i><span>Jadwal Pelajaran</span></a></li>
        <li id="li_cal"><a href="{{route('kalender')}}"><i class="fa fa-calendar"></i><span>Kalender Acara</span></a></li>
        <li id="li_user"><a href="{{route('pengguna')}}"><i class="fa fa-users"></i><span>Data Pengguna</span></a></li>
        <li id="li_emplo"><a href="{{route('pegawai')}}"><i class="fa fa-github"></i><span>Data Pegawai</span></a></li>
        <li id="li_abs"><a href="{{route('absensi')}}"><i class="fa fa-calendar-check-o"></i><span>Absensi Siswa</span></a></li>
        <li><a href="/logout"><i class="fa fa-sign-out"></i><span>Keluar</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('content-header')
    @yield('main-content')
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Versi 1.0
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2017 <a href="javascript:void(0)">SD Dana Punia Singaraja</a>.</strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
@include('template.js')
</body>
</html>