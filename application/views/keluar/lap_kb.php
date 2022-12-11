
<!-- Main content -->
<section class="content" id="load_detail">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header bg-light">
                <h3 class="card-title"><i class="fa fa-list text-blue"></i> Laporan Keluar Barang</h3>
            </div>
            <div class="card-body">
                <form class="form" id="form_lap" action="<?php echo base_url('laporan/lap_tiket_excel') ?>" method="post">
                <div class="row">
                    <!-- <div class="col-md-4">
                        <div class="input-group input-group-sm">
                            <label class="aria-label col-md-3">TRIP</label>
                            <div class="col-md-9">
                            <select class="form-control select2 form-control-sm" name="trip" id="trip">
                                <option value="all">Semua</option>
                                <?php 
                                foreach ($trip as $tr):
                                    echo "<option value='$tr->id_trip' >$tr->kode_trip</option>";
                                endforeach; ?>
                            </select>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-md-4">
                        <div class="input-group input-group-sm">
                            <label class="col-md-5">Sortir Tanggal</label>
                            <input type="text" class="form-control  float-right form-control-sm" name="tgl" id="reservation">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group input-group-sm">
                            <button type="button" class="btn btn-primary btn-xs" onclick="sortir()">Sortir</button>
                            <button class="btn btn-success btn-xs" type="submit" >Download <i class="fa fa-file-excel"></i></button>
                            <button class="btn btn-warning btn-xs" type="button" onclick="download_pdf()">Download <i class="fa fa-file-pdf"></i></button>
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
$(document).ready(function(){
  var url = "<?php echo site_url('lapkhusus/laporan'); ?>";
  $("#tampil").load(url);
});

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
        url : "<?php echo site_url('lapkhusus/lap_tiket'); ?>",
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

