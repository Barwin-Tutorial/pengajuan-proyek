
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
     <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light">
                    <h3 class="card-title"><i class="fa fa-list text-blue"></i> Data Retur Keluar</h3>
                    <div class="text-right">
                        <button type="button" class="btn btn-sm btn-outline-primary  add" onclick="add()" title="Add Data" ><i class="fas fa-plus" ></i> Add</button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tbl_retur" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr class="bg-info">
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th>Nama Barang</th>
                                <th>Kemasan</th>
                                <th>ED</th>
                                <th>Jumlah</th>
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

    <!-- /.tab-pane -->
</div>
<!-- /.tab-content -->
</div><!-- /.card-body -->
</div>
<!-- ./card -->
</div>
<!-- /.col -->
</div>

<!-- /.container-fluid -->
</section>


<script type="text/javascript">
var save_method; //for save method string
var table;

$(document).ready(function() {

    //datatables
    table =$("#tbl_retur").DataTable({
        "responsive": true,
        "autoWidth": false,
        "language": {
            "sEmptyTable": "Data Retur Belum Ada"
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('retur_keluar/ajax_list')?>",
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
        url:"<?php echo site_url('retur_keluar/delete');?>",
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
    $('.modal-title').text('Add Retur Keluar'); // Set Title to Bootstrap modal title
}

function edit(id){
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('retur_keluar/edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
         $('[name="id"]').val(data.id);
         $('[name="tanggal"]').val(data.tanggal);
         $('[name="pelanggan"]').val(data.id_pelanggan);
         $('[name="vpel"]').val(data.nama_pelanggan);
         $.ajax({
            url : "retur_keluar/edit_to_cart",
            method : "POST",
            data : {id:data.id},
            dataType : 'html',
            success: function(data){
                $('#detail_cart').html(data);
            }
        });

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Retur Keluar'); // Set title to Bootstrap modal title

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
        url = "<?php echo site_url('retur_keluar/insert')?>";
    } else {
        url = "<?php echo site_url('retur_keluar/update')?>";
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
                $("#modal_form").removeData();
                $('#detail_cart').empty();
                reload_table();
                Toast.fire({
                    icon: 'success',
                    title: 'Success!!.'
                });
            }
            else
            {
                Toast.fire({
                    icon: 'error',
                    title: 'Error!!.'
                });
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
    $("#jumlah").change(function () {
        var formdata = $('#form').serialize();
        $.ajax({
            url : "retur_keluar/add_to_cart",
            method : "POST",
            data : formdata,
            dataType : 'html',
            success: function(data){
                $('#detail_cart').html(data);
            }
        });
    })

    $(document).on('click','.hapus_cart',function(){
            var id=$(this).attr("id_retur_keluar"); //mengambil row_id dari artibut id
            var id_detail=$(this).attr("id_detail");
            
            $.ajax({
                url : "retur_keluar/hapus_cart",
                method : "POST",
                data : {id : id,id_detail:id_detail},
                success :function(data){
                    reload_table();
                    Toast.fire({
                        icon: 'success',
                        title: 'Success!!.'
                    });
                    $('#detail_cart').html(data);
                }
            });
        });
    $(document).on('click','.simpan_cart',function(){
        var id=$(this).attr("id_retur_keluar");
            var id_detail=$(this).attr("id_detail"); //mengambil row_id dari artibut id
            var no = $(this).attr("no");
            var jumlah = $('.item'+no).val();
            var ed = $('.ed'+no).val();

            $.ajax({
                url : "retur_keluar/update_cart",
                method : "POST",
                data : {id : id,id_detail : id_detail,jumlah : jumlah,ed : ed},
                success :function(data){
                    reload_table();
                    Toast.fire({
                        icon: 'success',
                        title: 'Success!!.'
                    });
                    $('#detail_cart').html(data);
                }
            });
        });


});
function simpan_det(row_id, no)
{
    var item = $('.item'+no).val();
    var nobatch = $('.nobatch'+no).val();
    var ed = $('.ed'+no).val();
    var jumlah = $('.item'+no).val();
    $.ajax({
        url : "retur_keluar/update_cart",
        method : "POST",
        data : {row_id : row_id,item : item,ed : ed},
        success :function(data){
            Toast.fire({
                icon: 'success',
                title: 'Success!!.'
            });
            $('#detail_cart').html(data);
        }
    });

}
$(document).ready(function(){

$( "#vpel").autocomplete({
        source: 'keluar/get_pelanggan/?', 
        select: function (event, ui) {
        
        $("#vpel").val(ui.item.label); // display the selected text
        var value = ui.item.value;
        $("#pelanggan").val(value); // save selected id to hidden input
        return false;
    }
    })

// setTimeout(function() { $('input[name="scanbar"]').focus() }, 3000);
 // $('#scanbar').focus();
   $( "#scanbar").autocomplete({
    source: 'retur_keluar/get_brg/?', 
    select : function (event, ui) {

        $("#produk_nama").val(ui.item.label); // display the selected text
        $("#produk_nama").val(ui.item.produk_nama);
        $("#produk_id").val(ui.item.produk_id); // save selected id to hidden input
        $("#produk_harga").val(ui.item.produk_harga);
        $("#nama_satuan").val(ui.item.nama_satuan);
        $("#kemasan").val(ui.item.id_kemasan);
        $('#scanbar').val('');
        return false;

    }
})
});

function batal() {
    $('#modal_form').modal('hide');
    $("#modal_form").removeData();
    $("#detail_cart").empty();
    $('[name="id"]').val('0');
 $.ajax({
    url : "retur_keluar/hapus_all_cart",
    success :function(data){
           
       }
   });
}

setTimeout(function() { $('input[name="scanbar"]').focus() }, 3000);
</script>



<!-- Bootstrap modal -->
<div class="modal hide fade" id="modal_form" role="dialog" tabindex="1550" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">

            <div class="modal-header">
                <h3 class="modal-title">penerimaan Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="batal()">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" >
                    <input type="hidden" value="0" name="id"/> 
                    <div class="card-body">
                        <div class="row">
                         <div class="col-md-4">
                            <div class="form-group row ">
                                <label for="nama" class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-9 kosong">
                                    <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo date("Y-m-d") ?>" readonly>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label for="nama" class="col-sm-3 col-form-label">Pelanggan</label>
                                <div class="col-sm-9 kosong">
                                    <input type="hidden" class="form-control"  name="pelanggan" id="pelanggan" placeholder="Supplier" autocomplete="off" >
                                    <input type="text" class="form-control"  name="vpel" id="vpel" placeholder="Pelanggan" autocomplete="off" >
                                    <span class="help-block" ></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group row ">
                            <label for="nama" class="col-sm-2 col-form-label">Nama Barang</label>
                            <div class="col-sm-5 kosong">
                               <input type="hidden" class="form-control" name="produk_id" id="produk_id" value=""  >
                               <input type="hidden" class="form-control" name="produk_harga" id="produk_harga" value=""  >
                               <input type="hidden" class="form-control" name="kemasan" id="kemasan" placeholder="Kemasan" value="">
                               <input type="text" class="form-control" name="scanbar" id="scanbar" autofocus autocomplete="off" placeholder="Scan Barcode / Ketik Manual" >

                               <span class="help-block"></span>
                           </div>
                           <label for="nama" class="col-sm-2 col-form-label">Kemasan</label>
                           <div class="col-sm-3 kosong">
                               <input type="text" class="form-control" name="nama_satuan" id="nama_satuan"  value="" readonly="" placeholder="Kemasan">
                               <span class="help-block"></span>
                           </div>
                       </div>

                       <div class="form-group row ">
                        <label for="nama" class="col-sm-2 col-form-label">Expired</label>
                        <div class="col-sm-5 kosong">
                            <input type="date" class="form-control"  name="ed" id="ed" placeholder="Expired"  value="<?php echo date("Y-m-d") ?>">
                            <span class="help-block"></span>
                        </div>
                        <label for="nama" class="col-sm-2 col-form-label">Jumlah</label>
                        <div class="col-sm-3 kosong">
                            <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="jumlah" id="jumlah" placeholder="Jumlah" >
                            <span class="help-block"></span>
                        </div>

                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                      <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead class="bg-info">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Kemasan</th>
                                    <th>Jumlah</th>
                                    <th>ED</th>
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
    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="batal()">Cancel</button>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->