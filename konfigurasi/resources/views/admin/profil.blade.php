@extends('admin.master')
@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <center><i class="fa fa-user"></i> PROFIL</center>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../admin"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="#">Profil</a>
      </ol>
    </section>
@endsection
@section('main-content')

<section class="content">
  @if(Session::has('alert-success'))
  <div class="container">
    <div class="alert alert-success">
      <li>{{Session::get('alert-success')}}</li>
    </div> 
  </div>
  @endif
                <div class="box">
                  <div class="box-header with-border">
                    <center><h3 class="box-title">Silakan Ubah profilmu ya :)</h3></center>
                  </div>
                <!-- /.box-header -->
                      <div class="box-body">
                        @foreach ($user as $s)
                        <form class="form-horizontal" action="/admin/updateadmin/{{$s->id}}" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                            <div class="col-sm-10"> 
                                <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Lengkap</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3"  name="nama_lengkap" value="{{$s->nama}}">
                                    @if($errors->has('nama_lengkap'))<div class="text-danger">{{$errors->first('nama_lengkap')}}</div>@endif
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Pengguna</label>
                                  <div class="col-sm-10">   
                                  <input type="text" class="form-control" name="username" value="{{$s->username}}">
                                  @if($errors->has('username'))<div class="text-danger">{{$errors->first('username')}}</div>@endif
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-2 control-label">Kata Sandi</label>
                                    <div class="col-sm-10">
                                      <input type="password" class="form-control" name="password" value="{{$s->password}}">
                                      @if($errors->has('password'))<div class="text-danger">{{$errors->first('password')}}</div>@endif
                                    </div>
                                </div>
                                <div class="form-group">
                                <label for="sosmed" class="col-sm-2 control-label">Sosial Media :</label>
                                </div>
                                <div class="form-group">
                                    <label for="fb" class="col-sm-2 control-label"><i class="fa fa-facebook" style="color: blue;"></i> Facebook</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="fb" value="{{$s->facebook}}">
                                      @if($errors->has('fb'))<div class="text-danger">{{$errors->first('fb')}}</div>@endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="twitter" class="col-sm-2 control-label"><i class="fa fa-twitter" style="color: #43C3EB"></i> Twitter</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="tw" value="{{$s->twitter}}">
                                      @if($errors->has('tw'))<div class="text-danger">{{$errors->first('tw')}}</div>@endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ig" class="col-sm-2 control-label"><i class="fa fa-instagram"></i> Instagram </label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="ig" value="{{$s->instagram}}">
                                      @if($errors->has('ig'))<div class="text-danger">{{$errors->first('ig')}}</div>@endif
                                    </div>
                                </div>                         
                            </div>
                            <div class="col-sm-2" style="padding: 30px">
                              <center><img style="width:100px; height:150px" src="{{url('/foto_profil/'.$s->foto_profil)}}" id='output_image' class="rounded-circle"></center>
                              <center><p>Foto Profil</p></center> 
                              <div class="form-group"> 
                                <input type="file" class="form-control" style="padding-right: 5px" accept="image/*" name="foto_profil" onchange="preview_image(event)"> 
                                @if($errors->has('foto_profil'))<div class="text-danger">{{$errors->first('foto_profil')}}</div>@endif
                                <p>*) Pastikan ukuran gambar tidak melebihi 2MB.</p>
                              </div>
                            </div>
                            <div class="box-footer">
                              <center><button type="submit" class="btn btn-primary">Proses</button></center>
                            </div>
                          </form>
                          @endforeach
                  <!-- /.box-body -->
                        
                      </div>
                  </div>
</section>
@endsection

<script type="text/javascript">
    function preview_image(event) {
      var reader = new FileReader();
      reader.onload = function() {
        var output = document.getElementById('output_image');
        output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>