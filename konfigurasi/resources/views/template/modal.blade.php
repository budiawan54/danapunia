
                <!--MODAL HAPUS-->
                  <div class="modal fade" id="hapus">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="modal-title">Hapus Mata Pelajaran</h4>
                        </div>
                        <div class="modal-body" id="modal-body">
                          <h5>Apakah anda yakin ingin menghapus <span>data</span> <b></b> ???</h5> 
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                          <a id="confirm" class="btn btn-primary" href="">Ya, saya yakin</a>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                <!--BATAS MODAL HAPUS-->

                <!--MODAL Update-->
                  <div class="modal fade" id="edit-event">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-body">
                          <form id="event-update">
                                {{csrf_field()}}
                              <input type="text" id="id" class="hidden" name="id">
                              <div class="box box-solid">
                                <div class="box-header with-border">
                                  <center><h2 class="box-title"><i class='fa fa-edit'></i> Ubah Daftar Acara</h2></center>
                                </div>
                                <div class="box-body">
                                  <!-- /btn-group -->
                                  <div class="form-group">
                                    <label>Judul Acara :</label>
                                    <input id="nama_acara" type="text" name="nama_acara" class="form-control" placeholder="Judul Acara">
                                    
                                  </div>
                                  <label>Waktu Mulai Acara :</label>
                                  <div class='input-group date' id='datetimepicker1'>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='text' class="form-control " name='start_event' id="start_event" />
                                  </div>
                                  <label>Waktu Selesai :</label>
                                  <div class='input-group date' id='datetimepicker1'>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='text' class="form-control" name='end_event' id="end_event" />
                                  </div>
                                  <div class="form-group">
                                                        <label>Warna Background :</label>

                                                        <div class="input-group my-colorpicker2">
                                                            <input type="text" class="form-control" id="warna" name="backcolor" value="#1ba5e3" >

                                                            <div class="input-group-addon">
                                                                <i></i>
                                                            </div>
                                                        </div>
                                                        <!-- /.input group -->
                                                    </div>
                                  <div class="form-group">
                                    <input type="checkbox"> Sepanjang Hari
                                  </div>
                                    <!-- /btn-group -->
                                  <!-- /input-group -->
                                </div>
                              </div>
                              <div class="modal-footer">
                                <a class="btn btn-danger btn-hapus-event pull-left"><i class="fa fa-trash"></i> Hapus Events</a>
                                <button type="submit"  class="btn btn-primary "><i class="fa fa-edit"></i> Perbarui</button>
                              </div>
                            </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                <!--BATAS MODAL HAPUS-->

                <!--MODAL AkSI-->
                  <div class="modal fade" id="aksi">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-body">
                          <h5>Apa yang ingin anda lakukan ???</h5>
                          <input type="hidden" id="id" class="id" name="id">
                        </div>
                        <div class="modal-footer">
                          <a  type="button" class="btn btn-info pull-left edit-event" id="btn-edit" ><i class="fa fa-edit"></i> Edit Events</a>
                          
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                <!--BATAS MODAL HAPUS-->

                <!--MODAL Tambah-->
                  <div class="modal fade" id="add-event">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-body">
                          <form id="event">
                {{csrf_field()}}
                <div class="box-header with-border">
                  <center><h3 class="box-title">Buat Daftar Acara</h3></center>
                </div>
                <div class="box-body">
                  <!-- /btn-group -->
                  <div class="form-group">
                    <label>Judul Acara :</label>
                    <input id="new-event" type="text" name="nama_acara" class="form-control nama_acara" placeholder="Judul Acara">
                  </div>
                  <label>Waktu Mulai Acara :</label>
                  <div class='input-group date' id='datetimepicker1'>
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    <input type='text' class="form-control start_event" name='start_event' />
                  </div>
                  <label>Waktu Selesai :</label>
                  <div class='input-group date' id='datetimepicker1'>
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span></span>
                    <input type='text' class="form-control end_event" name='end_event' />
                  </div>
                  <div class="form-group">
                    <label>Warna Background :</label>
                    <div class="input-group my-colorpicker2">
                        <input type="text" class="form-control" id="backcolor" name="backcolor" value="#1ba5e3">
                        <div class="input-group-addon"><i></i></div>
                    </div>
                    <!-- /.input group -->
                  </div>
                  <div class="form-group">
                    <input type="checkbox"   name="allday" id="allday"> Sepanjang Hari
                  </div>
                  <!-- /input-group -->
                </div>
                <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                          <button type="submit" id="btn-hapus" class="btn btn-primary">Tambah</button>
                        </div>
              </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                <!--BATAS MODAL HAPUS-->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<script>
  $(function(){
    $('#event-update').submit(function(e){
      e.preventDefault();
      var id = $('#id').val();
      $.ajax({
        url : '{{route('updateevents')}}',
        data : $(this).serialize(),
        method : 'POST',
        beforeSend:function(){
          $('p.text-danger').remove();
        },
        success:function(){
          $('#nama_acara').val('');
          $('#start_event').val('');
          $('#end_event').val('');
          $('#calendar').fullCalendar('refetchEvents');
          $('#edit-event').modal('hide');
          alert('data berhasil diperbarui');
          
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
  })

</script>

