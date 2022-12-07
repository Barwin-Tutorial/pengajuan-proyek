
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h3 class="card-title"><i class="fa fa-list text-blue"></i> Data Penerimaan</h3>
                        <div class="text-right">
                            <button type="button" class="btn btn-sm btn-outline-primary  add" onclick="add()" title="Add Data" ><i class="fas fa-plus" ></i> Add</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tbl_penerimaan" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-info">
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Kemasan</th>
                                    <th>Jumlah</th>
                                    <th>No Batch</th>
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
function hanyaAngka(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))

    return false;
  return true;
}
$(document).ready(function() {

    //datatables
    table =$("#tbl_penerimaan").DataTable({
        "responsive": true,
        "autoWidth": false,
        "language": {
            "sEmptyTable": "Data Penerimaan Belum Ada"
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('penerimaan/ajax_list')?>",
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
        url:"<?php echo site_url('penerimaan/delete');?>",
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
    $('.modal-title').text('Add Penerimaan'); // Set Title to Bootstrap modal title
}

function edit(id){
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('penerimaan/edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="faktur"]').val(data.faktur);
            $('[name="tanggal"]').val(data.tanggal);
            $('[name="supplier"]').val(data.supplier);
            $.ajax({
                url : "penerimaan/edit_to_cart",
                method : "POST",
                data : {id:data.id},
                dataType : 'html',
                success: function(data){
                    $('#detail_cart').html(data);
                }
            });
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Penerimaan'); // Set title to Bootstrap modal title

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
        url = "<?php echo site_url('penerimaan/insert')?>";
    } else {
        url = "<?php echo site_url('penerimaan/update')?>";
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
    $("#produk_nama").change(function () {
        var formdata = $('#form').serialize();
        $.ajax({
                url : "penerimaan/add_to_cart",
                method : "POST",
                data : formdata,
                dataType : 'html',
                success: function(data){
                    $('#detail_cart').html(data);
                }
            });
    })

    $(document).on('click','.hapus_cart',function(){
            var row_id=$(this).attr("id"); //mengambil row_id dari artibut id
            $.ajax({
                url : "penerimaan/hapus_cart",
                method : "POST",
                data : {row_id : row_id},
                success :function(data){
                    $('#detail_cart').html(data);
                }
            });
        });
    $(document).on('click','.simpan_cart',function(){
            var row_id=$(this).attr("id"); //mengambil row_id dari artibut id
            var no = $(this).attr("no");
            var item = $('.item'+no).val();
            var nobatch = $('.nobatch'+no).val();
            var ed = $('.ed'+no).val();

            $.ajax({
                url : "penerimaan/update_cart",
                method : "POST",
                data : {row_id : row_id,item : item,nobatch : nobatch,ed : ed},
                success :function(data){
                    $('#detail_cart').html(data);
                }
            });
        });
})
function simpan_det(row_id, no)
{
    var item = $('.item'+no).val();
    var nobatch = $('.nobatch'+no).val();
    var ed = $('.ed'+no).val();
  
    $.ajax({
        url : "penerimaan/update_cart",
        method : "POST",
        data : {row_id : row_id,item : item,nobatch : nobatch,ed : ed},
        success :function(data){
            $('#detail_cart').html(data);
        }
    });
  
}
</script>



<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">

            <div class="modal-header">
                <h3 class="modal-title">penerimaan Form</h3>
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
                                <label for="nama" class="col-sm-3 col-form-label">Faktur</label>
                                <div class="col-sm-9 kosong">
                                    <input type="text" class="form-control" name="faktur" id="faktur" placeholder="Faktur" >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label for="nama" class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-9 kosong">
                                    <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label for="nama" class="col-sm-3 col-form-label">Supplier</label>
                                <div class="col-sm-9 kosong">
                                    <input type="text" class="form-control" name="supplier" id="supplier" placeholder="Supplier" >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row ">
                                <label for="nama" class="col-sm-2 col-form-label">Jumlah</label>
                                <div class="col-sm-4 kosong">
                                    <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="jumlah" id="jumlah" placeholder="Jumlah" >
                                    <span class="help-block"></span>
                                </div>
                                <label for="nama" class="col-sm-2 col-form-label">Kemasan</label>
                                <div class="col-sm-4 kosong">
                                    <input type="text" class="form-control" name="kemasan" id="kemasan" placeholder="Kemasan" value="" >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label for="nama" class="col-sm-2 col-form-label">Expired</label>
                                <div class="col-sm-4 kosong">
                                    <input type="date" class="form-control"  name="ed" id="ed" placeholder="Expired" >
                                    <span class="help-block"></span>
                                </div>
                                <label for="nama" class="col-sm-2 col-form-label">No Batch</label>
                                <div class="col-sm-4 kosong">
                                    <input type="text" class="form-control" name="nobatch" id="nobatch" placeholder="No Batch" value="" >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label for="nama" class="col-sm-2 col-form-label">Barang</label>
                                <div class="col-sm-10 kosong" >
                                    <input type="text" class="form-control" name="produk_nama" id="produk_nama" placeholder="Scan Barcode / Input Manual" autofocus>
                                    <input type="hidden" class="form-control" name="produk_id" id="produk_id" value="12"  >
                                    <input type="hidden" class="form-control" name="produk_harga" id="produk_harga" value="12000"  >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                              
                              <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead class="bg-info">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Kemasan</th>
                                            <th>Jumlah</th>
                                            <th>No Batch</th>
                                            <th>ED</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detail_cart">

                                    </tbody>

                                </table>

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