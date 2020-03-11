
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
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Widgets</li>
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
                <li><a href="#">Jumlah Tugas <span class="pull-right badge bg-blue">31</span></a></li>
                <li><a href="#">Ulangan <span class="pull-right badge bg-aqua">5</span></a></li>
                <li><a href="#">Tugas Selesai <span class="pull-right badge bg-green">12</span></a></li>
                <li><a href="#">Tugas Belum Selesai <span class="pull-right badge bg-red">842</span></a></li>
                <li><a href="#" id="username" data-type="text" data-pk="1" data-url="/post" data-title="Enter username">superuser</a></li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <div class="col-md-8">
        	<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Nilai Siswa</h3>
              <button class="btn btn-primary pull-right" id="btnTambah">Tambah Nilai</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Kode Pelajaran</th>
                  <th>Nama Pelajaran</th>
                  <th>Nilai Ulangan Umum</th>
                  <th>Nilai Ulangan Harian 1</th>
                  <th>Nilai Ulangan Harian 2</th>
                </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th colspan="2"></th>
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
    <div class="row">
    	<div class="container">
    	<!-- Bar chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Laporan Nilai Siswa</h3>
            </div>
            <div class="box-body">
              <div id="bar-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body-->
          </div>
      	</div>
    </div>
    </section>

    <!-- /.content -->
  <!-- /.content-wrapper -->
      <!--MODAL-->
      <div class="modal fade" id="tambah">
                    <div class="modal-dialog">
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
                            <div class="form-group">
                              <label>Nilai Ulangan Umum 1</label>
                              <input type="number" class="form-control" id="ulu1" name="ulu1" >
                             
                            </div>
                            <div class="form-group">
                              <label>Nilai Ulangan Harian 1</label>
                              <input type="number" class="form-control" id="ulh1"  name="ulh1">
                             </div>
                             <div class="form-group">
                              <label>Nilai Ulangan Harian 2</label>
                              <input type="number" class="form-control" id="ulh2" name="ulh2"> 
                             </div>
                             <div class="form-group" id="dynamic-form" style="display: none">
                              <label >Nilai Ulangan Harian 3</label>
                              <input type="text" id="ulh3" name="ulh3" class="form-control">
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
<script type="text/javascript">

	$(function(){
    var id = $('#nomor_id').text();
		$('#example1').DataTable({
      processing:true,
      serverSide:true,
      ajax : '/guru/nilai/get/'+id,
      columns:[
        {data:'kode_mp',name:'kode_mp'},
        {data:'nama_pelajaran'},
        {data:'ulangan_umum_1'},
        {data:'ulangan_harian_1'},
        {data:'ulangan_harian_2'},
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
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var ulh1Total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            var ulh2Total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                //footer
                $( api.column( 0 ).footer()).html('Rata-rata');
                $(api.column(2).footer()).html((uluTotal/data.length).toFixed(2));
                $(api.column(3).footer()).html((ulh1Total/data.length).toFixed(2));
                $(api.column(4).footer()).html((ulh2Total/data.length).toFixed(2));
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
      beforeSend:function(){
        $('p').remove();
        $('input').val('');
      },
      success:function(data){
      alert('Nilai berhasil ditambahkan');
      $('.modal').modal('hide');
      $('#example1').DataTable().ajax.reload();
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

  $('.btnTambahform').click(function(){
    $('#dynamic-form').attr('style','');
  })
})

</script>
@endsection