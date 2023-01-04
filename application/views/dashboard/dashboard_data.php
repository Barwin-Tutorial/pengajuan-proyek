<style type="text/css">
#tbl-lap thead tr th{
  text-align:center; vertical-align : middle;
}
.item {
  text-align:center; vertical-align : middle;
}
</style>

<?php if ($level=='1'): ?>
  

<!-- Main content -->
<section class="content">
  <div class="container-fluid">

    <div class="card">

      <!-- /.card-header -->
      <div class="card-body">
        <form class="form" id="form_lap" action="<?php echo base_url('dashboard/lap_excel') ?>" method="post">
          <div class=" row">
            <div class="col-sm-3">
              <div class="form-group">
                <input type="text" class="form-control  " name="tanggal" id="range">
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <select class="form-control select2 " style="width: 100%; height: 100%;" name="gudang">
                  <option selected="selected" disabled="">Pilih Gudang</option>
                  <?php foreach ($gudang->result() as $r): ?>
                    <option value="<?=$r->id?>"><?php echo $r->nama ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4">
              <div class="form-group input-group-sm">
                <button type="button" class="btn btn-success " onclick="sortir()">Tampilkan</button>
                <button  class="btn btn-primary " type="submit">Eksport</button>
              </div>
            </div>

          </div>
        </form>
        <div id="tampil">
          <table class="table table-bordered table-sm" id="tbl-lap">
            <thead class="bg-success">
              <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Gudang</th>
                <th rowspan="2">Stok Awal</th>
                <th colspan="2">Barang</th>
                <th colspan="2">Pengembalian Barang</th>
                <th rowspan="2">Stok Akhir</th>
              </tr>
              <tr>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Masuk</th>
                <th>Keluar</th>
              </tr>
            </thead>
            <tbody id="lap_detail">
              <?php $no=1; foreach ($list->result() as $row): 
                $tanggal = date("Y-m-d H:i:s");
                $a = $this->Mod_dashboard->stokawal($row->id_gudang, $tanggal);
                $awal = (isset($a->awal)) ? $a->awal : '0' ;

                $b = $this->Mod_dashboard->stokakhir($row->id_gudang, $tanggal);
                $sisa = (isset($b->sisa)) ? $b->sisa : '0' ;

                $c = $this->Mod_dashboard->pmasuk($row->id_gudang, $tanggal);
                $pmasuk = (isset($c->pmasuk)) ? $c->pmasuk : '0' ;

                $d = $this->Mod_dashboard->pkeluar($row->id_gudang, $tanggal);
                $pkeluar = (isset($d->pkeluar)) ? $d->pkeluar : '0' ;
                ?>
                <tr>
                  <td class="item"><?php echo $no++; ?></td>
                  <td> <?php echo $row->namagudang ?> </td>
                  <td class="item"><?php echo $awal ?></td>
                  <td class="item"><?php echo $row->masuk ?></td>
                  <td class="item"><?php echo $row->keluar ?></td>
                  <td class="item"><?php echo $pmasuk ?></td>
                  <td class="item"><?php echo $pkeluar ?></td>
                  <td class="item"><?php echo $sisa ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</section>
<script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
  $('#range').daterangepicker()

  function sortir() {
    $.ajax({
      url : "<?php echo site_url('dashboard/laporan'); ?>",
      data : $("#form_lap").serialize(),
      dataType: "html",
      type: "POST",
      success : function (response) {
       $('#tampil').html(response);
       $("#tbl-lap").DataTable({
        "responsive": false,
        "autoWidth": false,

      });
     }
   })
  }
  $(document).ready(function () {
    $("#tbl-lap").DataTable({
      "responsive": false,
      "autoWidth": false,

    });


  })
</script>
<?php endif ?>