
<!-- Main content -->
<section class="content" id="load_detail">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header bg-light">
        <h3 class="card-title"><i class="fa fa-list text-blue"></i> Laporan Barang Expired</h3>
        <div class="text-right">
          <a href="<?php echo base_url('expired/lap_expired_xls') ?>" type="button" class="btn btn-sm btn-outline-primary "  title="Export Excel" ><i class="fas fa-file-excel" ></i> Export Excel</a>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
        <div class="bg-danger" style="width: 2rem;"></div>Expired
        <div class="bg-warning" style="width: 2rem;"></div>Expired memasuki 3 bulan
        <div class="bg-success" style="width: 2rem;"></div>Expired memasuki 6 bulan
        </div>
        <table class="table table-bordered table-sm" id="tbl_stok" border="1" cellspacing="0" cellpadding="5" width="100%">
          <thead class="bg-primary">
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th>ED</th>
              <th>BATCH</th>
              <th>Sisa</th>
              <th>Berat</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; 
            foreach ($lap->result() as $row): 
              $sekarang = date("Y-m-d");
              $var1     = mktime(0, 0, 0, date("m")+3, date("d"), date("Y"));
              $tiga_bln = date("Y-m-d", $var1);
              $var2     = mktime(0, 0, 0, date("m")+6, date("d"), date("Y"));
              $enam_bln = date("Y-m-d", $var2);
              if (($row->ed > $sekarang) and ($row->ed <= $tiga_bln)) {
                $bg = "bg-warning";
              }else if (($row->ed > $sekarang) and ($row->ed <= $enam_bln)) {
                $bg = "bg-success";
              }else if ($row->ed <= $sekarang) {
                $bg = "bg-danger";
              } else {
                $bg = "";
              }
            ?>
            <tr class="<?=$bg?>">
              <td><?=$no++;?></td>
              <td><?php echo $row->nama_barang; ?></td>
              <td><?php echo date("d/m/Y", strtotime($row->ed)); ?></td>
              <td><?php echo $row->nobatch; ?></td>
              <td><?php echo $row->sisa; ?></td>
              <td><?php echo $row->berat; ?></td>

            </tr>
          <?php endforeach; ?>

        </tbody>
      </table>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
</section>

<script >
 $(function () {
   $('.select2').select2();
   $("#tbl_stok").DataTable({
        "responsive": true,
        "autoWidth": false,
      })
 })


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

