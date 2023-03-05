
<!-- Main content -->
<section class="content" id="load_detail">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <div class="card card-default">
          <div class="card-header bg-success">
            <h3 class="card-title"> Peminjaman Alat</h3>
          </div>
          <div class="card-body">
            <form class="form" id="pinjam_alat" action="<?=base_url('laporan/lap_pinjam_xls') ?>" method="post">
              <div class="form-group row">
                <label class="aria-label col-sm-5">Range Tanggal</label>
                <div class="col-md-7">
                    <input type="text" class="form-control reservation" name="tgl">
                </div>
              </div>
              <div class="form-group row ">
                <label for="nama" class="col-sm-5 col-form-label">Ruang</label>
                <div class="col-sm-7 kosong">
                  <select class="form-control select2" name="id_ruang" >
                    <option value="" disabled="" selected="">Pilih Ruang</option>
                    <?php foreach ($ruang->result() as $r): ?>
                     <option value="<?=$r->id_ruang?>"><?php echo $r->nama_ruang; ?></option>
                   <?php endforeach ?>
                 </select>
               </div>
             </div>
             <div class="form-group row">
              <div class="form-group input-group-sm">
                <!-- <button type="button" class="btn btn-primary btn-xs" onclick="sortir()">Tampilkan</button> -->
                <!-- <button type="button" class="btn btn-primary btn-xs" onclick="reset()">Reset</button> -->
                <button type="button" class="btn btn-info " onclick="cetak_pinjam()">Cetak <i class="fa fa-print"></i></button>
                <!-- <button type="button" class="btn btn-info btn-xs" onclick="word()">Word <i class="fa fa-file-word"></i></button> -->
                <button class="btn btn-success" type="submit" >Export Excel <i class="fa fa-file-excel"></i></button>
                <button class="btn btn-warning " type="button" onclick="download_pdf_pinjam()">Download <i class="fa fa-file-pdf"></i></button>
              </div>
            </div>
          </form>
          <div id="tampil"></div>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
       <div class="card card-default">
          <div class="card-header bg-purple">
            <h3 class="card-title"> Pemakaian Bahan</h3>
          </div>
          <div class="card-body">
            <form class="form" id="pemakaian_bahan" action="<?=base_url('laporan/lap_pemakaian_bahan') ?>" method="post">
              <div class="form-group row">
                <label class="aria-label col-sm-5">Range Tanggal</label>
                <div class="col-md-7">
                    <input type="text" class="form-control reservation" name="tgl">
                </div>
              </div>
              <!-- <div class="form-group row ">
                <label for="nama" class="col-sm-5 col-form-label">Ruang</label>
                <div class="col-sm-7 kosong">
                  <select class="form-control select2" name="id_ruang" >
                    <option value="" disabled="" selected="">Pilih Ruang</option>
                    <?php foreach ($ruang->result() as $r): ?>
                     <option value="<?=$r->id_ruang?>"><?php echo $r->nama_ruang; ?></option>
                   <?php endforeach ?>
                 </select>
                 <span class="help-block"></span>
               </div>
             </div> -->
             <div class="form-group row">
              <div class="form-group input-group-sm">
                <!-- <button type="button" class="btn btn-primary btn-xs" onclick="sortir()">Tampilkan</button> -->
                <!-- <button type="button" class="btn btn-primary btn-xs" onclick="reset()">Reset</button> -->
                <button type="button" class="btn btn-info " onclick="cetak_pakai()">Cetak <i class="fa fa-print"></i></button>
                <!-- <button type="button" class="btn btn-info btn-xs" onclick="word()">Word <i class="fa fa-file-word"></i></button> -->
                <button class="btn btn-success" type="submit" >Export Excel <i class="fa fa-file-excel"></i></button>
                <button class="btn btn-warning " type="button" onclick="download_pdf_pakai()">Download <i class="fa fa-file-pdf"></i></button>
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
        <div class="card-header bg-primary">
          <h3 class="card-title"> Kerusakan Alat</h3>
        </div>
       <div class="card-body">
            <form class="form" id="kerusakan_alat" action="<?=base_url('laporan/lap_kerusakan_alat') ?>" method="post">
              <div class="form-group row">
                <label class="aria-label col-sm-5">Range Tanggal</label>
                <div class="col-md-7">
                    <input type="text" class="form-control reservation" name="tgl">
                </div>
              </div>
          
             <div class="form-group row">
              <div class="form-group input-group-sm">
                <!-- <button type="button" class="btn btn-primary btn-xs" onclick="sortir()">Tampilkan</button> -->
                <!-- <button type="button" class="btn btn-primary btn-xs" onclick="reset()">Reset</button> -->
                <button type="button" class="btn btn-info " onclick="cetak_kalat()">Cetak <i class="fa fa-print"></i></button>
                <!-- <button type="button" class="btn btn-info btn-xs" onclick="word()">Word <i class="fa fa-file-word"></i></button> -->
                <button class="btn btn-success" type="submit" >Export Excel <i class="fa fa-file-excel"></i></button>
                <button class="btn btn-warning " type="button" onclick="download_pdf_kalat()">Download <i class="fa fa-file-pdf"></i></button>
              </div>


            </div>
          </form>
          <div id="tampil"></div>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card card-default">
        <div class="card-header bg-cyan">
          <h3 class="card-title"> Kerusakan Bahan</h3>
        </div>
        <div class="card-body">
            <form class="form" id="kerusakan_bahan" action="<?=base_url('laporan/lap_kerusakan_bahan') ?>" method="post">
              <div class="form-group row">
                <label class="aria-label col-sm-5">Range Tanggal</label>
                <div class="col-md-7">
                    <input type="text" class="form-control reservation" name="tgl">
                </div>
              </div>
             
             <div class="form-group row">
              <div class="form-group input-group-sm">
                <!-- <button type="button" class="btn btn-primary btn-xs" onclick="sortir()">Tampilkan</button> -->
                <!-- <button type="button" class="btn btn-primary btn-xs" onclick="reset()">Reset</button> -->
                <button type="button" class="btn btn-info " onclick="cetak_kbahan()">Cetak <i class="fa fa-print"></i></button>
                <!-- <button type="button" class="btn btn-info btn-xs" onclick="word()">Word <i class="fa fa-file-word"></i></button> -->
                <button class="btn btn-success" type="submit" >Export Excel <i class="fa fa-file-excel"></i></button>
                <button class="btn btn-warning " type="button" onclick="download_pdf_kbahan()">Download <i class="fa fa-file-pdf"></i></button>
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
  function download_pdf_pinjam() {
    $.ajax({
      url : 'laporan/download_pdf_pinjam',
      data : $('#pinjam_alat').serialize(),
      type : 'post',
      dataType : 'json',
      success : function (respon) {
        $("#tampil").html(respon);
      }
    })
  }

    function download_pdf_pakai() {
    $.ajax({
      url : 'laporan/download_pdf_pakai_bahan',
      data : $('#pemakaian_bahan').serialize(),
      type : 'post',
      dataType : 'json',
      success : function (respon) {
        $("#tampil").html(respon);
      }
    })
  }

    function download_pdf_kalat() {
    $.ajax({
      url : 'laporan/download_pdf_kerusakan_alat',
      data : $('#kerusakan_alat').serialize(),
      type : 'post',
      dataType : 'json',
      success : function (respon) {
        $("#tampil").html(respon);
      }
    })
  }
function download_pdf_kbahan() {
    $.ajax({
      url : 'laporan/download_pdf_kerusakan_bahan',
      data : $('#kerusakan_bahan').serialize(),
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


  function cetak_pinjam() {
    $.ajax({
      url : 'laporan/cetak_pinjam_alat',
      data : $("#pinjam_alat").serialize(),
      type : 'post',
      dataType : 'html',
      success : function (response) {
       var doc = window.open();
       doc.document.write(response);
       doc.print();
     }
   })
  }


 function cetak_pakai() {
    $.ajax({
      url : 'laporan/cetak_pakai_bahan',
      data : $("#pemakaian_bahan").serialize(),
      type : 'post',
      dataType : 'html',
      success : function (response) {
       var doc = window.open();
       doc.document.write(response);
       doc.print();
     }
   })
  }

 function cetak_kalat() {
    $.ajax({
      url : 'laporan/cetak_kerusakan_alat',
      data : $("#kerusakan_alat").serialize(),
      type : 'post',
      dataType : 'html',
      success : function (response) {
       var doc = window.open();
       doc.document.write(response);
       doc.print();
     }
   })
  }

   function cetak_kbahan() {
    $.ajax({
      url : 'laporan/cetak_kerusakan_bahan',
      data : $("#kerusakan_bahan").serialize(),
      type : 'post',
      dataType : 'html',
      success : function (response) {
       var doc = window.open();
       doc.document.write(response);
       doc.print();
     }
   })
  }
 //Date range picker
 $('.reservation').daterangepicker()

</script>

