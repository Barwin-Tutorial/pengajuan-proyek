<style type="text/css">
    .ui-autocomplete-input {
  border: none; 
  margin-bottom: 5px;
  padding-top: 2px;
  border: 1px solid #DDD !important;
  padding-top: 0px !important;
  z-index: 1511;
  position: relative;
}
.ui-menu .ui-menu-item a {
  font-size: 12px;
}
.ui-autocomplete {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1600 !important;
  float: left;
  display: none;
  min-width: 160px;
  width: 160px;
  padding: 4px 0;
  margin: 2px 0 0 0;
  list-style: none;
  background-color: #ffffff;
  border-color: #ccc;
  border-color: rgba(0, 0, 0, 0.2);
  border-style: solid;
  border-width: 1px;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  border-radius: 2px;
  -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding;
  background-clip: padding-box;
  *border-right-width: 2px;
  *border-bottom-width: 2px;
}
.ui-menu-item > a.ui-corner-all {
    display: block;
    padding: 3px 15px;
    clear: both;
    font-weight: normal;
    line-height: 18px;
    color: #555555;
    white-space: nowrap;
    text-decoration: none;
}
.ui-state-hover, .ui-state-active {
      color: #ffffff;
      text-decoration: none;
      background-color: #0088cc;
      border-radius: 0px;
      -webkit-border-radius: 0px;
      -moz-border-radius: 0px;
      background-image: none;
}

</style>
<!-- Main content -->
<section class="content" id="load_detail">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header bg-light">
        <h3 class="card-title"><i class="fa fa-list text-blue"></i> Laporan Penerimaan Barang</h3>
      </div>
      <div class="card-body">
        <form class="form" id="form_lap" action="<?php echo base_url('lap_tb/lap_excel') ?>" method="post">
          <div class="form-group row">

            <div class="col-md-8">
              <div class="input-group input-group-sm">
                <label class="aria-label col-md-5">Range Tanggal</label>
                <input type="text" class="form-control  float-right form-control-sm" name="tgl" id="reservation">
              </div>
            </div>
          </div>
          <div class="form-group row">
           <div class="col-md-8">
            <div class="input-group input-group-sm">
              <label class="aria-label col-md-5">Penyedia</label>
              <input type="hidden" class="form-control  float-right form-control-sm" name="supplier" >
              <input type="text" class="form-control  float-right form-control-sm" name="vpen" id="vpen" autofocus placeholder="Penyedia" >
              
            </div>
          </div>
        </div>
        <div class="form-group row">
         <div class="col-md-8">
          <div class="input-group input-group-sm">
            <label class="aria-label col-md-5">NO. SBBK</label>
            <input type="text" name="vfaktur" class="form-control float-right form-control-sm" placeholder="NO. SBBK">
            <input type="hidden" name="faktur">
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-4">
          <div class="form-group input-group-sm">
            <button type="button" class="btn btn-primary btn-xs" onclick="sortir()">Tampilkan</button>
            <button type="button" class="btn btn-primary btn-xs" onclick="reset()">Reset</button>
            <button type="button" class="btn btn-primary btn-xs" onclick="cetak()">Cetak</button>
            <button class="btn btn-success btn-xs" type="submit" >Export Excel <i class="fa fa-file-excel"></i></button>
            <!-- <button class="btn btn-warning btn-xs" type="button" onclick="download_pdf()">Download <i class="fa fa-file-pdf"></i></button> -->
          </div>
        </div>

      </div>
    </form>
    <div id="tampil"></div>
  </div>
</div>

</div>
<!-- /.container-fluid -->
</section>

<script >
  function reset() {
   $('input').val('')
  }
function cetak() {
        $.ajax({
        url : 'lap_tb/cetak',
        data : $('#form_lap').serialize(),
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

 $(function () {
   $('.select2').select2();

        $( "#vpen").autocomplete({
    source: 'masuk/get_supplier/?', 
    select : function (event, ui) {

         // display the selected text
         var value = ui.item.value;
        $("#supplier").val(value); // save selected id to hidden input
        $("#vpen").val(ui.item.label);
        return false;
      }
    })

    $('[name="vfaktur"]').autocomplete({
        source: 'lap_tb/get_faktur/?', 
        select: function (event, ui) {

        $('[name="vfaktur"]').val(ui.item.label); // display the selected text
        var value = ui.item.value;
        $('[name="faktur"]').val(value); // save selected id to hidden input
         /*$("#supplier").val(ui.item.supplier);
         $("#vsup").val(ui.item.nama_supplier);*/
        return false;
    }
})
 })
/* $(document).ready(function(){
  var url = "<?php echo site_url('lap_tb/laporan'); ?>";
  $("#tampil").load(url);
});*/

 function download_pdf() {
  $.ajax({
    url : "<?php echo site_url('lap_tb/lap_tiket_pdf'); ?>",
    data : $("#form_lap").serialize(),
    dataType: "JSON",
    type: "POST",
    success : function (response) {
     $('#tampil').html(response);
   }
 })
}



function sortir() {
    // event.preventDefault();
    $.ajax({
      url : "<?php echo site_url('lap_tb/laporan'); ?>",
      data : $("#form_lap").serialize(),
      dataType: "html",
      type: "POST",
      success : function (response) {
       $('#tampil').html(response);
     }
   })
  }
 //Date range picker
 $('#reservation').daterangepicker()

</script>

