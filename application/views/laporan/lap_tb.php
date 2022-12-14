
<!-- Main content -->
<section class="content" id="load_detail">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header bg-light">
        <h3 class="card-title"><i class="fa fa-list text-blue"></i> Laporan Penerimaan Barang</h3>
      </div>
      <div class="card-body">
        <form class="form" id="form_lap" action="<?php echo base_url('lap_tb/lap_excel') ?>" method="post">
          <div class="row">

            <div class="col-md-8">
              <div class="input-group input-group-sm">
                <label class="aria-label col-md-5">Range Tanggal</label>
                <input type="text" class="form-control  float-right form-control-sm" name="tgl" id="reservation">
              </div>
            </div>
          </div>
          <div class="row">
           <div class="col-md-8">
            <div class="input-group input-group-sm">
              <label class="aria-label col-md-5">Nama Supplier</label>
              <input type="text" class="form-control  float-right form-control-sm" name="vsup" id="vsup" autofocus placeholder="Nama Supplier" >
              <input type="hidden" class="form-control  float-right form-control-sm" name="supplier" id="supplier">
            </div>
          </div>
        </div>
        <div class="row">
         <div class="col-md-8">
          <div class="input-group input-group-sm">
            <label class="aria-label col-md-5">Faktur</label>
            <input type="text" name="faktur" class="form-control" placeholder="Faktur">
          </div>
        </div>
      </div>
      <div class="row">
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

        $( "#vsup").autocomplete({
    source: 'penerimaan/get_supplier/?', 
    select : function (event, ui) {

         // display the selected text
         var value = ui.item.value;
        $("#supplier").val(value); // save selected id to hidden input
        $("#vsup").val(ui.item.label);
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
 $('#reservation').daterangepicker({
  ranges   : {
    'Today'       : [moment(), moment()],
    'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    'This Month'  : [moment().startOf('month'), moment().endOf('month')],
    'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  },
  startDate: moment().subtract(29, 'days'),
  endDate  : moment()
},
function (start, end) {
  $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
}
)

</script>

