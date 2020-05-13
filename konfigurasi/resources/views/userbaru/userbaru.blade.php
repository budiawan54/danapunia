@extends('admin.master')
@section('content-header')
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>
@endsection
@section('main-content')
    <!-- Main content -->
    <section class="content container-fluid">
        <!-- /.carousel -->
        <div class="row">
        <div class="col-md-6">
          <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-bullhorn"></i>

              <h3 class="box-title">Buruan Daftar!!!</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <div class="callout callout-info">
                <h4>Lihat lebih banyak kegiatan siswa kami di situs resmi <a href="">SD Dana Punia Singaraja</a></h4>

                <p>Klik tombol download file di bawah ini untuk mengisi formulir pendaftaran!!!.</p>
              </div>
              <center><a class="btn btn-app" href="{{url('/storage/file-pendaftaran/file-pendaftaran.pdf')}}">
                <i class="fa fa-cloud-download"></i> Download
              </a></center>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-md-6">
          <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-bullhorn"></i>

              <h3 class="box-title">Buruan Daftar!!!</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <div class="callout callout-danger">
                <h4>Lihat batas pendaftaran siswa di situs resmi <a href="http://sddanapunia.com">SD Dana Punia Singaraja</a> sebelum terlambat.</h4>

                <p>Klik tombol unggah di bawah ini untuk mengunggah file pendaftaran!!!.</p>
              </div>
              <form action="{{route('uploaddata')}}" method="post" enctype="multipart/form-data" id="upload-data">
              {{csrf_field()}}  
              <div class="form-group">
                  <label>Alasan memilih SD Dana Punia Singaraja :</label>
                  <textarea class="form-control" name="alasan" id="alasan" rows="5" placeholder="Deskripsikan secara singkat....">{{old('alasan')}}</textarea>
                  @if($errors->has('alasan'))<strong class="text-danger">{{$errors->first('alasan')}}</strong>@endif
                </div>
                <div class="form-group">
                  <label for="">No. Telp/Hp/Whatsapp :</label>
                  <input type="number" name='telp' id="telp" class="form-control" max="13" value="{{old('telp')}}">
                  @if($errors->has('telp'))<strong class="text-danger">{{$errors->first('telp')}}</strong>@endif
                  <p>Silakan masukkan nomor hp yang bisa dihubungi atau terus cek situs ini untuk pemberitahuan status pendaftaran selanjutnya!</p>
                </div>
                <div class="form-group">
                  <div class="btn btn-default btn-file">
                    <i class="fa fa-paperclip"></i>
                    <input type="file" name="formulir" id="formulir">
                  </div> <strong id="preview"></strong>
                  @if($errors->has('formulir'))<strong class="text-danger">{{$errors->first('formulir')}}</strong>@endif
                  <p>* Maksimal ukuran file adalah 32MB</p>
                </div>
                 <center>
                  <a class="btn btn-app" type='submit' onclick="$('#upload-data').submit()">
                    <i class="fa fa-cloud-upload">
                    </i>Unggah
                  </a>
                </center> 
              </form>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa  fa-thumbs-o-up"></i>

              <h3 class="box-title">Prestasi Anak-anak SD Dana Punia Singaraja</h3>
            </div>
            <div class="box-body">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <?php 
                    $i = 0;
                    foreach ($prestasi as $pres){
                    $actives ='';
                        if ($i==0){
                          $actives = 'active';
                        }
                    ?>
                  <li data-target="#carousel-example-generic" data-slide-to="<?= $i; ?>" class="<?= $actives; ?>"></li>
                  <?php $i++; } ?>  
                </ol>
                <div class="carousel-inner">
                    <?php 
                    $i = 0;
                    foreach ($prestasi as $pres){
                    $actives ='';
                        if ($i==0){
                          $actives = 'active';
                        }
                    ?>
                  <div class="item <?= $actives; ?>">
                    <img src="{{url('/foto_prestasi/'.$pres->foto_prestasi)}}" alt="First slide" style="height: 325px; width: 900px">
                    <div class="carousel-caption" style="background-color: black">
                      <?= $pres['nama_prestasi']; ?>
                    </div>
                  </div>
                  <?php $i++; } ?>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.carousel -->
        <!-- KOLOM KANAN-->
        <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-hand-pointer-o"></i>

              <h3 class="box-title">Wajib Tahu!!!</h3>
            </div>
            
            <div class="box-body">
              <div class="timeline-body">
                <div class="embed-responsive embed-responsive-16by9">
                 <iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2FSDDanaPunia%2Fvideos%2F2399197046982261%2F%3Ft%3D5&width=500&show_text=true&appId=897013127121407&height=200" width="300" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media" allowFullScreen="true"></iframe>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- AKHIR KOLOM KANAN-->
      </div>
      <!---BARIS-->
      
      <!--AKHIR BARIS-->
    </section>
    <!-- /.content -->
@endsection
<script>
  console.log({{Session::get('id_user')}});
</script>