<table class="table table-bordered" id="tbl_laptiket" border="1" cellspacing="0" cellpadding="5" width="100%">
		<thead class="bg-primary">
			<tr>
			<th>No</th>
			<th>Transaksi</th>
			<th>Tanggal</th>
			<th>Nama Barang</th>
			<th>Pelanggan</th>
			<th>Penyedia</th>
			<th>No. Batch</th>
			<th>NO. SBBK</th>
			<th>Awal</th>
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
			$sisa = $awal- $row->keluar;
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