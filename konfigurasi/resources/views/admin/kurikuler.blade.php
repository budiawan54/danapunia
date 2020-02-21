@extends('admin.master')
@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Ekstra Kurikuler
      </h1>
      <ol class="breadcrumb">
        <li><a href="/guru"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#"><i class="fa fa-user"></i> Ekstra Kurikuler</a></li>
      </ol>
    </section>
@endsection
@section('main-content')
<section class="content">
  @if (Session::has('alert-success'))
    <div class="container alert alert-success">
      <h4><center><i class="fa fa-lg fa-check"></i>{{Session::get('alert-success')}}</center></h4>
    </div>
  @endif
  @if($errors->has('kode_ekstra') || $errors->has('nama_ekstra') || $errors->has('thumbnail_photos'))
  <div class="container alert alert-error"><h4><center><i class="fa fa-lg fa-ban"></i> Mohon periksa kembali data yang diinput!</center></h4>
  </div>
  @endif
  @if(Session::has('alert-success'))
  <script type="text/javascript">window.alert('{{session::get('alert-success')}}'</script>
  @endif
          <div class="col-sm-5">
              <div class="box box-info">
                <div class="box-header">
                  <h2 class="box-title">Tambah Ekstra Kurikuler</h2>
                </div>
                <!-- form start --> 
                <form action="ekstra/store" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    {{csrf_field()}}
                    <div class="form-group">
                      <label for="inputEmail3" class="control-label">Kode Ekstra Kurikuler</label>     
                        <input type="text" class="form-control" placeholder="Kode Ekstra Kurikuler" name="kode_ekstra" value="{{old('kode_ekstra')}}">
                        @if ($errors->has('kode_ekstra'))<p class="text-danger">{{$errors->first('kode_ekstra')}}</p>@endif
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="control-label">Nama Ekstra Kurikuler</label>
                        <input type="text" class="form-control" placeholder="Nama Ekstra Kurikuler" name="nama_ekstra" value="{{old('nama_ekstra')}}">
                        @if($errors->has('nama_ekstra'))<p class="text-danger">{{$errors->first('nama_ekstra')}}</p>@endif
                    </div>
                    <div class="form-group">
                      <label for="foto" class="control-label">Foto Thumbnail</label>
                      <input type="file" class="form-control" name="thumbnail_photos" accept="image/*">
                      <p>)* Pastikan ukuran gambar tidak melebihi 2MB</p>
                      @if ($errors->has('thumbnail_photos'))<p class="text-danger">{{$errors->first('thumbnail_photos')}}</p>@endif
                    </div>
                  </div>
                  <!-- /.box-body -->
                    <div class="box-footer">
                      <center><button type="submit" class="btn btn-primary">Tambah</button></center>
                    </div>
                  <!-- /.box-footer -->
                </form>
              </div>
          </div>
          <div class="col-sm-7">
            <div class="box">
              <div class="box-header">
                <h2 class="box-title">Daftar Ekstra Kurikuler</h2>
              </div>
              <div class="box-body table-responsive">
                <table class="table table-bordered table-striped" id="table_ekstra">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Ekstra Kurikuler</th>
                      <th>Nama Ekstra Kurikuler</th>
                      <th>Foto Thumbnail</th>
                      <th>Tindakan</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
<div class="row">
</div>
</section>
  <!-- /.content-wrapper -->
@endsection
@include('template.modal')
                <!--MODAL EDIT-->
                  <div class="modal fade edit" id="edit">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Edit Ekstra Kurikuler</h4>
                        </div>
                        <div class="modal-body">
                          <form id="edit_data">
                            <div class="box-body" >
                            {{csrf_field()}}
                            
                            <input type="text" class="hidden" id="id" name="id">
                            <div class="col-sm-7">
                              <div class="form-group">
                              <label for="kode_mp">Kode Ekstra Kurikuler</label>
                              <input type="text" class="form-control" name="kode_mp" id="kode_mp">
                              </div>
                              <div class="form-group">
                              <label for="nama_ekstra">Nama Ekstra Kurikuler</label>
                              <input type="text" class="form-control" name="nama_mp" id="nama_mp">
                              </div>
                            </div>
                            <div class="col-sm-5">
                              <div class="form-group inline-form">
                              
                              <center><img src="" style="width: 70px ; height: 100px" id="output_image" class="img-thumbnail"><br/></center>
                              <input type="file" class="form-control" accept="image/*" name="foto_thumbnail" onchange="preview_image(event)"> 
                              </div>
                            </div>
                            </div>
                            <div class="box-footer">
                                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                  <button type="submit" class="btn btn-primary pull-right">Perbarui</button>
                            </div>
                          </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                <!--BATAS MODAL EDIT-->
