<?php 
$date=explode(" - ", $tgl);
$p1=date("Y-m-d", strtotime($date[0]));
$p2=date("Y-m-d", strtotime($date[1])); 

?>
<link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/adminlte.min.css">
<center>
	<h4>LAPORAN KERUSAKAN ALAT</h4>
	<p>Periode : <?php echo $p1.' S/D '.$p2; ?></p>
</center>
<table class="table table-bordered table-sm nowrap" >
	<thead class="bg-purple">
		<tr >
			<th >No.</th>
			
			<th style="text-align:left;  ">Barcode</th>
			<th style="text-align:left;  ">Nama Alat</th>
			<th style="text-align:left;  ">Vol</th>
			<th style="text-align:left;  ">Satuan</th>
			<th style="text-align:left;  ">Kondisi</th>
			<th style="text-align:left;  ">Foto</th>
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
				<td><?php echo $row->nama_alat; ?></td>
				<td><?php echo $row->stok_out; ?></td>
				<td><?php echo $row->nama_satuan; ?></td>
				<td><?php echo $row->kondisi; ?></td>
				<td><img  src="<?php echo base_url(); ?>/assets/foto/kerusakan_alat/<?=$row->foto?>" width="50px" height="50px"/></td>
				<td><?php echo $row->tgl_input; ?></td>
				<td><?php echo $row->keterangan; ?></td>


			</tr>
		<?php endforeach; ?>

	</tbody>
</table>