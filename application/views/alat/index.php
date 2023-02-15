
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
                        <table id="tbl_alat" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr class="bg-purple">
                                    <th>QR Code</th>
                                    <th>Nama Alat</th>
                                    <th>Stok</th>
                                    <th>Foto</th>
                                    <th>Kondisi</th>
                                    <th>Ruang</th>
                                    <th>Dana</th>
                                    <th>Tahun Masuk</th>
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
    table =$("#tbl_alat").DataTable({
        "responsive": true,
        "autoWidth": false,
        "language": {
            "sEmptyTable": "Data Alat Belum Ada"
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('alat/ajax_list')?>",
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
            url:"<?php echo site_url('alat/delete');?>",
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
    $('.modal-title').text('Add Alat'); // Set Title to Bootstrap modal title
}

function edit(id){
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('alat/edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id_alat);
            $('[name="nama_alat"]').val(data.nama_alat);
            $('[name="id_merk"]').val(data.id_merk);
            $('[name="id_kondisi"]').val(data.id_kondisi);
            $('[name="id_ruang"]').val(data.id_ruang);
            $('[name="id_satuan"]').val(data.id_satuan);
            $('[name="id_dana"]').val(data.id_dana);
            $('[name="id_tahun"]').val(data.id_tahun);
            $('[name="stok"]').val(data.stok);
            $('[name="photo"]').val(data.photo);
            $('[name="keterangan"]').val(data.keterangan);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Alat'); // Set title to Bootstrap modal title

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
        url = "<?php echo site_url('alat/insert')?>";
    } else {
        url = "<?php echo site_url('alat/update')?>";
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
$(function () {
    
    $(".select").select2();
  })

$(document).ready(function(){

   $( "#nama_merk").autocomplete({
    source: 'alat/get_merk_by_nama/?', 
    select : function (event, ui) {

         // display the selected text
         var value = ui.item.value;
        $("#id_merk").val(value); // save selected id to hidden input
        $("#nama_merk").val(ui.item.label);
        return false;
    }
})
  $( "#nama_satuan").autocomplete({
    source: 'bahan/get_satuan_by_nama/?', 
    select : function (event, ui) {

         // display the selected text
         var value = ui.item.value;
        $("#id_satuan").val(value); // save selected id to hidden input
        $("#nama_satuan").val(ui.item.label);
        return false;
    }
})
});
</script>



<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" tabindex="-1"  role="dialog" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">

            <div class="modal-header">
                <h3 class="modal-title">Alat Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" >
                    <input type="hidden" value="" name="id"/> 
                    <div class="card-body">
                        
                        <div class="form-group row ">
                            <label for="nama" class="col-sm-3 col-form-label">Nama Alat</label>
                            <div class="col-sm-9 kosong">
                                <input type="text" class="form-control" name="nama_alat" id="nama" placeholder="Nama Alat" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row ">

                            <label for="nama" class="col-sm-3 col-form-label">Merk</label>
                            <div class="col-sm-9 kosong">
                                <input type="hidden" name="id_merk" id="id_merk">
                                <input type="text" class="form-control" name="nama_merk" id="nama_merk" placeholder="Ketik Merk" >
                             <span class="help-block"></span>
                         </div>
                     </div>
                     <div class="form-group row ">
                        <label for="nama" class="col-sm-3 col-form-label">Satuan</label>
                        <div class="col-sm-9 kosong">
                            <input type="hidden" name="id_satuan" id="id_satuan">
                            <input type="text" class="form-control" name="nama_satuan" id="nama_satuan" placeholder="Ketik Satuan" >
                            
                         <span class="help-block"></span>
                     </div>
                 </div>
                 <div class="form-group row ">
                    <label for="stok" class="col-sm-3 col-form-label">Stok</label>
                    <div class="col-sm-9 kosong">
                        <input type="text" class="form-control" name="stok" id="stok" placeholder="Stok" >
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group row ">
                    <label for="nama" class="col-sm-3 col-form-label">Photo</label>
                    <div class="col-sm-9 kosong">
                        <img  id="v_image" width="100px" height="100px">
                        <input type="file" class="form-control btn-file" onchange="loadFile(event)" name="imagefile" id="imagefile" placeholder="Image" value="UPLOAD">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group row ">
                    <label for="nama" class="col-sm-3 col-form-label">Kondisi</label>
                    <div class="col-sm-9 kosong">
                        <select class="form-control" name="id_kondisi" id="id_kondisi">
                                <option value="" disabled="" selected="">Pilih Kondisi</option>
                                <?php foreach ($kondisi->result() as $k): ?>
                                 <option value="<?=$k->id_kondisi?>"><?php echo $k->kondisi; ?></option>
                             <?php endforeach ?>
                         </select>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group row ">
                    <label for="nama" class="col-sm-3 col-form-label">Ruang</label>
                    <div class="col-sm-9 kosong">
                        <select class="form-control" name="id_ruang" id="id_ruang">
                                <option value="" disabled="" selected="">Pilih Ruang</option>
                                <?php foreach ($ruang->result() as $r): ?>
                                 <option value="<?=$r->id_ruang?>"><?php echo $r->nama_ruang; ?></option>
                             <?php endforeach ?>
                         </select>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group row ">
                    <label for="nama" class="col-sm-3 col-form-label">Dana</label>
                    <div class="col-sm-9 kosong">
                        <select class="form-control" name="id_dana" id="id_dana">
                                <option value="" disabled="" selected="">Pilih Dana</option>
                                <?php foreach ($dana->result() as $r): ?>
                                 <option value="<?=$r->id_dana?>"><?php echo $r->dana; ?></option>
                             <?php endforeach ?>
                         </select>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group row ">
                    <label for="nama" class="col-sm-3 col-form-label">Tahun Masuk</label>
                    <div class="col-sm-9 kosong">
                        <select class="form-control" name="id_tahun" id="id_tahun">
                                <option value="" disabled="" selected="">Pilih Tahun Masuk</option>
                                <?php foreach ($tahun->result() as $r): ?>
                                 <option value="<?=$r->id_tahun?>"><?php echo $r->tahun; ?></option>
                             <?php endforeach ?>
                         </select>
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