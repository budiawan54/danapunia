
@extends('admin.master')
<title>Nilai Siswa</title>
<link rel="icon" href="{{asset('img/logo.ico')}}">
@section('content-header')
    <section class="content-header">
      <h1>
        Nilai Siswa
        <small>Preview nilai</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('dashboard-guru')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Nilai</li>
      </ol>
    </section>
@endsection
@section('main-content')
    <!-- Main content -->
    <section class="content">
    <div class="row">
		    <div class="col-md-4">
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
                <li><a href="javascript:void(0)">Jumlah Tugas<span class="pull-right badge bg-blue nilai_tugas" id="{{$siswa->id}}" data-title="Masukkan jumlah tugas" data-pk='{{$siswa->id}}' data-type='number' data-url="/guru/nilai/update/jmltgs/{{$siswa->id}}" data-name='jumlah_tugas' data-belum='{{$siswa->jumlah_tugas - $siswa->tugas_selesai}}'>{{$siswa->jumlah_tugas}}</span></a></li>
                <li><a href="javascript:void(0)">Ulangan <span class="pull-right badge bg-aqua" id="jumlah_ulangan" data-title="Masukkan jumlah ulangan" data-pk='{{$siswa->id}}' data-type='number' data-url="/guru/nilai/update/jmltgs/{{$siswa->id}}" data-name='jumlah_ulangan'  >{{$siswa->jumlah_ulangan}}</span></a></li>
                <li><a href="javascript:void(0)">Tugas Selesai <span class="pull-right badge bg-green" id="tugas_selesai" data-title="Masukkan jumlah tugas selesai" data-pk='{{$siswa->id}}' data-type='number' data-url="/guru/nilai/update/jmltgs/{{$siswa->id}}" data-name='tugas_selesai'>{{$siswa->tugas_selesai}}</span></a></li> 
                <li><a href="javascript:void(0)">Tugas Belum Selesai <span class="pull-right badge bg-red" id="tugas_belum_selesai">0</span></a></li>
                
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <div class="col-md-8">
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
    <div class="row">
    	<div class="col-xs-12">
    	<!-- Bar chart -->
         <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Nilai Siswa</h3>
              <button class="btn btn-primary pull-right" id="btnTambah">Tambah Nilai</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="tabel_nilai_siswa" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Pelajaran</th>
                  <th>Nama Pelajaran</th>
                  <th>Nilai Ulangan Harian 1</th>
                  <th>Nilai Ulangan Harian 2</th>
                  <th>Nilai Ulangan Harian 3</th>
                  <th>Nilai Ulangan Harian 4</th>
                  <th>Nilai Ulangan Harian 5</th>
                  <th>Nilai Ulangan Harian 6</th>
                  <th>Nilai Ulangan Harian 7</th>
                  <th>Nilai Ulangan Harian 8</th>
                  <th>Nilai Ulangan Harian 9</th>
                  <th>Nilai Ulangan Harian 10</th>
                  <th>Nilai UTS </th>
                  <th>Nilai Ulangan Umum</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody id="table_nilai">
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="3"></th>
                    <th id="rerata_ulu"></th>
                    <th id="rerata_ulh1"></th>
                    <th id="rerata_ulh2"></th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div> 
      </div>
    </div>
    </section>

    <!-- /.content -->
  <!-- /.content-wrapper -->
      <!--MODAL-->
      <div class="modal fade" id="tambah">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Tambah Nilai</h4>
                        </div>
                        <div class="modal-body">
                          <form id="tambah_data" action="" enctype="multipart/form-data">
                            <div class="box-body" >
                            {{csrf_field()}}
                            <input type="hidden" name="id" id="id" value="">
                            <div class="form-group">
                              <label for="nama_pelajaran">Nama Pelajaran</label>
                              <input type="text" class="form-control" disabled="" id="kode_mp" placeholder="">
                            </div>
                            <div class="form-group">
                              <label>Kode Pelajaran</label>
                              <select class="form-control" id="select" name="kode_mp">
                                @foreach ($kode_mp as $pelajaran)
                                <option class="form-control" name='kode_mp' value="{{$pelajaran->nama_pelajaran}}">{{$pelajaran->kode_pelajaran}}</option>
                                @endforeach
                              </select>
                              
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Nilai Ulangan Harian 1</label>
                                <input type="number" class="form-control" id="ulh1"  name="ulh1">
                               </div>
                               <div class="form-group">
                                <label>Nilai Ulangan Harian 2</label>
                                <input type="number" class="form-control" id="ulh2" name="ulh2"> 
                               </div>
                               <div class="form-group">
                                <label>Nilai Ulangan Harian 3</label>
                                <input type="number" class="form-control" id="ulh3" name="ulh3"> 
                               </div>
                               <div class="form-group">
                                <label>Nilai Ulangan Harian 4</label>
                                <input type="number" class="form-control" id="ulh4" name="ulh4"> 
                               </div>
                               <div class="form-group">
                                <label>Nilai Ulangan Harian 5</label>
                                <input type="number" class="form-control" id="ulh5" name="ulh5"> 
                               </div>
                               <div class="form-group">
                                <label>Nilai Ulangan Tengah Semester</label>
                                <input type="number" class="form-control" id="uts" name="uts"> 
                               </div>
                             </div>
                             <div class="col-md-6">
                               <div class="form-group">
                                <label>Nilai Ulangan Harian 6</label>
                                <input type="number" class="form-control" id="ulh6" name="ulh6"> 
                               </div>
                               <div class="form-group">
                                <label>Nilai Ulangan Harian 7</label>
                                <input type="number" class="form-control" id="ulh7" name="ulh7"> 
                               </div>
                               <div class="form-group">
                                <label>Nilai Ulangan Harian 8</label>
                                <input type="number" class="form-control" id="ulh8" name="ulh8"> 
                               </div>
                               <div class="form-group">
                                <label>Nilai Ulangan Harian 9</label>
                                <input type="number" class="form-control" id="ulh9" name="ulh9"> 
                               </div>
                               <div class="form-group">
                                <label>Nilai Ulangan Harian 10</label>
                                <input type="number" class="form-control" id="ulh10" name="ulh10"> 
                               </div>
                               <div class="form-group">
                                <label>Nilai Ulangan Umum</label>
                                <input type="number" class="form-control" id="ulu" name="ulu"> 
                               </div>
                             </div>
                            <a class="btnTambahform">Tambah Nilai Lain</a>
                              <div class="box-footer">
                                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                  <button type="submit" class="btn btn-primary pull-right" id="submit">Tambah Nilai</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
      </div>
      <!--BATAS MODAL-->
<!-- jQuery 3 -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('bower_components/highcharts/highcharts.js')}}"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>

$(function(){
    var id = $('#nomor_id').text();
    $.ajax({
        url:'{{route('json')}}',
          method:'get',
          data:{id:id},
          dataType:'json',
            success:function(data){
            $('span#tugas_belum_selesai').text(data[4].jumlah_tugas - data[4].tugas_selesai)
            }
      })
    $('#li_stts, #li_prf, #li_emplo, #li_user, #li_xtr, #li_kgt, #li_prt, #li_pelajaran').remove();
		$('#tabel_nilai_siswa').DataTable({
      processing:true,
      serverSide:true,
      ajax : '/guru/nilai/get/'+id,
        columns:[
          {data:'DT_RowIndex',name:'DT_RowIndex'},
          {data:'kode_pelajaran', orderable:false},
          {data:'nama_pelajaran', orderable:false},
          {data:'ulangan_harian_1',class:'update', name:'ulangan_harian_1'},
          {data:'ulangan_harian_2',class:'update', name:'ulangan_harian_2' },
          {data:'ulangan_harian_3',class:'update', name:'ulangan_harian_3'},
          {data:'ulangan_harian_4',class:'update', name:'ulangan_harian_4'},
          {data:'ulangan_harian_5',class:'update', name:'ulangan_harian_5'},
          {data:'ulangan_harian_6',class:'update', name:'ulangan_harian_6'},
          {data:'ulangan_harian_7',class:'update', name:'ulangan_harian_7'},
          {data:'ulangan_harian_8',class:'update', name:'ulangan_harian_8'},
          {data:'ulangan_harian_9',class:'update', name:'ulangan_harian_9'},
          {data:'ulangan_harian_10',class:'update', name:'ulangan_harian_10'},
          {data:'uts',class:'update', name:'uts'},
          {data:'ulangan_umum',class:'update', name:'ulangan_umum'},
          {data:'action',name:'action'},
          ],
          columnDefs: [
             {
                'targets': 3,
                'createdCell':  function (td, cellData, rowData, row, col) {
                   $(td).attr('id', 'ulangan_harian_1');
                   $(td).attr('data-pk', rowData.id); 
                }
             },
             {
                'targets': 4,
                'createdCell':  function (td, cellData, rowData, row, col) {
                   $(td).attr('id', 'ulangan_harian_2');
                   $(td).attr('data-pk', rowData.id); 
                }
             },
             {
                'targets': 5,
                'createdCell':  function (td, cellData, rowData, row, col) {
                   $(td).attr('id', 'ulangan_harian_3');
                   $(td).attr('data-pk', rowData.id);
                }
             },
             {
                'targets': 6,
                'createdCell':  function (td, cellData, rowData, row, col) {
                   $(td).attr('id', 'ulangan_harian_4'); 
                   $(td).attr('data-pk', rowData.id);
                }
             },
             {
                'targets': 7,
                'createdCell':  function (td, cellData, rowData, row, col) {
                   $(td).attr('id', 'ulangan_harian_5'); 
                   $(td).attr('data-pk', rowData.id);
                }
             },
             {
                'targets': 8,
                'createdCell':  function (td, cellData, rowData, row, col) {
                   $(td).attr('id', 'ulangan_harian_6'); 
                   $(td).attr('data-pk', rowData.id);
                }
             },
             {
                'targets': 9,
                'createdCell':  function (td, cellData, rowData, row, col) {
                   $(td).attr('id', 'ulangan_harian_7'); 
                   $(td).attr('data-pk', rowData.id);
                }
             },
             {
                'targets': 10,
                'createdCell':  function (td, cellData, rowData, row, col) {
                   $(td).attr('id', 'ulangan_harian_8'); 
                   $(td).attr('data-pk', rowData.id);
                }
             },
             {
                'targets': 11,
                'createdCell':  function (td, cellData, rowData, row, col) {
                   $(td).attr('id', 'ulangan_harian_9'); 
                   $(td).attr('data-pk', rowData.id);
                }
             },
             {
                'targets': 12,
                'createdCell':  function (td, cellData, rowData, row, col) {
                   $(td).attr('id', 'ulangan_harian_10'); 
                   $(td).attr('data-pk', rowData.id);
                }
             },
             {
                'targets': 13,
                'createdCell':  function (td, cellData, rowData, row, col) {
                   $(td).attr('id', 'uts');
                   $(td).attr('data-pk', rowData.id); 
                }
             },
             {
                'targets': 14,
                'createdCell':  function (td, cellData, rowData, row, col) {
                   $(td).attr('id', 'ulangan_umum'); 
                   $(td).attr('data-pk', rowData.id);
                }
             },
             {
                'targets': 15,
                'orderable' : false
             },
          ],
          "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
     
                // converting to interger to find total
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
     
                // computing column Total of the complete result 
                var uluTotal = api
                    .column( 3 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                var ulh1Total = api
                    .column( 4 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                var ulh2Total = api
                    .column( 5 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                    //footer
                    $( api.column( 0 ).footer()).html('Rata-rata');
                    $(api.column(3).footer()).html((uluTotal/data.length).toFixed(2));
                    $(api.column(4).footer()).html((ulh1Total/data.length).toFixed(2));
                    $(api.column(5).footer()).html((ulh2Total/data.length).toFixed(2));
                  },
    })
})

 $(document).ready(function(){
    $('#cari').keyup(function(){ 
          var query = $(this).val();
          if(query != '')
          {
           var _token = $('input[name="_token"]').val();
           $.ajax({
            url:"/guru/siswa/cari",
            method:"POST",
            data:{query:query, _token:_token},
            success:function(data){
             $('#listsiswa').fadeIn();  
                      $('#listsiswa').html(data);
                      
            }
           });
          } else {
            $('#listsiswa').destroy();
          }
    }); 
});

$(function(){
  $('#btnTambah').on('click',function(){
    $('#tambah').modal('show');
    var id= $('#nomor_id').text();
    $('#id').val(id);
    $('#tambah_data').attr('action','/guru/simpan/nilai');
    $('#select').change(function(){
        var kode_pelajaran = $(this).val();
        $('#kode_mp').attr('placeholder',kode_pelajaran);    
    })
  })
})

$(function(){
  $('#tambah_data').submit(function(e){
    e.preventDefault();
    var url = $(this).attr('action');
    $.ajax({
      url:url,
      method: 'POST',
      data: $(this).serialize(),
      headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}, 
      beforeSend:function(){
        $('p').remove();
       
      },
      success:function(data){
      alert('Nilai berhasil ditambahkan');
      $('.modal').modal('hide');
      $('input').val('');
      $('#tabel_nilai_siswa').DataTable().ajax.reload();
      },
      error: function(xhr){
        let response = xhr.responseJSON
        let errors = response.errors
        if($.isEmptyObject(errors)==false){
           $.each(errors,function(key,value){
             var p = $('<p class="text-danger"></p>').text(value);
             $('#'+key).after(p);
             
           })
        }
      }
    })
  })

  $(document).on('click','.btn-del',function(){
    var id = $(this).attr('id');
    console.log(id)
    $.ajax({
      url:'{{route('json')}}',
      method: 'get',
      data:{id:id},
      dataType:'json',
      success:function(data){
        $('b').text(data[6].kode_mp)
        $('#modal-body').find('span').text('Nilai')
        $('#modal-title').text('Hapus Nilai')
        $('#confirm').click(function(e){
          e.preventDefault();
          $.ajax({
          url : '{{route('deletenilai')}}',
          type : 'put',
          data : {id:id},
          headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
          success:function (){
            $('.modal').modal('hide')
            alert('nilai berhasil dihapus');
            $('#tabel_nilai_siswa').DataTable().ajax.reload();
            } 
          }) // END ROW AJAX DELETE
        })
        const id = data[6].id
        
      }
    })
  })
});

//HIGHCARTS
$(function chart(){
var id = $('#nomor_id').text();
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
        name: {!!json_encode($nama[1])!!},
        data: {!!json_encode($data[1])!!}
    }, {
        name: {!!json_encode($nama[2])!!},
        data: {!!json_encode($data[2])!!}
    }, {
        name: {!!json_encode($nama[3])!!},
        data: {!!json_encode($data[3])!!}
    }, {
        name: {!!json_encode($nama[4])!!},
        data: {!!json_encode($data[4])!!}
    },{
        name: {!!json_encode($nama[5])!!},
        data: {!!json_encode($data[5])!!}
    }, {
        name: {!!json_encode($nama[6])!!},
        data: {!!json_encode($data[6])!!}
    }, {
        name: {!!json_encode($nama[7])!!},
        data: {!!json_encode($data[7])!!}
    }, {
        name: {!!json_encode($nama[8])!!},
        data: {!!json_encode($data[8])!!}
    }, {
        name: {!!json_encode($nama[9])!!},
        data: {!!json_encode($data[9])!!}
    }, {
        name: {!!json_encode($nama[10])!!},
        data: {!!json_encode($data[10])!!}
    }, {
        name: {!!json_encode($nama[11])!!},
        data: {!!json_encode($data[11])!!}
    }
    , {
        name: {!!json_encode($nama[12])!!},
        data: {!!json_encode($data[12])!!}
    }],

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
$('#table_nilai').editable({
      container : 'body',
      selector : 'td.update',
      type : 'number',
      name : $('td.update').attr('id'),
      url :'{{route('updatenilai')}}',
      ajaxOptions: {
      method :'put'
      },
      success:function(){       
        $.ajax({
        url : '{{route('getnilai')}}',
        type :'post',
        data : {id:id},
        dataType :'json',
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
          success: process,
        })
      }
});
});

//HASIL RELOAD CHART
function process(data){
            console.log(data)
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
                      name: data[0][1],
                      data: data[1][1]
                  },{
                      name: data[0][2],
                      data: data[1][2]
                  },{
                      name: data[0][3],
                      data: data[1][3]
                  },{
                      name: data[0][4],
                      data: data[1][4]
                  },{
                      name: data[0][5],
                      data: data[1][5]
                  },
                  {
                      name: data[0][6],
                      data: data[1][6]
                  },
                  {
                      name: data[0][7],
                      data: data[1][7]
                  },
                  {
                      name: data[0][8],
                      data: data[1][8]
                  },
                  {
                      name: data[0][9],
                      data: data[1][9]
                  },
                  {
                      name: data[0][10],
                      data: data[1][10]
                  },
                  {
                      name: data[0][11],
                      data: data[1][11]
                  },
                  {
                      name: data[0][12],
                      data: data[1][12]
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
         }
//END HASIL RELOAD CHART

</script>
@include('template.modal')
@endsection