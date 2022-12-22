<?php 
if ($act =="xls") {
$filename = 'Arus_stok_'.date("ymdhis");
header('Chace-Control: no-store, no-cache, must-revalation');
header('Chace-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="'.$filename.'.xls"');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>export</title>
</head>
<body>
	<!-- <?php if ($act =="pdf" || $act =="xls") {?>
		<table class="table" width="100%">
		<tr>
			<td >Tanggal</td>
			<td >:</td>
			<td ><?php echo tanggalindo(date("Y-m-d")); ?></td>
			<td >Kode Trip</td>
			<td >:</td>
			<td ><?php echo $trip->kode_trip; ?></td>
		</tr>
		<tr>
			<td>Hari</td>
			<td>:</td>
			<td><?php echo hari(date("Y-m-d")); ?></td>
			<td>Waktu</td>
			<td>:</td>
			<td><?php echo $trip->jam_berangkat; ?></td>
		</tr>
		<tr>
			<td>Keberangkatan</td>
			<td>:</td>
			<td><?php echo $trip->keberangkatan; ?></td>
			<td>Tujuan</td>
			<td>:</td>
			<td><?php echo $trip->kedatangan; ?></td>
		</tr>
		<tr>
			<td>Petugas Loket</td>
			<td>:</td>
			<td><?php echo $trip->petugas; ?></td>
		</tr>
	</table>
<?php } ?> -->
	<table class="table table-bordered" id="tbl_laptiket" border="1" cellspacing="0" cellpadding="5" width="100%">
		<thead class="bg-primary">
			<tr>
			<th>No</th>
			<th>Transaksi</th>
			<th>Tanggal</th>
			<th>Nama Barang</th>
			<th>Pelanggan</th>
			<th>Supplier</th>
			<th>No. Batch</th>
			<th>Faktur</th>
			<td>Awal</td>
			<th>Masuk</th>
			<th>Keluar</th>
			<th>Sisa</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; foreach ($lap->result() as $row): 
			$tanggal = $row->tanggal;
			$id_barang = $row->id_barang;
			$a= $this->db->select('(sum(masuk)-sum(keluar)) as awal, (sum(masuk)-sum(keluar)) as sisa');
			$a= $this->db->where('id_barang',$id_barang);
			$a= $this->db->where('date(tanggal) <',$tanggal);
			$a= $this->db->get('stok_opname')->row();

			$awal = (isset($a->awal)) ? $a->awal : '0' ;
			$sisa = $awal-$row->keluar ;

			?>
				<tr>
					<td><?=$no++;?></td>
					<td><?php echo $row->transaksi; ?></td>
					<td><?php echo date("d/m/Y", strtotime($row->tanggal)); ?></td>
					<td><?php echo $row->nama_barang; ?></td>
					<td><?php echo $row->nama_pelanggan; ?></td>
					<td><?php echo $row->nama_supplier; ?></td>
					<td><?php echo $row->nobatch; ?></td>
					<td><?php echo $row->faktur; ?></td>
					<td><?php echo $awal; ?></td>
					<td><?php echo $row->masuk; ?></td>
					<td><?php echo $row->keluar; ?></td>
					<td><?php echo $sisa; ?></td>
					
					
				</tr>
			<?php endforeach; ?>
			
		</tbody>
	</table>
	<script type="text/javascript">
		$(document).ready(function () {
			$("#tbl_laptiket").DataTable({
				"responsive": true,
				"autoWidth": false,
			});
		})
		function detail(tgl) {
			$.ajax({
				url : "<?php echo site_url('lapelnusa/lap_pendapatan') ?>",
				data : {tgl:tgl},
				dataType : 'html',
				type : 'POST',
				success : function(html){
					$("#load_detail").html(html);
				}
			});
		}
	</script>
</body>
</html>