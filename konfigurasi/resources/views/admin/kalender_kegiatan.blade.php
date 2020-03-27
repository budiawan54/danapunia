@extends('admin.master')
@section('content-header')
<section class="content-header">
      <h1>
        Kalender Acara
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-calendar"></i> Events</li>
      </ol>
    </section>
@endsection
@section('main-content')
<section class="content">
  @if(Session::has('alert-success'))<div class="container">
          <div class="box box-default">
            <div class="box-header with-border alert-success alert">
                <center><i class="fa fa-bullhorn"></i>
              <h3 class="box-title ">{{Session::get('alert-success')}}</h3></center>
            </div>
            <!-- /.box-header -->
          </div>
        </div>@endif
      <div class="row" id="row_add_event">
        <center><a class="btn btn-app"><i class="fa fa-plus"></i> Tambah Event</a></center>
      </div>
      <!-- akhir baris -->
      <!-- /.row -->
        <!-- /.second row -->
      <div class="row">
          <div class="col-xs-12">
            <div class="box box-primary">
              <div class="box-body no-padding">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /. box -->
          </div>
      </div>
        <!-- /.row -->
      

    </section>

@include('template.modal')
<!-- jQuery 3 -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>

<script>
  // CALENDER FUNCTION
 $(function () {
                $('#datetimepicker1 ').datetimepicker({
                  format : 'DD-MM-Y H:m'
                })
                $('.my-colorpicker2').colorpicker()
            });
  $(function () {

    var session = '{{Session::get('type')}}';
      if(session == 1){
      $('#li_cal').attr('class','active');
      $('title').text('Kalender Kegiatan');
      $('#li_siswa, #li_nilai_siswa').remove();
      

    /* initialize the calendar
     -----------------------------------------------------------------*/

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
      //Random default events
      
      events    : '{{route('loadevent')}}',
      selectable : function(element){
        $('#edit').modal('show');
      },
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      eventDrop:function(event){

     var start_event = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm");

     var end_event = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm");
     var nama_acara = event.title;
     var id = event.id;
     var backcolor = event.borderColor;

     $.ajax({
      url : '{{route('updateevents')}}',
      data : {id:id, nama_acara:nama_acara, start_event:start_event, end_event:end_event, backcolor:backcolor },
      type : 'POST',
      headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
      success:function(){
        $('#calendar').fullCalendar('refetchEvents');
        alert('event berhasil diperbarui')
      },
      error:function(error){
        console.log(error)
      }
     })
    },
      eventClick: function(event){
        $('#edit-event').modal('show');
        $('#id').val(event.id)
        $('#nama_acara').val(event.title)
        $('#start_event').val($.fullCalendar.formatDate(event.start, "DD-MM-Y HH:m"))
        $('#end_event').val($.fullCalendar.formatDate(event.end, "DD-MM-Y HH:m"))
        $('#warna').val(event.borderColor)
      },
      select : function(start, end){
        var start = $.fullCalendar.formatDate(start, "DD-MM-Y HH:m");
        var end = $.fullCalendar.formatDate(end, "DD-MM-Y HH:m");
        $('#add-event').modal('show')
        $('.start_event').val(start)
        $('.end_event').val(end)


      }
    })
    $('#event').submit(function (e) {
      e.preventDefault()
      $.ajax({
        url : '{{route('storeevent')}}',
        data : $(this).serialize(),
        method : 'POST',
        beforeSend:function(){
          $('p.text-danger').remove();
        },
        success:function(){
          $('.nama_acara').val('');
          $('.end_event').val('');
          $('.start_event').val('');
          $('#calendar').fullCalendar('refetchEvents');
          alert('data berhasil disimpan');
          $('#add-event').modal('hide');
        },
        error: function(xhr){
        let response = xhr.responseJSON
        let errors = response.errors
        if($.isEmptyObject(errors)==false){
           $.each(errors,function(key,value){
             var p = $('<p class="text-danger"></p>').text(value);
             $('.'+key).after(p);
             
           })
        }
      },
      })
    })

    $('.btn-app').click(function(){
      $('#add-event').modal('show')
    })

    $('.btn-hapus-event').click(function(event){
    var id = $('#id').val()
    $.ajax({
       url:"{{route('delevents')}}",

       type:"POST",

       data:{id:id},
       headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}, 

       success:function(){

        $('#calendar').fullCalendar('refetchEvents');
        $('#edit-event').modal('hide')
        alert("Events berhasil dihapus");
       },
      })
    })
    } else {
       $('#li_cal').attr('class','active');
      $('#ln-dsb').attr('href','{{route('dashboard-guru')}}');
      $('#foto_profil').attr('href','{{route('profil-guru')}}');      
      $('title').text('Guru | Dashboard');
      $('#li_stts, #li_prf, #li_emplo, #li_user, #li_xtr, #li_kgt, #li_prt').remove();
      $('#li_schedule').attr('href','{{route('schedule')}}');
      $('title').text('Kalender Kegiatan');
      $('#row_add_event').addClass('hidden');

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
      //Random default events
      
      events    : '{{route('loadevent')}}'
    })
      } 
    
  })

  // END CALENDER FUNCTION
      
</script>
@endsection
