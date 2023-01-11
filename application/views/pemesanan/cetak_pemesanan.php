
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
            <address><?php echo $apl->alamat ?><br><?php echo $apl->tlp." / ".$apl->email; ?></address>
        </div>
    </center>

    <hr>
    <div class="row">
        <div class="col-12">
        <h4>No SP : <?php echo $tb->nosp; ?></h4>
        </div>
    </div>
    <h4>Kepada Yth :</h4>
    <strong><?php echo $tb->nama_supplier; ?></strong>
    <address><?php echo $tb->alamat; ?></address>
    <br>
    <div class="col-sm-6 invoice-col">
        <address>
            Dengan Hormat,
            <br>
            Mohon dikirim Obat-obatan Untuk keperluan Kami Sebagai Berikut :
        </address>

    </div>
    
    
   <!--  <table class="table" width="100%" cellspacing="5">

        <tr>
            <td >NO. SP</td>
            <td >:</td>
            <td ><?php echo $tb->nosp; ?></td>
            <td >Tanggal</td>
            <td >:</td>
            <td ><?php echo tanggalindo($tb->tanggal); ?></td>
        </tr>
        <tr>
            <td>Penyedia</td>
            <td>:</td>
            <td><?php echo $tb->nama_supplier; ?></td>
            <td>Alamat</td>
            <td>:</td>
            <td><?php echo $tb->alamat; ?></td>
        </tr>
        
    </table> -->
    <hr>
    <table class="table table-bordered" id="tbl_laptiket" border="1" cellspacing="0" cellpadding="5" width="100%">
        <thead class="bg-primary">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach ($lap as $row): 
            ?>
            <tr>
                <td><?=$no++;?></td>
                <td><?php echo $row->nama_barang; ?></td>
                <td><?php echo $row->nama_satuan; ?></td>
                <td><?php echo $row->jumlah; ?></td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>
<br/>
<br/>
<table width="50%" align="left">
    <tr><td align="center">Mengetahui</td></tr>
    <tr><td align="center"><?php $jb1 = (isset($td1->jabatan)) ? $td1->jabatan : '-' ; echo $jb1; ?></td></tr>
    <tr><td align="center">&nbsp;</td></tr>
    <tr><td align="center">&nbsp;</td></tr> 
    <tr><td align="center">&nbsp;</td></tr>
    <tr><td align="center"> <u>&nbsp;&nbsp;&nbsp;<?php $nm1 = (isset($td1->nama)) ? $td1->nama : '-' ; echo $nm1; ?>&nbsp;&nbsp;&nbsp;</u> </td></tr>
</table>
<table width="50%" align="right">
    <tr><td align="center">Penyedia Obat</td></tr>
     <tr><td align="center"><?php $jb2 = (isset($td2->jabatan)) ? $td2->jabatan : '-' ; echo $jb2; ?></td></tr>
    <tr><td align="center">&nbsp;</td></tr>
    <tr><td align="center">&nbsp;</td></tr> 
    <tr><td align="center">&nbsp;</td></tr>
    <tr><td align="center"> <u>&nbsp;&nbsp;&nbsp;<?php $nm2 = (isset($td2->nama)) ? $td2->nama : '-' ; echo $nm2; ?>&nbsp;&nbsp;&nbsp;</u> </td></tr>
</table>

</body>
</html>