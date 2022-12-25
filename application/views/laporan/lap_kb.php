
<!-- Main content -->
<section class="content" id="load_detail">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header bg-light">
        <h3 class="card-title"><i class="fa fa-list text-blue"></i> Laporan Keluar Barang</h3>
      </div>
      <div class="card-body">
        <form class="form" id="form_lap" action="<?php echo base_url('lap_kb/lap_excel') ?>" method="post">
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
              <label class="aria-label col-md-5">Nama Pelanggan</label>
              <input type="text" class="form-control  float-right form-control-sm" name="pelanggan" id="pelanggan" autofocus placeholder="Nama Pelanggan">
              <input type="hidden" class="form-control  float-right form-control-sm" name="id_pelanggan" id="id_pelanggan">
            </div>
          </div>
        </div>
        <div class="form-group row">
         <div class="col-md-8">
          <div class="form-group input-group-sm">
            <label class="aria-label col-md-5"> </label>
            <input  type="radio"  name="group" value="Group" checked="">Group
            <input type="radio"  name="group" value="Detail">Detail

          </div>


        </div>
      </div>
        <div class="form-group input-group-sm">
          <button type="button" class="btn btn-primary btn-xs" onclick="sortir()">Tampilkan</button>
          <button type="button" class="btn btn-primary btn-xs" onclick="reset()">Reset</button>
          <button type="button" class="btn btn-primary btn-xs" onclick="cetak()">Cetak</button>
          <button class="btn btn-success btn-xs" type="submit" >Export Excel <i class="fa fa-file-excel"></i></button>
          <!-- <button class="btn btn-warning btn-xs" type="button" onclick="download_pdf()">Download <i class="fa fa-file-pdf"></i></button> -->
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
      url : 'lap_kb/cetak',
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

   $( "#pelanggan").autocomplete({
    source: 'keluar/get_pelanggan/?', 
    select: function (event, ui) {

        $("#pelanggan").val(ui.item.label); // display the selected text
        var value = ui.item.value;
        $("#id_pelanggan").val(value); // save selected id to hidden input
        return false;
      }
    })
 })


  function download_pdf() {
    $.ajax({
      url : "<?php echo site_url('lapkhusus/lap_tiket_pdf'); ?>",
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
      url : "<?php echo site_url('lap_kb/laporan'); ?>",
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

