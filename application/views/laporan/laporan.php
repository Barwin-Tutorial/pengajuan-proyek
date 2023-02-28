
<!-- Main content -->
<section class="content" id="load_detail">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <div class="card card-default">
      <div class="card-header bg-light">
        <h3 class="card-title"><i class="fa fa-list text-blue"></i> Peminjaman</h3>
      </div>
      <div class="card-body">
        <form class="form" id="lpinjam" action="<?=base_url('laporan/lap_pinjam') ?>" method="post">
          <div class="form-group row">

            <div class="col-md-8">
              <div class="input-group input-group-sm">
                <label class="aria-label col-md-5">Range Tanggal</label>
                <input type="text" class="form-control  float-right form-control-sm reservation" name="tgl_pinjam">
              </div>
            </div>
          </div>

          <div class="form-group row">
              <div class="form-group input-group-sm">
                <!-- <button type="button" class="btn btn-primary btn-xs" onclick="sortir()">Tampilkan</button> -->
                <button type="button" class="btn btn-primary btn-xs" onclick="reset()">Reset</button>
                <button type="button" class="btn btn-info btn-xs" onclick="cetak()">Cetak <i class="fa fa-print"></i></button>
                <button type="button" class="btn btn-info btn-xs" onclick="word()">Word <i class="fa fa-file-word"></i></button>
                <button class="btn btn-success btn-xs" type="submit" >Export Excel <i class="fa fa-file-excel"></i></button>
                <button class="btn btn-warning btn-xs" type="button" onclick="download_pdf()">Download <i class="fa fa-file-pdf"></i></button>
              </div>
            

          </div>
        </form>
        <div id="tampil"></div>
      </div>
    </div>
      </div>
      <div class="col-lg-6">
        <div class="card card-default">
      <div class="card-header bg-light">
        <h3 class="card-title"><i class="fa fa-list text-blue"></i> Laporan</h3>
      </div>
      <div class="card-body">
        <form class="form" id="form_lap" action="<?=base_url('laporan/lap_excel') ?>" method="post">
          <div class="form-group row">

            <div class="col-md-8">
              <div class="input-group input-group-sm">
                <label class="aria-label col-md-5">Range Tanggal</label>
                <input type="text" class="form-control  float-right form-control-sm reservation" name="tgl" >
              </div>
            </div>
          </div>

          <div class="form-group row">
              <div class="form-group input-group-sm">
                <button type="button" class="btn btn-primary btn-xs" onclick="sortir()">Tampilkan</button>
                <button type="button" class="btn btn-primary btn-xs" onclick="reset()">Reset</button>
                <button type="button" class="btn btn-info btn-xs" onclick="cetak()">Cetak <i class="fa fa-print"></i></button>
                <button type="button" class="btn btn-info btn-xs" onclick="word()">Word <i class="fa fa-file-word"></i></button>
                <button class="btn btn-success btn-xs" type="submit" >Export Excel <i class="fa fa-file-excel"></i></button>
                <button class="btn btn-warning btn-xs" type="button" onclick="download_pdf()">Download <i class="fa fa-file-pdf"></i></button>
              </div>
            

          </div>
        </form>
        <div id="tampil"></div>
      </div>
    </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="card card-default">
      <div class="card-header bg-light">
        <h3 class="card-title"><i class="fa fa-list text-blue"></i> Laporan</h3>
      </div>
      <div class="card-body">
        <form class="form" id="form_lap" action="<?=base_url('laporan/lap_excel') ?>" method="post">
          <div class="form-group row">

            <div class="col-md-8">
              <div class="input-group input-group-sm">
                <label class="aria-label col-md-5">Range Tanggal</label>
                <input type="text" class="form-control  float-right form-control-sm reservation" name="tgl" >
              </div>
            </div>
          </div>

          <div class="form-group row">
              <div class="form-group input-group-sm">
                <button type="button" class="btn btn-primary btn-xs" onclick="sortir()">Tampilkan</button>
                <button type="button" class="btn btn-primary btn-xs" onclick="reset()">Reset</button>
                <button type="button" class="btn btn-info btn-xs" onclick="cetak()">Cetak <i class="fa fa-print"></i></button>
                <button type="button" class="btn btn-info btn-xs" onclick="word()">Word <i class="fa fa-file-word"></i></button>
                <button class="btn btn-success btn-xs" type="submit" >Export Excel <i class="fa fa-file-excel"></i></button>
                <button class="btn btn-warning btn-xs" type="button" onclick="download_pdf()">Download <i class="fa fa-file-pdf"></i></button>
              </div>
            

          </div>
        </form>
        <div id="tampil"></div>
      </div>
    </div>
      </div>
      <div class="col-lg-6">
        <div class="card card-default">
      <div class="card-header bg-light">
        <h3 class="card-title"><i class="fa fa-list text-blue"></i> Laporan</h3>
      </div>
      <div class="card-body">
        <form class="form" id="form_lap" action="<?=base_url('laporan/lap_excel') ?>" method="post">
          <div class="form-group row">

            <div class="col-md-8">
              <div class="input-group input-group-sm">
                <label class="aria-label col-md-5">Range Tanggal</label>
                <input type="text" class="form-control  float-right form-control-sm reservation" name="tgl" >
              </div>
            </div>
          </div>

          <div class="form-group row">
              <div class="form-group input-group-sm">
                <button type="button" class="btn btn-primary btn-xs" onclick="sortir()">Tampilkan</button>
                <button type="button" class="btn btn-primary btn-xs" onclick="reset()">Reset</button>
                <button type="button" class="btn btn-info btn-xs" onclick="cetak()">Cetak <i class="fa fa-print"></i></button>
                <button type="button" class="btn btn-info btn-xs" onclick="word()">Word <i class="fa fa-file-word"></i></button>
                <button class="btn btn-success btn-xs" type="submit" >Export Excel <i class="fa fa-file-excel"></i></button>
                <button class="btn btn-warning btn-xs" type="button" onclick="download_pdf()">Download <i class="fa fa-file-pdf"></i></button>
              </div>
            

          </div>
        </form>
        <div id="tampil"></div>
      </div>
    </div>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->
</section>

<script >
  function download_pdf() {
    $.ajax({
      url : 'laporan/cetak_pdf',
      data : $('#form_lap').serialize()+'&act=P',
      type : 'post',
      dataType : 'json',
      success : function (respon) {
        $("#tampil").html(respon);
      }
    })
  }

  $(function () {
   $('.select2').select2();



 })


  function cetak() {
    $.ajax({
      url : 'laporan/laporan',
      data : $("#form_lap").serialize()+'&act=P',
      type : 'post',
      dataType : 'html',
      success : function (response) {
       var doc = window.open();
       doc.document.write(response);
       doc.print();
     }
   })
  }

 function word() {
    $.ajax({
      url : 'laporan/word',
      data : $('#form_lap').serialize()+'&act=w',
      type : 'post',
      dataType : 'json',
      success : function (respon) {
       $("#tampil").html(respon);
      }
    })
  }


  function sortir() {
    // event.preventDefault();
    $.ajax({
      url : "<?php echo site_url('laporan/laporan'); ?>",
      data : $("#form_lap").serialize()+'&act=V',
      dataType: "html",
      type: "POST",
      success : function (response) {
       $('#tampil').html(response);
     }
   })
  }
 //Date range picker
  $('.reservation').daterangepicker()

</script>

