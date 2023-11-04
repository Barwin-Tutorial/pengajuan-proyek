
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h3 class="card-title"><i class="fa fa-list text-blue"></i> Dokumen</h3>
                        <div class="text-right">
                            <button type="button" class="btn btn-outline-success btn-sm" onclick="laporan()">Laporan</button>
                        </div>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tbl_pengajuan" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-purple">
                                    <th rowspan="2" style="text-align:center; vertical-align : middle; ">Judul</th>
                                    <th colspan="3" style="text-align:center; vertical-align : middle; ">User</th>
                                    <th rowspan="2" style="text-align:center; vertical-align : middle; ">File Dokumen</th>
                                    <th rowspan="2" style="text-align:center; vertical-align : middle; ">File Anggaran</th>
                                    <th rowspan="2" style="text-align:center; vertical-align : middle; ">Keterangan</th>
                                    <th rowspan="2" style="text-align:center; vertical-align : middle; ">Status</th>
                                    <th rowspan="2" style="text-align:center; vertical-align : middle; ">Aksi</th>
                                </tr>
                                <tr  class="bg-purple">
                                    <th style="text-align:center; vertical-align : middle; ">Upload</th>
                                    <th style="text-align:center; vertical-align : middle; ">Pengaju</th>
                                    <th style="text-align:center; vertical-align : middle; ">Pemberi Keputusan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>


<script type="text/javascript">
var save_method; //for save method string
var table;

$(document).ready(function() {

    //datatables
    table =$("#tbl_pengajuan").DataTable({
        "responsive": true,
        "autoWidth": false,
        "language": {
            "sEmptyTable": "Data Dokumen Belum Ada"
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('pengajuan/ajax_list')?>",
            "type": "POST"
        },

    });

 //set input/textarea/select event when change value, remove class error and remove text help block 
 $("input").change(function(){
    $(this).parent().parent().removeClass('has-error');
    $(this).next().empty();
    $(this).removeClass('is-invalid');
});
 $("textarea").change(function(){
    $(this).parent().parent().removeClass('has-error');
    $(this).next().empty();
    $(this).removeClass('is-invalid');
});
 $("select").change(function(){
    $(this).parent().parent().removeClass('has-error');
    $(this).next().next().empty();
    $(this).removeClass('is-invalid');
});

});

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});


//delete
function hapus(id){

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.value) {
        $.ajax({
            url:"<?php echo site_url('pengajuan/delete');?>",
            type:"POST",
            data:"id="+id,
            cache:false,
            dataType: 'json',
            success:function(respone){
                if (respone.status == true) {
                    reload_table();
                    Swal.fire({
                        title : 'Deleted!',
                        text :'Data Berhasil Dihapus.',
                        icon : 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }else{
                  Toast.fire({
                      icon: 'error',
                      title: 'Delete Error!!.'
                  });
              }
          }
      });
    }
})
}


function aksi(id){

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('dokumen/edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id_dokumen"]').val(data.id_dokumen);
            $('#modal-sm').modal('show'); // show bootstrap modal when complete loaded
            

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function setuju(act) {
    var id = $('[name="id_dokumen"]').val();
    $.ajax({
            url:"<?php echo site_url('pengajuan/aksi');?>",
            type:"POST",
            data:{id:id,aksi:act},
            cache:false,
            dataType: 'json',
            success:function(respone){
                if (respone.status == true) {
                    reload_table();
                    Swal.fire({
                        title : 'Success!',
                        icon : 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }else{
                  Toast.fire({
                      icon: 'error',
                      title: 'Error!!.'
                  });
              }
               $('#modal-sm').modal('hide');
          }
      });
}

function add()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal({backdrop: 'static', keyboard: false}); // show bootstrap modal
    $('.modal-title').text('Add Dokumen'); // Set Title to Bootstrap modal title
}

function edit(id){
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('dokumen/edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id_dokumen);
            $('[name="judul"]').val(data.judul);
            $('[name="keterangan"]').val(data.keterangan);
            var file = "<?php echo base_url('assets/dokumen/')?>"+data.upload;
            $("#dok").attr("href",file);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Dokumen'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    if(save_method == 'add') {
        url = "<?php echo site_url('pengajuan/insert')?>";
    } else {
        url = "<?php echo site_url('pengajuan/update')?>";
    }
    var formdata = new FormData($('#form')[0]);
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: formdata,
        dataType: "JSON",
        cache: false,
        contentType: false,
        processData: false,
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
                Toast.fire({
                    icon: 'success',
                    title: 'Success!!.'
                });
            }
            else
            {
                Swal.fire({
                    title : 'Error!',
                    text : data.pesan,
                    icon : 'error',
                    showConfirmButton : true,
                });
               /* for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]).addClass('invalid-feedback');
                }*/
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

</script>

<div class="modal fade" id="modal-sm">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Konfirmasi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body text-center">
      <input type="hidden" value="" name="id_dokumen"/> 
      <button type="button" class="btn btn-success" onclick="setuju('setuju')" >Setuju</button>
      <button type="button" class="btn btn-danger" onclick="setuju('tolak')">Tolak</button>
  </div>
  <div class="modal-footer ">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">

            <div class="modal-header">
                <h3 class="modal-title">Pengajuan Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" >
                    <input type="hidden" value="" name="id"/> 
                    <div class="card-body">

                        <div class="form-group row ">
                            <label for="nama" class="col-sm-3 col-form-label">Judul</label>
                            <div class="col-sm-9 kosong">
                                <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" disabled="">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="nama" class="col-sm-3 col-form-label">Dokumen</label>
                            <div class="col-sm-9 kosong">
                                <a id="dok" href="" class="btn btn-outline-info" target="_blank">Download</a>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="nama" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9 kosong">
                                <textarea type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" disabled=""></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="nama" class="col-sm-3 col-form-label">Upload Anggaran</label>
                            <div class="col-sm-9 kosong">
                                <input type="file" class="form-control" name="file" id="file" placeholder="File" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->


<!-- Bootstrap modal -->
<div class="modal fade" id="modal_lap" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content ">

            <div class="modal-header">
                <h3 class="modal-title">Tahun Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body form">
                <form action="#" id="form_lap" class="form-horizontal" >

                    <div class="card-body">

                        <div class="form-group row ">
                            <label for="nama" class="col-sm-3 col-form-label">Periode</label>
                            <div class="col-sm-9 kosong">
                                <input type="text" class="form-control" name="tgl" id="periode" >
                            </div>
                        </div>
                        <div id="tampil1"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="proses" onclick="proses()" class="btn btn-primary">Proses</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<script type="text/javascript">
    function laporan() {
    $('#modal_lap').modal({backdrop: 'static', keyboard: false}); // show bootstrap modal
    $('.modal-title').text('Laporan'); // Set Title to Bootstrap modal title
}
$('#periode').daterangepicker();
function proses() {
     var data = $("#form_lap").serialize();
        window.open('dokumen/download_pdf?'+data);
}
</script>