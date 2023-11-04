<?php 
$date=explode(" - ", $tgl);
$p1=date("Y-m-d", strtotime($date[0]));
$p2=date("Y-m-d", strtotime($date[1])); 

?>
<!-- <link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/adminlte.min.css"> -->
<center>
    <h4>LAPORAN PROYEK</h4>
    <p>Periode : <?php echo tanggalindo($p1).' S/D '.tanggalindo($p2); ?></p>
</center>
<table cellspacing="0" width="100%" border="1">
    <thead class="bg-purple">
        <tr >
            <th >No.</th>
            <th style="text-align:left;  ">Nama Proyek</th>
            <th style="text-align:left;  ">Dokumen</th>
            <th style="text-align:left;  ">Diupload Oleh</th>
            <th style="text-align:left;  ">Anggaran</th>
            <th style="text-align:left;  ">Diupload Oleh</th>
            <th style="text-align:left;  ">Keterangan</th>
            <th style="text-align:left;  ">Pemberi Keputusan</th>
            <th style="text-align:left;  ">Tanggal Diajukan</th>
            <th style="text-align:left;  ">Tanggal Keputusan</th>
            <th style="text-align:left;  ">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; 
        foreach ($lap as $row): 
             if ($row->status=='1') {
                $status ='Diajukan';
            }elseif ($row->status=='2') {
                $status ='Disetujui';
            }elseif ($row->status=='3') {
                $status ='Ditolak';
            }else{
                $status ='Proses';
            }
            ?>
            <tr>
                <td style="text-align:center; "><?=$no++;?></td>
                <td><?php echo $row->judul; ?></td>
                <td><?php echo $row->upload; ?></td>
                <td><?php echo $row->user_upload; ?></td>
                <td><?php echo $row->upload1; ?></td>
                <td><?php echo $row->pengaju; ?></td>
                

                <td><?php echo $row->keterangan; ?></td>
                <td><?php echo $row->setuju; ?></td>
                <td><?php echo $row->tgl_diajukan; ?></td>
                <td><?php echo $row->tgl_setuju; ?></td>
                <td><?php echo $status; ?></td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>