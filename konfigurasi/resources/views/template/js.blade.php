<!-- jQuery 3 -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!--DataTables-->
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<!-- bootstrap datepicker -->
<script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- CK Editor -->
<script src="{{asset('bower_components/ckeditor/ckeditor.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/summernote/js/summernote.js')}}"></script>
<!-- fullCalendar -->
<script src="{{asset('bower_components/moment/moment.js')}}"></script>
<script src="{{asset('bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
<script type="text/javascript">

  //DATATABLES 
  $(function () {
    $('#table_pegawai').DataTable({
      processing : true,
      serverSide : true,
      ajax : '{{route('dtpegawai')}}',
      columns:[
        {data:'DT_RowIndex',name:'DT_RowIndex'},
        {data:'nama_pegawai',name:'nama_pegawai'},
        {data:'tanggal_lahir',name:'tanggal_lahir'},
        {data:'nik',name:'nik'},
        {data:'nama_agama',name:'nama_agama'},
        {data:'alamat_pegawai',name:'alamat_pegawai'},
        {data:'status',name:'status'},
        {data: 'foto_pegawai',name: 'foto_pegawai',
            render: function(data, type, full, meta){
              return "<img src='{{ url('/foto_pegawai/')}}/"+data+"' width='70' class='img-thumbnail' />";
            },
            orderable: false
        },
        {data:'action', name:'action', orderable:false },
      ]
    });

    $('#table_prestasi').DataTable({
      processing : true,
      serverSide : true,
      ajax : '{{route('dtprestasi')}}',
      columns:[
        {data:'DT_RowIndex',name:'DT_RowIndex'},
        {data:'nama_prestasi',name:'nama_prestasi'},
        {data:'tanggal_peroleh',name:'tanggal_peroleh'},
        {data:'deskripsi_prestasi',name:'deskripsi_prestasi'},
        {data: 'foto_prestasi',name: 'foto_prestasi',
            render: function(data, type, full, meta){
              return "<img src='{{ url('/foto_prestasi/')}}/"+data+"' width='70' class='img-thumbnail' />";
            },
            orderable: false
        },
        {data:'action', name:'action', orderable:false },
      ]
    });


    });      

  $(function () {
    $('#example1').DataTable({
      processing : true,
      serverSide : true,
      ajax : '/guru/getpelajaran',
      columns:[
        {data:'DT_RowIndex',name:'DT_RowIndex'},
        {data:'kode_pelajaran',name:'kode_pelajaran'},
        {data:'nama_pelajaran',name:'nama_pelajaran'},
        {data:'action', name:'action', orderable:false },
      ]
    });

    $('#table_siswa').DataTable({
      processing : true,
      serverSide : true,
      ajax :'{{route('dtsiswa')}}',
      columns: [
        {data : 'DT_RowIndex', name: 'DT_RowIndex'},
        {data : 'nama_siswa', name: 'nama_siswa'},
        {data : 'birth', name: 'birth'},
        {data : 'nama_kelamin', name : 'nama_kelamin'},
        {data : 'nama_agama', name : 'nama_agama'},
        {data : 'address', name : 'address'},
        {data: 'student_photos', name : 'student_photos',
            render: function(data, type, full, meta){
              return "<img src='{{ url('/foto_siswa/')}}/"+data+"' width='70' class='img-thumbnail' />";
            },
            orderable: false
        },
        {data : 'action'},
      ]
    })     
  });


  $(function () {
    $('#table_kegiatan').DataTable({
      processing : true,
      serverSide : true,
      ajax : '{{route('dtkegiatan')}}',
      columns:[
        {data:'DT_RowIndex',name:'DT_RowIndex'},
        {data:'judul_kegiatan',name:'judul_kegiatan'},
        {data:'tanggal_kegiatan',name:'tanggal_kegiatan'},
        {data: 'foto_kegiatan',name: 'foto_kegiatan',
            render: function(data, type, full, meta){
              return "<img src='{{ url('/foto_kegiatan/')}}/"+data+"' width='70' class='img-thumbnail' />";
            },
            orderable: false
        },
        {data:'action', name:'action', orderable:false },
      ]
    });      
  });

  $(function () {
    $('#table_ekstra').DataTable({
      processing : true,
      serverSide : true,
      ajax : '{{route('dtekskul')}}',
      columns:[
        {data:'DT_RowIndex',name:'DT_RowIndex'},
        {data:'kode_ekskul',name:'kode_ekskul'},
        {data:'nama_ekskul',name:'nama_ekskul'},
        {data: 'foto',name: 'foto',
            render: function(data, type, full, meta){
              return "<img src='{{ url('/galeri foto/')}}/"+data+"' width='70' class='img-thumbnail' />";
            },
            orderable: false
        },
        {data:'action', name:'action', orderable:false },
      ]
    });      
  });

  
  //PROFIL
  var type = {{$u->type}};
  $('#foto_profil').click(function(){
    if(type==1){
      window.open('{{route('profil')}}','_self')
    } else if ( type==2){
      window.open('{{route('profil-guru')}}','_self')
    }
  })



  //ON LOAD BODY
  $(function(){
    var url = window.location.pathname;
    switch(url){
      case '/admin/status':
      $('#li_stts').attr('class','active');
      $('title').text('Status');
      $('#li_siswa, #li_nilai_siswa, #li_pelajaran, #li_schedule').remove();
      break;
      case '/admin/profil':
      $('#li_prf').attr('class','active');
      $('#li_siswa, #li_nilai_siswa, #li_pelajaran, #li_schedule').remove();
      $('title').text('Profil');
      break;
      case '/admin/pegawai':
      $('#li_emplo').attr('class','active');
      $('title').text('Data Pegawai');
      $('#li_siswa, #li_nilai_siswa, #li_pelajaran, #li_schedule').remove();
      break;
      case '/admin/pengguna':
      $('#li_user').attr('class','active');
      $('title').text('Data Pengguna');
      $('#li_siswa, #li_nilai_siswa, #li_pelajaran, #li_schedule').remove();
      break;
      case '/admin/extra':
      $('#li_xtr').attr('class','active');
      $('title').text('Data Ekstra Kurikuler');
      $('#li_siswa, #li_nilai_siswa, #li_pelajaran, #li_schedule').remove();
      break;
      case '/admin/kegiatan':
      $('#li_kgt').attr('class','active');
      $('title').text('Data Kegiatan');
      $('#li_siswa, #li_nilai_siswa, #li_pelajaran, #li_schedule').remove();
      break;
      case '/admin/prestasi':
      $('#li_prt').attr('class','active');
      $('#li_siswa, #li_nilai_siswa, #li_pelajaran, #li_schedule').remove();
      $('title').text('Prestasi Siswa');
      break;
      
      case '/admin':
      $('#li_dsb').attr('class','active');
      $('title').text('Admin | Dashboard');
      $('#li_siswa, #li_nilai_siswa, #li_pelajaran, #li_schedule').remove();
      break;
      case '/guru':
      $('#li_dsb').attr('class','active');
      $('#ln-dsb').attr('href','javascript:void(0)');
      $('#foto_profil').attr('href','{{route('profil-guru')}}');      
      $('title').text('Guru | Dashboard');
      $('#li_stts, #li_prf, #li_emplo, #li_user, #li_xtr, #li_kgt, #li_prt').remove();
      $('#li_schedule').attr('href','{{route('schedule')}}');
      break;

      case '/userbaru':
      $('#li_dsb').attr('class','active');
      $('#li_dsb').find('a').attr('href','javascript:void(0)');
      $('#foto_profil').attr('href','javascript:void(0)');      
      $('title').text('Dashboard');
      $('#li_stts, #li_prf, #li_emplo, #li_user, #li_xtr, #li_kgt, #li_prt, #li_siswa, #li_nilai_siswa, #li_pelajaran, #li_cal').remove();
      break;

      case '/guru/pelajaran':
      $('#li_pelajaran').attr('class','active');
      $('#ln-dsb').attr('href','{{route('dashboard-guru')}}');
      $('#foto_profil').attr('href','{{route('profil-guru')}}');      
      $('title').text('Data Mata Pelajaran');
      $('#li_stts, #li_prf, #li_emplo, #li_user, #li_xtr, #li_kgt, #li_prt').remove();
      
      break;
      case '/guru/siswa':
      $('#li_siswa').attr('class','active');
      $('#ln-dsb').attr('href','{{route('dashboard-guru')}}');
      $('#foto_profil').attr('href','{{route('profil-guru')}}');      
      $('title').text('Tambah Siswa');
      $('#li_stts, #li_prf, #li_emplo, #li_user, #li_xtr, #li_kgt, #li_prt').remove();
      break;
      case '/guru/nilai':
      $('#li_nilai_siswa').attr('class','active');
      $('#ln-dsb').attr('href','{{route('dashboard-guru')}}');
      $('#foto_profil').attr('href','{{route('profil-guru')}}');      
      $('title').text('Silakan Masukkan Siswa Terlebih Dahulu');
      $('#li_stts, #li_prf, #li_emplo, #li_user, #li_xtr, #li_kgt, #li_prt').remove();
      break;
      case '/guru/schedule':
      $('#li_cal').attr('class','active');
      $('#ln-dsb').attr('href','{{route('dashboard-guru')}}');
      $('#foto_profil').attr('href','{{route('profil-guru')}}');      
      $('title').text('Silakan Masukkan Siswa Terlebih Dahulu');
      $('#li_stts, #li_prf, #li_emplo, #li_user, #li_xtr, #li_kgt, #li_prt').remove();
      break;
      case '/guru/profil':
      $('#ln-dsb').attr('href','{{route('dashboard-guru')}}');
      $('#foto_profil').attr('href','{{route('profil-guru')}}');      
      $('title').text('Profil');
      $('#li_stts, #li_prf, #li_emplo, #li_user, #li_xtr, #li_kgt, #li_prt').remove();
      break;
    }
    var judul = $('title').text();
    if (judul == 'Nilai SiswaAdmin'){
      $('#li_nilai_siswa').attr('class','active');
      $('#ln-dsb').attr('href','{{route('dashboard-guru')}}');
      $('#foto_profil').attr('href','{{route('profil-guru')}}');      
      $('#li_stts, #li_prf, #li_emplo, #li_user, #li_xtr, #li_kgt, #li_prt').remove();
    }
  });
  //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    })
    $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })

// SUMMER NOTE  
  $(function(){
            $('.summernote').summernote({
                height: 150,
                toolbar: [
                    ['style', ['style']],
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']]
                ]
            });
        })

$(function(){
  $('#deskripsi_prestasi').summernote();
})

// EDIT AJAX
var url = window.location.pathname;
console.log(url)
$(document).on('click','.btn-edit', function(){
  $('#edit').modal('show');
  var id = $(this).attr('id');
  switch(url){
  case '/admin/kegiatan':
  $.ajax({
          url:'{{route('json')}}',
          method:'get',
          data:{id:id},
          dataType:'json',
          success:function(data){
            $('#nama_kegiatan').val(data[0].judul_kegiatan),
            $('#tanggal_kegiatan').val(data[0].tanggal_kegiatan),
            $('#deskripsi_kegiatan').attr('placeholder',data[0].deskripsi_kegiatan),
            $('#id').val(data[0].id)
            }      
  })
  break;
  case '/admin/pegawai':
  $.ajax({
          url:'{{route('json')}}',
          method:'get',
          data:{id:id},
          dataType:'json',
          success:function(data){
            $('#nama_pegawai').val(data[3].nama_pegawai),
            $('#nik').val(data[3].nik),
            $('#datepicker').val(data[3].tanggal_lahir),
            $('#agama').val(data[3].agama),
            $('#alamat').text(data[3].nik),
            $('#jabatan').text(data[3].status),
            $('#output_image').attr('src','{{url('/foto_pegawai/')}}/'+data[3].foto_pegawai),
            $('#id').val(data[3].id)
            console.log(data[3])
            }      
  })
  break;
  case '/admin/extra':
  $.ajax({
          url:'{{route('json')}}',
          method:'get',
          data:{id:id},
          dataType:'json',
          success:function(data){
            $('#nama_mp').val(data[1].nama_ekskul),
            $('#kode_mp').val(data[1].kode_ekskul),
            $('#output_image').attr('src','{{url('/galeri foto/')}}/'+data[1].foto),
            $('#id').val(data[1].id)
            }      
  })
  break;
  case '/admin/prestasi':
  $.ajax({
          url:'{{route('json')}}',
          method:'get',
          data:{id:id},
          dataType:'json',
          success:function(data){
            $('#nama_prestasi').val(data[2].nama_prestasi),
            $('#datepicker').val(data[2].tanggal_peroleh),
            $('#output_image').attr('src','{{url('/foto_prestasi/')}}/'+data[2].foto_prestasi),
            $('#deskripsi_prestasi').text(data[2].deskripsi_prestasi),
            $('#id').val(data[2].id)
            console.log(data[2].deskripsi_prestasi)
            }      
  })
  break;
  case '/guru/pelajaran':
  $.ajax({
          url:'/guru/test',
          method:'get',
          data:{id:id},
          dataType:'json',
          success:function(data){
            $('#kode_mp').val(data.kode_pelajaran)
            $('#nama_mp').val(data.nama_pelajaran)
            $('#id').val(data.id)
            console.log(data)
            }      
  })
  break;
  case '/guru/siswa':
  $.ajax({
    url : '{{route('json')}}',
    method : 'get',
    data:{id:id},
    dataType :'json',
    success:function(data){
      $('#id').val(data[4].id)
      $('form#get-nilai').attr('action','/guru/'+data[4].id+'/nilai')
      $('#nama_siswa').val(data[4].nama_siswa)
      $('#lahir').val(data[4].birth)
      $('input[name=kelamin][value='+data[4].sex+']').prop('checked', 'checked');
      $('#agama option[value='+data[4].faith+']').attr('selected','selected');
      $('#alamat').val(data[4].address)
      $('#output_image').attr('src','{{url('/foto_siswa/')}}/'+data[4].student_photos)
      console.log(data[4])

    }
  })
  break;
  }

})

$('#edit_data').submit(function(e){
    e.preventDefault();
    var id = $('#id').val();
    var url = window.location.pathname;
    switch (url){
    case '/admin/kegiatan':
    $.ajax({
      url:'/admin/kegiatan/ubah_kegiatan/'+id,
      data:new FormData(this),
      contentType : false,
      processData : false,
      method: 'POST',
      beforeSend:function(xhr){
        $('p.text-danger').remove();
      },
      success: function(){
        alert('Data Kegiatan berhasil diperbarui')
        $('.modal').modal('hide');
        $('#alert-success').removeClass('hidden');
        $('#table_kegiatan').DataTable().ajax.reload();
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
    break;
    case '/admin/pegawai':
    $.ajax({
      url:'pegawai/updatepegawai/'+id,
      data:new FormData(this),
      contentType : false,
      processData : false,
      method: 'POST',
      beforeSend:function(xhr){
        $('p.text-danger').remove();
      },
      success: function(){
        alert('Data Kegiatan berhasil diperbarui')
        $('.modal').modal('hide');
        $('#alert-success').removeClass('hidden');
        $('#table_pegawai').DataTable().ajax.reload();
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
    break;
    case '/admin/prestasi':
    $.ajax({
      url:'prestasi/proses/'+id,
      data:new FormData(this),
      contentType : false,
      processData : false,
      method: 'POST',
      beforeSend:function(xhr){
        $('p.text-danger').remove();
      },
      success: function(){
        alert('Data Prestasi berhasil diperbarui')
        $('.modal').modal('hide');
        $('#alert-success').removeClass('hidden');
        $('#table_prestasi').DataTable().ajax.reload();
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
    break;
    case '/admin/extra':
    $.ajax({
      url:'extra/update/'+id,
      data:new FormData(this),
      contentType : false,
      processData : false,
      method: 'POST',
      beforeSend:function(xhr){
        $('p.text-danger').remove();
      },
      success: function(){
        alert('Data Ekskul berhasil diperbarui')
        $('.modal').modal('hide');
        $('#alert-success').removeClass('hidden');
        $('#table_ekstra').DataTable().ajax.reload();
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
    break;
    case '/guru/siswa':
    $.ajax({
      url:'{{route('stdupdate')}}',
      data:new FormData(this),
      contentType : false,
      processData : false,
      method: 'POST',
      beforeSend:function(xhr){
        $('p.text-danger').remove();
      },
      success: function(){
        alert('Data siswa berhasil diperbarui')
        $('.modal').modal('hide');
        $('#alert-success').removeClass('hidden');
        $('#table_siswa').DataTable().ajax.reload();
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
    break;
    case '/guru/pelajaran':
    $.ajax({
      url:'/guru/pelajaran/update/'+id,
      data:$(this).serialize(),
      method: "POST",
      beforeSend:function(xhr){
        $('p.text-danger').remove();
      },
      success: function(){
        alert('Data berhasil diperbarui');
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
    break;
  }
  });


// AJAX DELETE 

$(document).on('click','.btn-del',function(){
  $('#hapus').modal('show')
  var id =$(this).attr('id');
  var url = window.location.pathname;
  console.log(url);
  switch(url){
    case '/admin/kegiatan':
    $.ajax({
      url:'{{route('json')}}',
      method: 'get',
      data:{id:id},
      dataType:'json',
      success:function(data){
        console.log(data[0])
        $('b').text(data[0].judul_kegiatan)
        $('#btn-hapus').attr('href','kegiatan/'+data[0].id+'/delete')
        $('#modal-body').find('span').text('kegiatan')
      }
    })
  break;
  case '/admin/pegawai':
  $.ajax({
      url:'{{route('json')}}',
      method: 'get',
      data:{id:id},
      dataType:'json',
      success:function(data){
        $('b').text(data[3].nama_pegawai)
        $('#btn-hapus').attr('href','pegawai/'+data[3].id+'/hapus')
        $('#modal-body').find('span').text('pegawai')
      }
    })
  break;
  case '/admin/prestasi':
  $.ajax({
      url:'{{route('json')}}',
      method: 'get',
      data:{id:id},
      dataType:'json',
      success:function(data){
        console.log(data[2])
        $('b').text(data[2].nama_prestasi)
        $('#btn-hapus').attr('href','prestasi/hapus/'+data[2].id)
        $('#modal-body').find('span').text('kegiatan')
      }
    })
  break;
  case '/guru/pelajaran':
    $.ajax({
      url:'/guru/test',
      method: 'get',
      data:{id:id},
      dataType:'json',
      success:function(data){
        $('b').text(data.nama_pelajaran)
        $('#btn-hapus').attr('href','pelajaran/'+data.id+'/delete')
        $('#modal-body').find('span').text('data kuku pelajaran')
      }
    })
  break;
  case '/admin/extra':
    $.ajax({
      url:'{{route('json')}}',
      method: 'get',
      data:{id:id},
      dataType:'json',
      success:function(data){
        console.log(data[1])
        $('b').text(data[1].nama_ekskul)
        $('#btn-hapus').attr('href','extra/delete/'+data[1].id)
        $('#modal-body').find('span').text('data ekstra')
      }
    })
  break;
  case '/guru/siswa':
  $.ajax({
      url:'{{route('json')}}',
      method: 'get',
      data:{id:id},
      dataType:'json',
      success:function(data){
        $('b').text(data[4].nama_siswa)
        $('#btn-hapus').attr('href','siswa/delete/'+data[4].id)
        $('.modal-title').html('<center>Hapus data siswa</center>')
        $('.modal-body').find('span').text('data siswa')
      }
    })
  break;
  }
})

// CARI SISWA

$(document).ready(function(){
 $('.cari').keyup(function(){ 
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"/guru/siswa/cari",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
           $('#countryList').fadeIn();  
                    $('#countryList').html(data);
          }
         });
        } else {
          $('.list').remove();
        }
    }); 
});


//OUTPUT IMAGE
function preview_image(event) {
      var reader = new FileReader();
      reader.onload = function() {
        var output = document.getElementById('output_image');
        output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);

        $('#output_image').removeClass('hidden')
        }

</script>