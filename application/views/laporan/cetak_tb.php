
	
	<table  border="1" cellspacing="0" cellpadding="5" width="100%">
    <thead class="bg-primary">
    	<tr >
    		<th >No.</th>
    		<th>NO. SBBK</th>
    		<th >Tanggal</th>
    		<th >Penyedia</th>
    		<th >Nama Barang</th>
    		<th >Satuan</th>
    		<th>Ed</th>
    		<th>No Batch</th>
    		<th >Jumlah</th>
    		<th >Harga</th>
    		<th >Subtotal</th>
    	</tr>
    </thead>
		<tbody>
			<?php $no=1; foreach ($lap->result() as $row): 
				$subt= ($row->harga*$row->jumlah);
			?>
				<tr>
					<td><?=$no++;?></td>
					<td><?php echo $row->faktur; ?></td>
					<td><?php echo date("d/m/Y", strtotime($row->tanggal)); ?></td>
					<td><?php echo $row->nama_supplier; ?></td>
					<td><?php echo $row->nama_barang; ?></td>
					<td><?php echo $row->nama_kemasan; ?></td>
					<td><?php echo $row->ed; ?></td>
					<td><?php echo $row->nobatch; ?></td>
					<td><?php echo $row->jumlah; ?></td>
					<td><?php echo rupiah($row->harga); ?></td>
					<td><?php echo rupiah($subt); ?></td>
					
					
				</tr>
			<?php endforeach; ?>
			
		</tbody>
	</table>
