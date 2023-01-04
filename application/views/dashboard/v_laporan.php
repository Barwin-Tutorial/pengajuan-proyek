<?php 
$filename = 'Laporan_'.date("ymdhis");
header('Chace-Control: no-store, no-cache, must-revalation');
header('Chace-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="'.$filename.'.xls"');
 ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style type="text/css">
#tbl-lap thead tr th{
  text-align:center; vertical-align : middle;
}
.item {
  text-align:center; vertical-align : middle;
}
</style>
</head>
<body>

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
        
</body>
</html>