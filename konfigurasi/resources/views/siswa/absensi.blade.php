@extends('siswa.mastersiswa')
@section('content')
<section class="content-header">
	<h1>
		Absensi
	</h1>
	<ol class="breadcrumb">
        <li><a href="/siswa"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">Absensi</a>
      </ol>
</section>
<section class="content">
	<div class="row">
	  <div class="col-md-12">
	  	<p>Keterangan Absensi : 
	  		<label><i class="fa fa-lg fa-circle" style="color:#00c0ef "></i> Hadir</label>
	  		<label> <i class="fa fa-lg fa-circle" style="color:#dd4b39 "></i> Tanpa Keterangan</label>
	  		<label> <i class="fa fa-lg fa-circle" style="color:#00a65a "></i> Ijin</label>
	  		<label> <i class="fa fa-lg fa-circle" style="color:#f39c12 "></i> Sakit</label>
	  		<label> <i class="fa fa-lg fa-circle" style="color:#d2d6de"></i> Dispensasi</label>
	  </p>
		<div class="box box-primary">
			<div class="box-body no-padding">
				<div id="calender-siswa"></div>
			</div>
		</div>
	  </div>
	</div>
</section>
@endsection