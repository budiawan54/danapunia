@extends('admin.master')
@section('main-content')
<section class="content-header">
      <h1>
        Jadwal Pelajaran
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-calendar"></i>Jadwal Pelajaran</li>
      </ol>
    </section>
<section class="content">
	@if (Session::has('alert-success'))
    <div class="container alert alert-success"><h4><center><i class="fa fa-lg fa-check"></i> {{Session::get('alert-success')}}</center></h4>
  </div>
  @endif
  @if($errors->has('tanggal') || $errors->has('matapelajaran')|| $errors->has('jam_mulai')|| $errors->has('jam_selesai')|| $errors->has('nama_pengajar'))
  <div class="container alert alert-error"><h4><center><i class="fa fa-lg fa-ban"></i> Mohon periksa kembali data yang diinput!</center></h4>
  </div>
  @endif
	<div class="box box-info">
		<div class="box-header">
			<h3 class="box-title" id="tambah_jadwal_pelajaran">Tambah Jadwal Pelajaran</h3>
		</div>
		<form id="input_jadwal_pelajaran" action="{{route('prosesjadwalpelajaran')}}" method="post">
			{{csrf_field()}}
			<input type="hidden" id="id" name="id">
			<div class="box-body">
				<div class="col-sm-2">
					<label for="Kelas">Kelas</label>
					<div class='input-group' id="kelas">
	                    <span class="input-group-addon">
	                    <span class="glyphicon glyphicon-user"></span>
	                    </span>
	                    <select class="form-control" name="kelas">
	                    <option value="1">Kelas 1</option>
	                    <option value="2">Kelas 2</option>
	                    <option value="3">Kelas 3</option>
	                    <option value="4">Kelas 4</option>
	                    <option value="5">Kelas 5</option>
	                    <option value="6">Kelas 6	</option>
	                    </select>
					</div>
					@if ($errors->has('kelas'))<p class="text-danger">{{$errors->first('kelas')}}</p>@endif
				</div>
				<div class="col-sm-2">
					<label for="tanggal">Hari</label>
					<div class='input-group' id="hari">
	                    <span class="input-group-addon">
	                    <span class="glyphicon glyphicon-calendar"></span>
	                    </span>
	                    <select class="form-control" name="hari">
	                    <option value="1">Senin</option>
	                    <option value="2">Selasa</option>
	                    <option value="3">Rabu</option>
	                    <option value="4">Kamis</option>
	                    <option value="5">Jumat</option>
	                    <option value="6">Sabtu	</option>
	                    </select>
					</div>
					@if ($errors->has('hari'))<p class="text-danger">{{$errors->first('hari')}}</p>@endif
				</div>
				<div class="col-sm-2">
					<label for="jampelajaran">Jam ke</label>
						<div class="input-group" id="jampelajaran">
						<span class="input-group-addon">
	                    <span class="glyphicon glyphicon-time"></span>
	                    </span>
						<input type="text" name="jampelajaran" class="form-control jampelajaran">
					</div>
					@if ($errors->has('jampelajaran'))<p class="text-danger">{{$errors->first('jampelajaran')}}</p>@endif
				</div>
				<div class="col-sm-2">
					<label for="tanggal">Jam Mulai</label>
					<div class='input-group' id="mulai_mp">
	                    <span class="input-group-addon">
	                    <span class="glyphicon glyphicon-time"></span>
	                    </span>
	                    <input type='time' class="form-control mulai_mp" name='mulai_mp' />
					</div>
					@if ($errors->has('mulai_mp'))<p class="text-danger">{{$errors->first('mulai_mp')}}</p>@endif
				</div>
				<div class="col-sm-2">
					<label for="tanggal">Jam Selesai</label>
					<div class='input-group' id="akhir_mp">
	                    <span class="input-group-addon">
	                    <span class="glyphicon glyphicon-time"></span>
	                    </span>
	                    <input type='time' class="form-control akhir_mp" name='akhir_mp'  />
					</div>
					@if ($errors->has('akhir_mp'))<p class="text-danger">{{$errors->first('akhir_mp')}}</p>@endif
				</div>
				<div class="col-sm-3">
					<label for="Mata Pelajaran">Mata Pelajaran</label>
					<div class="input-group" id="matapelajaran">
						<span class="input-group-addon">
						<span class="glyphicon glyphicon-book"></span></span>
						<select class="form-control select2" name="matapelajaran" style="width: 100%;">
							@foreach ($pelajaran as $pelajaran)
							<option value="{{$pelajaran->id_pelajaran}}">{{$pelajaran->nama_pelajaran}}</option>
							@endforeach
						</select>
					</div>
					@if ($errors->has('matapelajaran'))<p class="text-danger">{{$errors->first('matapelajaran')}}</p>@endif
				</div>
				<div class="col-sm-3">
					<label for="nama_pengajar">Nama Pengajar</label>
					<div class="input-group" id="nama_pengajar">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-user"></span></span>
						<select class="form-control select2" style="width: 100%;" name="nama_pengajar">
							@foreach ($jabatan as $guru)
							<option value="{{$guru->id_pegawai}}">{{$guru->nama_pegawai}}</option>
							@endforeach
						</select>
					</div>
					@if ($errors->has('nama_pengajar'))<p class="text-danger">{{$errors->first('nama_pengajar')}}</p>@endif
				</div>
				<div class="col-sm-2">
					<label for="color">Warna</label>
					<select class="form-control" name="color" id="color">
						<option value="#000000">Hitam</option>
						<option value="#e1b16a">Kuning</option>
						<option value="#3c8447">Hijau</option>
						<option value="#6da4bf">Biru</option>
						<option value="#f26964">Merah</option>
					</select>
					@if ($errors->has('color'))<p class="text-danger">{{$errors->first('color')}}</p>@endif
				</div>
			</div>
			<div class="box-footer">
				<button class="btn btn-primary" type="submit">Submit</button>
				<a class="lihat-jadwal btn btn-info" onclick="lihatjadwal()">Lihat Jadwal</a>
			</div>
		</form>
	</div>
<!-- row -->
      <div class="row hidden">
      	<div class="col-md-7">
          <div class="box">
            <div class="box-header">
              <a class="box-title" href="#" style="color: black">Tabel Jadwal Pelajaran</a>
              <div class="box-tools pull-right">
              	<button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-info btn-sm"><i class="fa fa-times"></i>
                </button>
              </div>	
            </div>
            <!-- /.box-header -->
            
            <div class="box-body table-responsive">
              <table class="table  table-striped table-bordered" id="table_jadwal_pelajaran" style="width: 100%">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Hari/Tanggal</th>
                  <th>Kelas</th>
                  <th>Jam Pelajaran</th>
                  <th>Mata Pelajaran</th>
                  <th>Jam Mulai</th>
                  <th>Jam Selesai</th>
                  <th>Nama Pengajar</th>
                  <th>Aksi</th>
                </tr>
              </thead>
            </table>
            </div>
            </div>
            <!-- /.box-body -->
          <!-- /.box -->
        </div>
        <div class="col-md-5">
        	<div class="box box-primary">
              <div class="box-body no-padding">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
              <!-- /.box-body -->
            </div>
        </div>
    </div>
      <!-- /.row -->
</section>
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<script>
	$(document).ready(function(){
		$('#input_jadwal_pelajaran').submit(function(e){
			e.preventDefault();
			var url = $(this).attr('action');
			$.ajax({
				url : url,
				data : $(this).serialize(),
				method : 'POST',
				headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
				beforeSend : function(){
					$('p.text-danger').remove();
				},
				success : function(key){
					alert('jadwal pelajaran berhasil disimpan');
					$('input').val('');
					$('#tambah_jadwal_pelajaran').text('Tambah Jadwal Pelajaran');
					$('.row').removeClass('hidden');
					$('button.btn-primary').text('Submit')
					$('#input_jadwal_pelajaran').attr('action','{{route('prosesjadwalpelajaran')}}');
					$('#table_jadwal_pelajaran').DataTable().ajax.reload();



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
     		 	},
			})
		})
		$('#calendar').fullCalendar({
		header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay,list'
      	},
      	buttonText: {
        today: 'Hari ini',
        month: 'Bulan',
        week : 'Minggu',
        day  : 'Hari',
        list :'Daftar',
     	},
      	editable : true,
      	selectable : true,
      	events : '{{route('loaddtjp')}}',
     	eventRender: function(eventObj, $el) {
     	 $el.popover({
        title: eventObj.title,
        content: eventObj.description,
        trigger: 'hover',
        placement: 'top',
        container: 'body'
     	 });
  		}
		})
	})
$(document).on('click','.edit',function(){
	$('#tambah_jadwal_pelajaran').text('Ubah Jadwal Pelajaran');
	$('.row').addClass('hidden');
	$('button.btn-primary').text('Perbarui')
	var id =$(this).attr('id');
	$.ajax({
    url : '{{route('json')}}',
    method : 'get',
    data:{id:id},
    dataType :'json',
    success:function(data){
      $('#id').val(data[5].id)
      $('.jampelajaran').val(data[5].jampelajaran)
      $('.mulai_mp').val(data[5].jammulai)
      $('.akhir_mp').val(data[5].jamselesai)
      $('#kelas option[value='+data[5].kelas+']').attr('selected','selected')
      $('#nama_pengajar option[value='+data[5].namapengajar+']').attr('selected','selected')
      $('#hari option[value='+data[5].hari+']').attr('selected','selected')
      $('#matapelajaran option[value='+data[5].matapelajaran+']').attr('selected','selected')
      $('#color option[value="'+data[5].color+'"]').attr('selected','selected')
      $('#input_jadwal_pelajaran').attr('action','{{route('updatejadwalpelajaran')}}');
      let put = $('{{method_field('PUT')}}');
      $('#id').before(put);
    }
  })
})
var session = '{{Session::get('type')}}';
</script>
@include('template.modal')
@endsection
