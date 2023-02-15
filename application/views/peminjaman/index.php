
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light">

                        <button type="button" class="btn btn-sm btn-outline-primary  add" onclick="add()" title="Tambah Data" ><i class="fas fa-plus" ></i> Tambah</button>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tbl_peminjaman" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr class="bg-purple">
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Nama Alat</th>
                                    <th>Stok Out</th>
                                    <th>Satuan</th>
                                    <th>Kondisi</th>
                                    <th>Tanggal Out</th>
                                    <th>Penanggung Jawab</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
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
    table =$("#tbl_peminjaman").DataTable({
        "responsive": true,
        "autoWidth": false,
        "language": {
            "sEmptyTable": "Data Peminjaman Belum Ada"
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('peminjaman/ajax_list')?>",
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
    $(this).next().empty();
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
            url:"<?php echo site_url('peminjaman/delete');?>",
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



function add()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal({backdrop: 'static', keyboard: false}); // show bootstrap modal
    $('.modal-title').text('Peminjaman'); // Set Title to Bootstrap modal title
}

function edit(id){
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('peminjaman/edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id_peminjaman);
            $('[name="nama"]').val(data.nama);
            $('[name="id_alat"]').val(data.id_alat);
            $('[name="id_jabatan"]').val(data.id_jabatan);
            $('[name="id_guru"]').val(data.id_guru);
            $('[name="id_kondisi"]').val(data.id_kondisi);
            $('[name="penanggung_jawab"]').val(data.penanggung_jawab);
            $('[name="id_satuan"]').val(data.id_satuan);
            $('[name="stok_out"]').val(data.stok_out);
            $('[name="tgl_out"]').val(data.tgl_out);
            $('[name="keterangan"]').val(data.keterangan);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Peminjaman'); // Set title to Bootstrap modal title
            setTimeout(function() { $('input[name="scanbar"]').focus() }, 2000);
            $.ajax({
            url : 'peminjaman/get_alat_by_id/',
            data : {id_alat:data.id_alat},
            dataType : 'json',
            type : 'POST',
            success : function (data) {
                $("#nama_alat").val(data.nama_alat); 
                $("#id_alat").val(data.id_alat);
                return false;
            }

        })
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
        url = "<?php echo site_url('peminjaman/insert')?>";
    } else {
        url = "<?php echo site_url('peminjaman/update')?>";
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

                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]).addClass('invalid-feedback');
                }
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
var loadFile = function(event) {
  var image = document.getElementById('v_image');
  image.src = URL.createObjectURL(event.target.files[0]);
};


$(document).ready(function(){

   $( "#nama_alat").autocomplete({
    source: 'peminjaman/get_alat/?', 
    select : function (event, ui) {

         // display the selected text
         var value = ui.item.value;
        $("#id_alat").val(value); // save selected id to hidden input
        $("#nama_alat").val(ui.item.label);
        return false;
    },
    change : function (event, ui) {
         // display the selected text
         var value = ui.item.value;
        $("#id_alat").val(value); // save selected id to hidden input
        $("#nama_alat").val(ui.item.label);
        return false;
    }
})

setTimeout(function() { $('input[name="scanbar"]').focus() }, 2000);

   $( "#scanbar").change(function () {
        var barcode = $(this).val();
        $.ajax({
            url : 'peminjaman/get_alat_bar/',
            data : {barcode:barcode},
            dataType : 'json',
            type : 'POST',
            success : function (data) {
                $("#nama_alat").val(data.nama_alat); 
                $("#id_alat").val(data.id_alat);
                // $('#scanbar').val('');
                return false;
            }

        })
   })



});
</script>



<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">

            <div class="modal-header">
                <h3 class="modal-title">peminjaman Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" >
                    <input type="hidden" value="" name="id"/> 
                    <div class="card-body">
                         <div class="form-group row ">
                            <label for="id_alat" class="col-sm-3 col-form-label">Barcode</label>
                            <div class="col-sm-9 kosong">
                                <input type="text" class="form-control" name="scanbar" id="scanbar" autofocus autocomplete="off" placeholder="Scan Barcode" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="id_alat" class="col-sm-3 col-form-label">Nama Alat</label>
                            <div class="col-sm-9 kosong">
                                <input type="text" class="form-control" name="nama_alat" id="nama_alat" autofocus autocomplete="off" placeholder="Ketik Nama Alat" >
                                <input type="hidden" class="form-control" name="id_alat" id="id_alat">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9 kosong">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="id_jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                            <div class="col-sm-9 kosong">
                                <select class="form-control" name="id_jabatan" id="id_jabatan">
                                    <option value="" selected="" disabled="">Pilih Jabatan</option>
                                    <?php foreach ($jabatan->result() as $j): ?>
                                        <option value="<?=$j->id_jabatan?>"><?php echo $j->nama_jabatan; ?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="nama" class="col-sm-3 col-form-label">Stok Out</label>
                            <div class="col-sm-9 kosong">
                                <input type="number" class="form-control" name="stok_out" id="stok_out" placeholder="Stok Out" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="nama" class="col-sm-3 col-form-label">Satuan</label>
                            <div class="col-sm-9 kosong">
                                <select class="form-control" name="id_satuan" id="id_satuan">
                                    <option value="" selected="" disabled="">Pilih Satuan</option>
                                    <?php foreach ($satuan->result() as $s): ?>
                                        <option value="<?=$s->id?>"><?php echo $s->nama_satuan; ?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div> 
                        <div class="form-group row ">
                            <label for="nama" class="col-sm-3 col-form-label">Kondisi</label>
                            <div class="col-sm-9 kosong">
                                <select class="form-control" name="id_kondisi" id="id_kondisi">
                                    <option value="" selected="" disabled="">Pilih Kondisi</option>
                                    <?php foreach ($kondisi->result() as $k): ?>
                                        <option value="<?=$k->id_kondisi?>"><?php echo $k->kondisi; ?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="nama" class="col-sm-3 col-form-label">Tanggal Out</label>
                            <div class="col-sm-9 kosong">
                                <input type="date" class="form-control" name="tgl_out" id="tgl_out" placeholder="Tanggal Out" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="nama" class="col-sm-3 col-form-label">Penanggung Jawab</label>
                            <div class="col-sm-9 kosong">
                                <input type="text" class="form-control" name="penanggung_jawab" id="penanggung_jawab" placeholder="Penanggung Jawab" >
                              
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="nama" class="col-sm-3 col-form-label">Foto</label>
                            <div class="col-sm-9 kosong">
                                <img  id="v_image" width="100px" height="100px">
                                <input type="file" class="form-control btn-file" onchange="loadFile(event)" name="imagefile" id="imagefile" placeholder="Image" value="UPLOAD">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="nama" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9 kosong">
                                <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan"></textarea> 
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