<!DOCTYPE html>
<html>
@include('template.header')
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div style="padding-left: 10px; padding-right: 5px">
        <div class="navbar-header">
          <img src="{{asset('img/baner.png')}}" alt="baner" style="width: 180px ;">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/siswa">Beranda</a></li>
            <li><a href="{{route('absensi_siswa')}}">Absensi</a></li>
            <li><a href="">Kalender Acara</a></li>
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
            <li class="dropdown messages-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                  @if(count($notif)>0)
                <span class="label label-warning">
                  {{
                    count($notif->where('category','re-tugas')->where('id_siswa',Session::get('id_siswa')))
                  }}
                </span>
                @endif
              </a>
              <ul class="dropdown-menu">
                @if(count($notif)>0 )
                <li class="header">Kamu Punya {{
                    count($notif->where('category','re-tugas')->where('id_siswa',Session::get('id_siswa')))
                  }} pemberitahuan</li>
                @else
                <li class="header">Tidak ada pemberitahuan </li>
                @endif
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu">
                    @foreach ($notif as $notif)
                    @if (($notif->category == 're-tugas') && ($notif->id_siswa == Session::get('id_siswa')))
                    <li>
                    <!-- start message -->
                      <a href="/siswa/tugas">
                        <div class="pull-left">
                          <i class="fa fa-lg fa-flag text-danger"></i>
                        </div>
                        <h4>Pemberitahuan
                          <small id="waktu" onloadeddata="baju()"><i class="fa fa-clock-o"></i>{{$notif->Updated_At}}</small>
                        </h4>
                        <p>{{$notif->pesan}} :{{$notif->judul_tugas}}</p>
                      </a>
                    </li>
                    <!-- end message -->
                    @endif
                    @endforeach
                  </ul>
                </li>
                <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
            </li>
            <!-- User Account Menu -->
            @foreach ($siswa as $siswa)
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="@if (($siswa->student_photos)==TRUE){{url('/foto_siswa/'.$siswa->student_photos)}} @else {{asset('dist/img/avatar5.png')}} @endif" class="img-circle" alt="User Image" id="foto_profil" style="height: 20px;width: auto;">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{$siswa->nama_siswa}}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                 <img src="@if (($siswa->student_photos)==TRUE){{url('/foto_siswa/'.$siswa->student_photos)}} @else {{asset('dist/img/avatar5.png')}} @endif" class="img-circle" alt="User Image" id="foto_profil">

                  <p>
                    {{$siswa->nama_siswa}}
                    <small>Kelas {{$siswa->kelas}}</small>
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
            @endforeach
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
  @yield('content')
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
@include('template.js')
<script type="text/javascript">
$(function(){
  var notif = moment($('small#waktu').text());
  notif.locale('id')
  console.log(notif.format("dddd, MMMM Do YYYY"));
  $('#calender-siswa').fullCalendar({
    locale : 'id',
    header    : {
        left  : 'prev,next, today',
        center: 'title'
      },
      events    : '{{route('loadabsensi')}}',
      eventRender: function(eventObj, $el) {
       $el.popover({
        title: eventObj.title,
        content: eventObj.description,
        trigger: 'hover',
        placement: 'top',
        container: 'body'
       });
      },
  })
  $('#cek-tugas').click(function(){
    $('.status-tugas').removeClass('hidden')
  })
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
  $('#jadwal_pelajaran').DataTable({
      processing : true,
      serverSide : true,
      ajax : '{{route('dtjp')}}',
      columns : [
        {data:'DT_RowIndex', name:'DT_RowIndex'},
        {data:'days_name',name:'days_name'},
        {data:'jampelajaran', name:'jampelajaran'},
        {data:'nama_pelajaran',name:'nama_pelajaran'},
        /*{data:'jammulai',name:'jammulai', render:function(data,type,row){
          if(type === "sort" || type === "type"){
            return data;
          }
          return moment(data).format("HH:mm");
         }
        },
        {data:'jamselesai',name:'jamselesai',render:function(data,type,row){
          if(type === "sort" || type === "type"){
            return data;
          }
          return moment(data).format("HH:mm");
         }},*/
        {data:'jammulai', name: 'jammulai'},
        {data:'jamselesai', name: 'jamselesai'},
      ]
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
