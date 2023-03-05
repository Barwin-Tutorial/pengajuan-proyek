<?php 
$date=explode(" - ", $tgl);
$p1=date("Y-m-d", strtotime($date[0]));
$p2=date("Y-m-d", strtotime($date[1])); 

?>
<link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/adminlte.min.css">
<center>
	<h4>LAPORAN PEMAKAIAN BAHAN</h4>
	<p>Periode : <?php echo $p1.' S/D '.$p2; ?></p>
</center>
<table class="table table-bordered table-sm nowrap" >
	<thead class="bg-purple">
		<tr >
			<th >No.</th>
			
			<th style="text-align:left;  ">Barcode</th>
			<th style="text-align:left;  ">Nama Alat</th>
			<th style="text-align:left;  ">Nama Pengguna</th>
			<th style="text-align:left;  ">Jabatan</th>
			<th style="text-align:left;  ">Vol</th>
			<th style="text-align:left;  ">Satuan</th>
			<th style="text-align:left;  " >Tanggal Input</th>
			<th style="text-align:left;  ">Keterangan</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1; 
		foreach ($lap as $row): 
			?>
			<tr>
				<td style="text-align:center; vertical-align : middle; "><?=$no++;?></td>
				
				<td><?php echo $row->barcode; ?></td>
				<td><?php echo $row->nama_bahan; ?></td>
				<td><?php echo $row->nama; ?></td>
				<td><?php echo $row->nama_jabatan; ?></td>
				<td><?php echo $row->stok_out; ?></td>
				<td><?php echo $row->nama_satuan; ?></td>
				<td><?php echo $row->tgl_out; ?></td>
				<td><?php echo $row->keterangan; ?></td>


			</tr>
		<?php endforeach; ?>

	</tbody>
</table>