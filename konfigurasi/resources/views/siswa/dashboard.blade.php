@extends('siswa.mastersiswa')

@section('content')
      <!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Menu Utama
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-4">
          @foreach($siswa as $sis)
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="{{url('/foto_siswa/'.$sis->student_photos)}}" alt="foto siswa" style="height: 70px">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="hidden" id="nomor_id">{{$sis->id}}</h3>
              <h3 class="widget-user-username">{{$sis->nama_siswa}}</h3>
              <h5 class="widget-user-desc">Kelas {{$sis->kelas}}</h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="{{route('tugas')}}">Jumlah Tugas<span class="pull-right badge bg-blue nilai_tugas" id="{{$sis->id}}" data-title="Masukkan jumlah tugas" data-pk='{{$sis->id}}' data-type='number' data-url="/guru/nilai/update/jmltgs/{{$sis->id}}" data-name='jumlah_tugas' data-belum='{{$sis->jumlah_tugas - $sis->tugas_selesai}}'>{{$jml_tugas}}</span></a></li>
                <li><a href="javascript:void(0)">Ulangan <span class="pull-right badge bg-aqua" id="jumlah_ulangan" data-title="Masukkan jumlah ulangan" data-pk='{{$sis->id}}' data-type='number' data-url="/guru/nilai/update/jmltgs/{{$sis->id}}" data-name='jumlah_ulangan' >{{$sis->jumlah_ulangan}}</span></a></li>
                <li><a href="{{route('tugas')}}">Tugas Selesai <span class="pull-right badge bg-green" id="tugas_selesai" data-title="Masukkan jumlah tugas selesai" data-pk='{{$sis->id}}' data-type='number' data-url="/guru/nilai/update/jmltgs/{{$sis->id}}" data-name='tugas_selesai'>{{$sis->tugas_selesai}}</span></a></li> 
                <li><a href="{{route('tugas')}}">Tugas Belum Selesai <span class="pull-right badge bg-red" id="tugas_belum_selesai">0</span></a></li>
                
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
          @endforeach
        </div>
        <div class="col-md-8">
          <div class="box">
            <div class="box-header">
              <a class="box-title" href="#" style="color: black">Tabel Jadwal Pelajaran</a>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>  
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table  table-striped table-bordered" id="jadwal_pelajaran" style="width: 100%">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Hari/Tanggal</th>
                  <th>Jam Pelajaran</th>
                  <th>Mata Pelajaran</th>
                  <th>Jam Mulai</th>
                  <th>Jam Selesai</th>
                </tr>
              </thead>
            </table>
            </div>
          </div>
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
</section>
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<script src="{{asset('bower_components/highcharts/highcharts.js')}}"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
$(function(){
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
})
</script>
@endsection