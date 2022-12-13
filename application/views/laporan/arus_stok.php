
<!-- Main content -->
<section class="content" id="load_detail">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header bg-light">
                <h3 class="card-title"><i class="fa fa-list text-blue"></i> Laporan Arus Stok</h3>
            </div>
            <div class="card-body">
                <form class="form" id="form_lap" action="<?php echo base_url('arus_stok/laporan_xls') ?>"  method="post">
               <div class="row">
                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <label class="col-md-6">Range Tanggal</label>
                            <input type="text" class="form-control  float-right form-control-sm" name="tanggal" id="arus_stok">
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <label class="col-md-6">Barang</label>
                            <input type="text" class="form-control  float-right form-control-sm" name="vbarang" id="vbarang" placeholder="Barcode / Nama Barang">
                            <input type="hidden" class="form-control  float-right form-control-sm" name="id_barang" id="id_barang">
                        </div>
                    </div>
                  </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group input-group-sm">
                            <label class="aria-label col-md-6">Perundangan</label>
                            <select class="form-control select2 form-control-sm" name="perundangan" id="perundangan">
                                <option value="all">Semua</option>
                                <?php 
                                foreach ($perundangan->result() as $tr):
                                    echo "<option value='$tr->id' >$tr->nama</option>";
                                endforeach; ?>
                            </select>
                        </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-4">
                        <div class="form-group input-group-sm">
                            <button type="button" class="btn btn-primary btn-xs" onclick="sortir()">Tampilkan</button>
                             <button type="button" class="btn btn-primary btn-xs" onclick="resett()">Reset</button>
                              <button type="button" class="btn btn-primary btn-xs" onclick="cetak()">Cetak</button>
                            <button type="submit" class="btn btn-success btn-xs"  >Export Excel <i class="fa fa-file-excel"></i></button>
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
   $(function () {
       $('.select2').select2();
         
   })
function export_excel() {
  window.open("arus_stok/laporan_xls");
  /*$.ajax({
        url : "arus_stok/laporan_xls",
        data : $("#form_lap").serialize(),
        dataType: "html",
        type: "POST",
        success : function (response) {
           $('#tampil').html(response);
        }
    })*/
}

function download_pdf() {
  $.ajax({
        url : "<?php echo site_url('arus_stok/lap_pdf'); ?>",
        data : $("#form_lap").serialize(),
        dataType: "JSON",
        type: "POST",
        success : function (response) {
           $('#tampil').html(response);
        }
    })
}

    $( "#vbarang").autocomplete({
        source: 'arus_stok/get_brg/?', 
        select : function (event, ui) {
        $("#vbarang").val(ui.item.label); // display the selected text
        $("#id_barang").val(ui.item.id_barang); // save selected id to hidden input
        return false;

    }
    })

function sortir() {
    // event.preventDefault();
    $.ajax({
        url : "arus_stok/laporan",
        data : $("#form_lap").serialize(),
        dataType: "html",
        type: "POST",
        success : function (response) {
           $('#tampil').html(response);
        }
    })
}
 //Date range picker
    $('#arus_stok').daterangepicker({
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

