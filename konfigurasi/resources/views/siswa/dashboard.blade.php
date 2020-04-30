<!DOCTYPE html>
<html>
@include('template.header')
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="{{route('dashboard-siswa')}}" class="navbar-brand"><b>Admin</b>LTE</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Beranda<span class="sr-only">(current)</span></a></li>
            <li><a href="#">Absensi</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
            </div>
          </form>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Notifications Menu -->
            <li class="dropdown notifications-menu">
              <!-- Menu toggle button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <span class="label label-warning">10</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 10 notifications</li>
                <li>
                  <!-- Inner Menu: contains the notifications -->
                  <ul class="menu">
                    <li><!-- start notification -->
                      <a href="#">
                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                      </a>
                    </li>
                    <!-- end notification -->
                  </ul>
                </li>
                <li class="footer"><a href="#">View all</a></li>
              </ul>
            </li>
            <!-- Tasks Menu -->
            <li class="dropdown tasks-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-flag-o"></i>
                <span class="label label-danger">9</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">Kamu Punya 9 tugas</li>
                <li>
                  <!-- Inner menu: contains the tasks -->
                  <ul class="menu">
                    <li><!-- Task item -->
                      <a href="#">
                        <!-- Task title and progress text -->
                        <h3>
                          Design some buttons
                          <small class="pull-right">20%</small>
                        </h3>
                        <!-- The progress bar -->
                        <div class="progress xs">
                          <!-- Change the css width attribute to simulate progress -->
                          <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                            <span class="sr-only">20% Complete</span>
                          </div>
                        </div>
                      </a>
                    </li>
                    <!-- end task item -->
                  </ul>
                </li>
                <li class="footer">
                  <a href="#">Lihat semua tugas</a>
                </li>
              </ul>
            </li>
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                @foreach($siswa as $u)
                <!-- The user image in the navbar-->
                <img src="@if (($u->student_photos)==TRUE){{url('/foto_siswa/'.$u->student_photos)}} @else {{asset('dist/img/avatar5.png')}} @endif" class="img-circle" alt="User Image" id="foto_profil" style="width: 30px">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{$u->nama_siswa}}</span>
                @endforeach
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                 <img src="@if (($u->student_photos)==TRUE){{url('/foto_siswa/'.$u->student_photos)}} @else {{asset('dist/img/avatar5.png')}} @endif" class="img-circle" alt="User Image" id="foto_profil">

                  <p>
                    {{$u->nama_siswa}}
                    <small>Kelas {{$u->kelas}}</small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="{{route('logout')}}" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Menu Utama
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
      </section>

      <!-- Main content -->
  <section class="content">
    <div class="row">
        <div class="col-md-4">
          @foreach($siswa as $siswa)
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="{{url('/foto_siswa/'.$siswa->student_photos)}}" alt="foto siswa" style="height: 70px">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="hidden" id="nomor_id">{{$siswa->id}}</h3>
              <h3 class="widget-user-username">{{$siswa->nama_siswa}}</h3>
              <h5 class="widget-user-desc">Kelas {{$siswa->kelas}}</h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="javascript:void(0)">Jumlah Tugas<span class="pull-right badge bg-blue nilai_tugas" id="{{$siswa->id}}" data-title="Masukkan jumlah tugas" data-pk='{{$siswa->id}}' data-type='number' data-url="/guru/nilai/update/jmltgs/{{$siswa->id}}" data-name='jumlah_tugas' data-belum='{{$siswa->jumlah_tugas - $siswa->tugas_selesai}}'>{{$jml_tugas}}</span></a></li>
                <li><a href="javascript:void(0)">Ulangan <span class="pull-right badge bg-aqua" id="jumlah_ulangan" data-title="Masukkan jumlah ulangan" data-pk='{{$siswa->id}}' data-type='number' data-url="/guru/nilai/update/jmltgs/{{$siswa->id}}" data-name='jumlah_ulangan' >{{$siswa->jumlah_ulangan}}</span></a></li>
                <li><a href="javascript:void(0)">Tugas Selesai <span class="pull-right badge bg-green" id="tugas_selesai" data-title="Masukkan jumlah tugas selesai" data-pk='{{$siswa->id}}' data-type='number' data-url="/guru/nilai/update/jmltgs/{{$siswa->id}}" data-name='tugas_selesai'>{{$siswa->tugas_selesai}}</span></a></li> 
                <li><a href="javascript:void(0)">Tugas Belum Selesai <span class="pull-right badge bg-red" id="tugas_belum_selesai">0</span></a></li>
                
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
          @endforeach
        </div>
        <div class="col-md-5">
          <div class="box box-primary">
            <div class="box-header">
              <h2 class="box-title">Daftar tugas</h2>
               <div class="box-tools pull-right">
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                  <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="javascript:void(0)" id="upload-tugas">Upload Tugas</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
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
        <div class="col-md-3">
           <!-- TUGAS LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Status tugas</h3>

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
                    <a href="javascript:void(0)" class="product-title">{{$st->judul_tugas}}
                    <span class="label @if($st->nama_status == 'Disetujui') label-success @elseif ($st->nama_status == 'Tidak disetujui') label-danger @elseif ($st->nama_status == 'Kurang Lengkap') label-warning @elseif ($st->nama_status == 'Belum diperiksa') label-info @endif pull-right">{{$st->nama_status}}</span>
                    </a>
                    <span class="product-description">
                          {{$st->comment}}
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
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Laporan Nilai Siswa</h3>
            </div>
            <div class="box-body">
              <div id="chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body-->
          </div>
      </div>
    </div>
      <!-- /.box -->
      <!--MODAL-->
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
      <!--END MODAL-->
  </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
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

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<script src="{{asset('bower_components/highcharts/highcharts.js')}}"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
@include('template.js')
<script>
$(function(){
  $('#table-tugas-siswa').DataTable({
      processing: true,
      serverSide: true,
      ajax : '{{route('dttugas')}}',
      columns:[
      {data : 'DT_RowIndex'},
      {data : 'judul_tugas'},
      {data : 'deskripsi',orderable: false},
      {data: 'file',
            render: function(data, type, full, meta){
              if (data != null){
              return "<a href='{{ url('/storage/file-tugas')}}/"+data+"'/>"+data+"</a>";
              }
              return '<span class="label label-danger">Tidak ada file</span>';
            },
            orderable: false
        },
      ]
    })

var chart = Highcharts.chart('chart', {

                  chart: {
                      type: 'column'
                  },

                  title: {
                      text: 'Tahun Ajaran 2020/2021'
                  },

                  subtitle: {
                      text: null
                  },

                  legend: {
                      align: 'right',
                      verticalAlign: 'middle',
                      layout: 'vertical'
                  },

                  xAxis: {
                      categories: {!!json_encode($categories)!!},
                      labels: {
                          x: -10
                      }
                  },

                  yAxis: {
                      allowDecimals: false,
                      title: {
                          text: 'Nilai'
                      }
                  },

                  series: [{
                      name:{!!json_encode($name[1])!!},
                      data: {!!json_encode($data[1])!!}
                  },{
                      name:{!!json_encode($name[2])!!},
                      data:{!!json_encode($data[2])!!}
                  },{
                      name:{!!json_encode($name[3])!!},
                      data:{!!json_encode($data[3])!!}
                  },{
                      name:{!!json_encode($name[4])!!},
                      data:{!!json_encode($data[4])!!}
                  },{
                      name:{!!json_encode($name[5])!!},
                      data:{!!json_encode($data[5])!!}
                  },
                  {
                      name:{!!json_encode($name[6])!!},
                      data:{!!json_encode($data[6])!!}
                  },
                  {
                      name:{!!json_encode($name[7])!!},
                      data:{!!json_encode($data[7])!!}
                  },
                  {
                      name:{!!json_encode($name[8])!!},
                      data:{!!json_encode($data[8])!!}
                  },
                  {
                      name:{!!json_encode($name[9])!!},
                      data:{!!json_encode($data[9])!!}
                  },
                  {
                      name: {!!json_encode($name[10])!!},
                      data: {!!json_encode($data[10])!!}
                  },
                  {
                      name: {!!json_encode($name[11])!!},
                      data: {!!json_encode($data[11])!!}
                  },
                  {
                      name: {!!json_encode($name[12])!!},
                      data: {!!json_encode($data[12])!!}
                  },
                  ],

                  responsive: {
                      rules: [{
                          condition: {
                              maxWidth: 500
                          },
                          chartOptions: {
                              legend: {
                                  align: 'center',
                                  verticalAlign: 'bottom',
                                  layout: 'horizontal'
                              },
                              yAxis: {
                                  labels: {
                                      align: 'left',
                                      x: 0,
                                      y: -5
                                  },
                                  title: {
                                      text: null
                                  }
                              },
                              subtitle: {
                                  text: null
                              },
                              credits: {
                                  enabled: false
                              }
                          }
                      }]
                  }
});

  $('#upload-tugas').click(function(){
    $('.modal').modal('show')
  })
  $('#form-upload-tugas').submit(function(e){
    e.preventDefault();
    $.ajax({
          url : '{{route('uploadtugas')}}',
          type : 'post',
          data : new FormData(this),
          contentType : false,
          processData : false,
          beforeSend:function(){
          $('strong.text-danger').remove();
        },
          success:function(){
            alert ('tugas berhasil ditambahkan')
            $('.modal').modal('hide')
            $('input').val('')
            $('textarea').val('')
        },
          error: function(xhr){
          let response = xhr.responseJSON
          let errors = response.errors
          if($.isEmptyObject(errors)==false){
           $.each(errors,function(key,value){
             var p = $('<strong class="text-danger"></strong>').text(value);
             $('#'+key).after(p);
             
              })
            }
        }
    })
  })
})
</script>
</body>
</html>
