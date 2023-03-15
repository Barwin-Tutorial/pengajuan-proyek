
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
                        <table id="tbl_kerusakan_alat" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr class="bg-purple">
                                    <!-- <th>Nama Peminjam</th> -->
                                    <!-- <th>Jabatan</th> -->
                                    <th>Nama Alat</th>
                                    <th>Stok Out</th>
                                    <th>Satuan</th>
                                    <!--<th>Kondisi</th>-->
                                    <th>Tanggal Input</th>
                                    <!-- <th>Penanggung Jawab</th> -->
                                    <th>Keterangan</th>
                                    <th>Foto</th>
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
    table =$("#tbl_kerusakan_alat").DataTable({
        "responsive": true,
        "autoWidth": false,
        "language": {
            "sEmptyTable": "Data Kerusakan Belum Ada"
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('kerusakan_alat/ajax_list')?>",
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
            url:"<?php echo site_url('kerusakan_alat/delete');?>",
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
    $('.modal-title').text('Kerusakan Alat'); // Set Title to Bootstrap modal title
}

function edit(id){
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('kerusakan_alat/edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id_kerusakan_alat);
            $('[name="nama"]').val(data.nama);
            $('[name="id_alat"]').val(data.id_alat);
            $('[name="id_kondisi"]').val(data.id_kondisi);
            $('[name="id_satuan"]').val(data.id_satuan);
            $('[name="stok_out"]').val(data.stok_out);
            $('[name="tgl_input"]').val(data.tgl_input);
            $('[name="keterangan"]').val(data.keterangan);
            // $('[name="imagefile"]').val(data.foto);
            var foto = "<?php echo base_url('assets/foto/images/')?>"+data.foto;
             $("#v_image").attr("src",foto);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Kerusakan Alat'); // Set title to Bootstrap modal title
            setTimeout(function() { $('input[name="scanbar"]').focus() }, 2000);
            $.ajax({
                url : 'kerusakan_alat/get_alat_by_id/',
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
        url = "<?php echo site_url('kerusakan_alat/insert')?>";
    } else {
        url = "<?php echo site_url('kerusakan_alat/update')?>";
    }

   /* let stok =$('[name="stok"]').val();
    let stok_out=$('[name="stok_out"]').val();

    if (stok_out > stok) {
     Swal.fire({
        title : 'Peringatan!',
        html :'Stok Saat Ini = '+stok+'<br> Anda Menginput = '+stok_out,
        icon : 'warning'
    });
     $('[name="stok_out"]').val(stok);
     $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
            return false;
        }*/

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
    source: 'kerusakan_alat/get_alat/?', 
    select : function (event, ui) {

         // display the selected text
         var value = ui.item.value;
        $("#id_alat").val(value); // save selected id to hidden input
        $("#nama_alat").val(ui.item.label);
        $('[name="id_satuan"]').val(ui.item.id_satuan);
        $('[name="id_kondisi"]').val(ui.item.id_kondisi);
        $('[name="stok"]').val(ui.item.stok);
        $('[name="stok_out"]').val(ui.item.stok);
        return false;
    }
})

   setTimeout(function() { $('input[name="scanbar"]').focus() }, 2000);

   $( "#scanbar").change(function () {
    var barcode = $(this).val();
    $.ajax({
        url : 'kerusakan_alat/get_alat_bar/',
        data : {barcode:barcode},
        dataType : 'json',
        type : 'POST',
        success : function (data) {
            $("#nama_alat").val(data.nama_alat); 
            $("#id_alat").val(data.id_alat);
            $('[name="id_satuan"]').val(data.id_satuan);
            $('[name="id_kondisi"]').val(data.id_kondisi);
            $('[name="stok"]').val(data.stok);
            $('[name="stok_out"]').val(data.stok);
            return false;
        }

    })
})

   $('[name="stok_out"]').change(function () {
    let stok_out = parseInt($(this).val());
    let stok = parseInt($('[name="stok"]').val());
    if (stok_out > stok) {
     Swal.fire({
        title : 'Peringatan!',
        html :'Stok Saat Ini = '+stok+'<br> Anda Menginput = '+stok_out,
        icon : 'warning'
    });
     $(this).val(stok);
 }
})

});
</script>



<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">

            <div class="modal-header">
                <h3 class="modal-title">Kerusakan Form</h3>
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
                            <input type="hidden" class="form-control" name="id_alat" id="id_alat">
                            <input type="hidden" class="form-control" name="id_satuan" id="id_satuan">
                            <input type="text" class="form-control" name="nama_alat" id="nama_alat" autofocus autocomplete="off" placeholder="Ketik Nama Alat" >

                            <span class="help-block"></span>
                        </div>
                    </div>
                  
                    <div class="form-group row ">
                        <label for="nama" class="col-sm-3 col-form-label">Stok Out</label>
                        <div class="col-sm-9 kosong">
                            <input type="hidden" name="stok" id="stok">
                            <input type="number" class="form-control" name="stok_out" id="stok_out" placeholder="Stok Out" >
                            <span class="help-block"></span>
                        </div>
                    </div>
                        
                        <div class="form-group row ">
                            <label for="nama" class="col-sm-3 col-form-label">Kondisi</label>
                            <div class="col-sm-9 kosong">
                                <select class="form-control" name="id_kondisi" id="id_kondisi">
                                    <option value="2" selected="" >Rusak</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="nama" class="col-sm-3 col-form-label">Tanggal Input</label>
                            <div class="col-sm-9 kosong">
                                <input type="date" class="form-control" name="tgl_input" id="tgl_input" placeholder="Tanggal Input" >
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