<?php $level = $this->session->userdata['id_level']; ?>
<style type="text/css">
  .box-text {
    flex-wrap: wrap !important; font-size: 10px;
  }
  .bx-info {
    min-height: 40px !important;
  }
</style>
<!-- Main content -->
<section class="content">
 <div class="container-fluid">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-purple">
        <div class="inner">
          <h3><?php echo $dok; ?></h3>

          <p>Total Dokumentasi Proyek</p>
        </div>
        <div class="icon">
          
        </div>
        <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
      </div>
    </div>
    <!-- ./col -->
     <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3><?php echo $blm_acc; ?></h3>

          <p>Proyek Belum di beri keputusan</p>
        </div>
        <div class="icon">
          <i class="fas fa-bottle"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3><?php echo $total_acc; ?></h3>

          <p>Proyek Telah di setujui</p>
        </div>
        <div class="icon">
          <i class="fas fa-bottle"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3><?php echo $total_anggaran; ?></h3>

          <p>Total Dokumen Anggaran</p>
        </div>
        <div class="icon">
          <i class="fas fa-bottle"></i>
        </div>
      </div>
    </div>
   
  </div>
    <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3><?php echo $total_tolak; ?></h3>

          <p>Total Proyek Di Tolak</p>
        </div>
        <div class="icon">
          <i class="fas fa-bottle"></i>
        </div>
      </div>
      </div>
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-pink">
        <div class="inner">
          <h3><?php echo $total_laporan; ?></h3>

          <p>Laporan Bulan Ini</p>
        </div>
        <div class="icon">
          <i class="fas fa-bottle"></i>
        </div>
      </div>
    </div>
   
    </div>
  </div>
</div>


</section>

