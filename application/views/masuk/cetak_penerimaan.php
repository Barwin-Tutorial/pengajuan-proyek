
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
            <td >NO. SBBK</td>
            <td >:</td>
            <td ><?php echo $tb->faktur; ?></td>
            <td >Tanggal</td>
            <td >:</td>
            <td ><?php echo tanggalindo($tb->tanggal); ?></td>
        </tr>
        <tr>
            <td>Nama Supplier</td>
            <td>:</td>
            <td><?php echo $tb->nama_supplier; ?></td>
            <td>Alamat</td>
            <td>:</td>
            <td><?php echo $tb->alamat; ?></td>
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
<table width="50%" align="right">
    <tr><td align="center">Pemberi</td></tr>
    <tr><td align="center">&nbsp;</td></tr>
    <tr><td align="center">&nbsp;</td></tr>
    <tr><td align="center">&nbsp;</td></tr>
    <tr><td align="center">( ...................................... )</td></tr>
</table>
<table width="50%" align="left">
    <tr><td align="center">Penerima</td></tr>
    <tr><td align="center">&nbsp;</td></tr>
    <tr><td align="center">&nbsp;</td></tr>
    <tr><td align="center">&nbsp;</td></tr>
    <tr><td align="center">( ...................................... )</td></tr>
</table>

</body>
</html>