
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php $this->load->view('templates/header'); ?>
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/adminlte.min.css">
</head>
<body>
	<?php $apl = $this->db->get("aplikasi")->row();?>
	<center id="top">
		<div class="logo">
		</div>
		<div class="header">
			<h2><?php echo $apl->nama_owner; ?></h2>
			<h4><?php echo $apl->alamat ?></h4>
			<p><?php echo $apl->tlp." / ".$apl->email; ?></p>
		</div>
	</center>


	
	<table class="table" width="100%" cellspacing="5">
		<tr>
			<td >No SBBK</td>
			<td >:</td>
			<td ><?php echo $keluar->faktur; ?></td>
			<td >Tanggal</td>
			<td >:</td>
			<td ><?php echo tanggalindo($keluar->tanggal); ?></td>
		</tr>
		<tr>
			<td>Nama Pelanggan</td>
			<td>:</td>
			<td><?php echo $keluar->nama_pelanggan; ?></td>
			<td>Alamat</td>
			<td>:</td>
			<td><?php echo $keluar->alamat; ?></td>
		</tr>
		
	</table>
	
	<table class="table table-bordered" id="tbl_laptiket" border="1" cellspacing="0" cellpadding="5" width="100%">
		<thead class="bg-primary">
			<tr>
				<th>No</th>
				<th>Nama Barang</th>
				<th>Qty</th>
				<th>Satuan</th>
				<th>No. Batch</th>
				<th>Expired Date</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; foreach ($lap as $row): 
			?>
			<tr>
				<td><?=$no++;?></td>
				<td><?php echo $row->nama_barang; ?></td>
				<td><?php echo $row->jumlah; ?></td>
				<td><?php echo $row->nama_satuan; ?></td>
				<td><?php echo $row->nobatch; ?></td>
				<td><?php echo $row->ed; ?></td>
			</tr>
		<?php endforeach; ?>

	</tbody>
</table>
<br/>
<br/>
<table width="50%" align="left">
    <tr><td align="center">Yang Menyerahkan</td></tr>
    <tr><td align="center"><?php $jb1 = (isset($td1->jabatan)) ? $td1->jabatan : '-' ; echo $jb1; ?></td></tr>
    <tr><td align="center">&nbsp;</td></tr>
    <tr><td align="center">&nbsp;</td></tr> 
    <tr><td align="center">&nbsp;</td></tr>
    <tr><td align="center"> <u>&nbsp;&nbsp;&nbsp;<?php $nm1 = (isset($td1->nama)) ? $td1->nama : '-' ; echo $nm1; ?>&nbsp;&nbsp;&nbsp;</u> </td></tr>

</table>
<table width="50%" align="right">
    <tr><td align="center">Yang Menerima</td></tr>
     <tr><td align="center"><?php $jb2 = (isset($td2->jabatan)) ? $td2->jabatan : '-' ; echo $jb2; ?></td></tr>
    <tr><td align="center">&nbsp;</td></tr>
    <tr><td align="center">&nbsp;</td></tr> 
    <tr><td align="center">&nbsp;</td></tr>
    <tr><td align="center"> <u>&nbsp;&nbsp;&nbsp;<?php $nm2 = (isset($td2->nama)) ? $td2->nama : '-' ; echo $nm2; ?>&nbsp;&nbsp;&nbsp;</u> </td></tr>
</table>
<br>
<br>
<br>
<table  align="center">
    <tr><td align="center">Mengetahui</td></tr>
     <tr><td align="center"><?php $jb3 = (isset($td3->jabatan)) ? $td3->jabatan : '-' ; echo $jb3; ?></td></tr>
    <tr><td align="center">&nbsp;</td></tr>
    <tr><td align="center">&nbsp;</td></tr> 
    <tr><td align="center">&nbsp;</td></tr>
    <tr><td align="center"> <u>&nbsp;&nbsp;&nbsp;<?php $nm3 = (isset($td3->nama)) ? $td3->nama : '-' ; echo $nm3; ?>&nbsp;&nbsp;&nbsp;</u> </td></tr>
</table>
</body>
</html>