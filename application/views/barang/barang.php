
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h3 class="card-title"><i class="fa fa-list text-blue"></i> Data Barang</h3>
                        <div class="text-right">
                            <button type="button" class="btn btn-sm btn-outline-primary  add" onclick="add()" title="Add Data" ><i class="fas fa-plus" ></i> Add</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tbl_barang" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-info">
                                    <th>Barcode</th>
                                    <th>Nama</th>
                                    <th>Satuan</th>
                                    <th>Berat</th>
                                    <th>Perundangan</th>
                                    <th>Harga</th>
                                    <th>Lokasi Rak</th>
                                    <th>Aktivasi</th>
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
    setTimeout(function() { $('input[name="barcode"]').focus() }, 3000);
    //datatables
    table =$("#tbl_barang").DataTable({
        "responsive": true,
        "autoWidth": false,
        "language": {
            "sEmptyTable": "Data Barang Belum Ada"
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('barang/ajax_list')?>",
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

    $.ajax({
        url:"<?php echo site_url('barang/delete');?>",
        type:"POST",
        data:"id="+id,
        cache:false,
        dataType: 'json',
        success:function(respone){
            if (respone.status == true) {
                reload_table();
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                  );
            }else{
              Toast.fire({
                  icon: 'error',
                  title: 'Delete Error!!.'
              });
          }
      }
  });
})
}



function add()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal({backdrop: 'static', keyboard: false}); // show bootstrap modal
    $('.modal-title').text('Add barang'); // Set Title to Bootstrap modal title
}

function edit(id){
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('barang/edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="barcode"]').val(data.barcode);
            $('[name="nama"]').val(data.nama);
            $('[name="kemasan"]').val(data.kemasan);
            $('[name="berat"]').val(data.berat);
            $('[name="perundangan"]').val(data.perundangan);
            $('[name="harga"]').val(data.harga);
            $('[name="rak"]').val(data.rak);
            $('[name="view"]').val(data.view);
            
             /*var image = "<?php echo base_url('assets/barang/')?>";
             $("#v_image").attr("src",image+data.image);*/

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit barang'); // Set title to Bootstrap modal title

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
        url = "<?php echo site_url('barang/insert')?>";
    } else {
        url = "<?php echo site_url('barang/update')?>";
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
var loadFile = function(event) {
  var image = document.getElementById('vbarcode');
  image.src = URL.createObjectURL(event.target.files[0]);
};

function hanyaAngka(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))

    return false;
return true;
}

function barcode(id) {
    $('#form1')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('barang/edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id);
            $('[name="barcode"]').val(data.barcode);
            $('#vcode').text(data.barcode)
            var image = "<?php echo base_url('barang/set_barcodePNG/')?>"+data.barcode+'/'+2+'/'+42;
             $("#vbarcode").load(image);
            $('#modal_form1').modal('show'); // show bootstrap modal when complete loaded

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

    function print_barcode() {
     $.ajax({
        url : 'barang/print_barcode',
        data : $('#form1').serialize(),
        type : 'post',
        dataType : 'html',
        success : function (respon) {
            /*$("#load").html(respon);*/
            var doc = window.open();
            doc.document.write(respon);
            doc.print();
        }
    })
 }
</script>



<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog" tabindex="-1" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">

            <div class="modal-header">
                <h3 class="modal-title">Barang Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" >
                    <input type="hidden" value="" name="id"/> 
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row ">
                                    <label for="nama" class="col-sm-3 col-form-label">Barcode</label>
                                    <div class="col-sm-9 kosong">
                                        <input type="text" class="form-control" autofocus  name="barcode" id="barcode" placeholder="Barcode" >
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
                                    <label for="nama" class="col-sm-3 col-form-label">Satuan</label>
                                    <div class="col-sm-9 kosong">
                                        <select class="form-control" name="kemasan" >
                                          <option value="">Pilih Satuan...</option>
                                          <?php 
                                          foreach ($satuan as $row){
                                            ?>
                                            <option value="<?=$row->id?>"><?php echo $row->nama; ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label for="nama" class="col-sm-3 col-form-label">Perundangan</label>
                                <div class="col-sm-9 kosong">

                                    <select class="form-control" name="perundangan" >
                                      <option value="">Pilih...</option>
                                      <?php 
                                      foreach ($perundangan as $row){
                                        ?>
                                        <option value="<?=$row->id?>"><?php echo $row->nama; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                     <div class="form-group row ">
                        <label for="nama" class="col-sm-3 col-form-label">Berat</label>
                        <div class="col-sm-9 kosong">
                            <input type="text" class="form-control" name="berat" id="berat" placeholder="Berat" >
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="nama" class="col-sm-3 col-form-label">Harga</label>
                        <div class="col-sm-9 kosong">
                            <input type="text" class="form-control" onkeypress="return hanyaAngka(event)"  name="harga" id="harga" placeholder="Harga" >
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="nama" class="col-sm-3 col-form-label">Lokasi Rak</label>
                        <div class="col-sm-9 kosong">
                            <input type="text" class="form-control" name="rak" id="rak" placeholder="Lokasi Rak" >
                            <span class="help-block"></span>
                        </div>
                    </div>
                        <!-- <div class="form-group row ">
                            <label for="logo" class="col-sm-3 col-form-label">Foto</label>
                            <div class="col-sm-9 kosong">
                              <img  id="v_image" width="100px" height="100px">
                              <input type="file" class="form-control btn-file" onchange="loadFile(event)" name="imagefile" id="imagefile" placeholder="Image" value="UPLOAD">
                          </div>
                      </div> -->
                      <div class="form-group row ">
                        <label for="nama_owner" class="col-sm-3 col-form-label">Aktivasi</label>
                        <div class="col-sm-9 kosong">
                            <select class="form-control select" name="aktivasi">
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
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
<div class="modal fade" id="modal_form1" role="dialog" tabindex="-1" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md">
        <div class="modal-content ">

            <div class="modal-header">
                <h3 class="modal-title">Barcode</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body form">
                <form action="#" id="form1" class="form-horizontal" >
                    <input type="hidden" value="" name="id"/> 
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row ">
                                    <label for="nama" class="col-sm-4 col-form-label">Barcode</label>
                                    <div class="col-sm-8 kosong">
                                        <input type="text" class="form-control" autofocus  name="barcode" id="barcode" placeholder="Barcode" >
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <!-- <div class="form-group row ">
                                    <label for="nama" class="col-sm-4 col-form-label">Width</label>
                                    <div class="col-sm-8 kosong">
                                        <input type="text" class="form-control" name="width" id="width" placeholder="Width" >
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label for="nama" class="col-sm-4 col-form-label">Height</label>
                                    <div class="col-sm-8 kosong">
                                        <input type="text" class="form-control" name="height" id="height" placeholder="Height" >
                                        <span class="help-block"></span>
                                    </div>
                                </div> -->
                                <div class="form-group row ">
                                    <label for="nama" class="col-sm-4 col-form-label">Jumlah</label>
                                    <div class="col-sm-8 kosong">
                                        <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" >
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label for="nama" class="col-sm-4 col-form-label">View Barcode</label>
                                    <div class="col-sm-8 kosong">
                                       <div id="vbarcode" >
                                        <span class="vcode"></span>
                                    </div>
                                </div>
                                
                            </div>
                        </div> 
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="print_barcode()" class="btn btn-primary"><i class="fas fa-print"></i> Cetak Barcode </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->