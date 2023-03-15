<?php $level = $this->session->userdata['id_level']; ?>
<!-- Main content -->
<section class="content">
 <div class="container-fluid">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-purple">
        <div class="inner">
          <h3><?php echo $jml_alat; ?></h3>

          <p>Alat</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3><?php echo $jml_bahan; ?></h3>

          <p>Bahan</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
      </div>
    </div>
    <?php if ($level=='6' || $level=='9'): ?>


      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-indigo">
          <div class="inner">
            <h3><?php echo $jml_pinjam; ?></h3>

            <p>Peminjam</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?php echo $jml_pemakai_bahan; ?></h3>

            <p>Bahan Keluar</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
      </div>

    <?php endif ?>
    <?php if ($level!='6' && $level!='9'): ?>


      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-indigo">
          <div class="inner">
            <h3><?php echo $jml_rusak; ?></h3>

            <p>Alat Rusak</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?php echo $jml_perbaikan; ?></h3>

            <p>Perbaikan Alat</p>
          </div>
          <div class="icon">
            <i class="ion ion-hammer"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
      </div>

    <?php endif ?>
    <!-- ./col -->
  </div>
</div>

</section>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">

       <!-- BAR CHART -->
       <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Peminjaman</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="pinjam" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </div>
    <div class="col-md-6">
      <!-- BAR CHART -->
      <div class="card card-purple">
        <div class="card-header">
          <h3 class="card-title">Pengembalian</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="kembali" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </div>
</div>
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">

       <!-- BAR CHART -->
       <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">Alat</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="alat" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </div>
    <div class="col-md-6">
      <!-- BAR CHART -->
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">Bahan</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="bahan" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </div>
</div>
</section>
<script type="text/javascript">
  $(function () {
    pinjam();
    kembali();
    chart_alat();
    chart_bahan()
  })

  function pinjam() {
    $.ajax({
      url : 'dashboard/chart_peminjaman',
      dataType:'json',
      type : 'post',
      success : function (respon) {
        let label = [];
        let value = [];
        var bln = ["Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        $.each(respon,function (index, data) {
          bl = (data.bulan-1);
          label.push(bln[bl]);
          value.push(data.total);
        });
        

        var ChartData = {
          labels  : label,
          
          datasets: [
          {
            label               : 'Peminjaman',
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : value
          }
          ]
        }

         //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#pinjam').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, ChartData)


    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false,
      hover: {
        mode: 'label',
      },
      tooltips: {
        enabled: true,
        callbacks: {
          label: function(tooltipItem, data) {
            var label = 'Dipinjam';
            var val = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
            return label + ' : ' + val;
          }
        }

      }
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      options: barChartOptions
    })
  }
})
  }
  function kembali() {
    $.ajax({
      url : 'dashboard/chart_pengembalian',
      dataType:'json',
      type : 'post',
      success : function (respon) {
        let label = [];
        let value = [];
        var bln = ["Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        $.each(respon,function (index, data) {
          bl = (data.bulan-1);
          label.push(bln[bl]);
          value.push(data.total);
        });
        

        var ChartData = {
          labels  : label,
          
          datasets: [
          {
            label               : 'Pengembalian',
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : value
          }
          ]
        }

         //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#kembali').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, ChartData)


    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false,
      hover: {
        mode: 'label',
      },
      tooltips: {
        enabled: true,
        callbacks: {
          label: function(tooltipItem, data) {
            var label = 'Dikembalikan';
            var val = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
            return label + ' : ' + val;
          }
        }

      }
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      options: barChartOptions
    })
  }
})
  }

  function chart_alat() {
    $.ajax({
      url : 'dashboard/chart_alat',
      dataType:'json',
      type : 'post',
      success : function (respon) {
        let label = [];
        let value = [];
        var bln = ["Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        $.each(respon,function (index, data) {
          bl = (data.bulan-1);
          label.push(bln[bl]);
          value.push(data.total);
        });
        

        var ChartData = {
          labels  : label,
          
          datasets: [
          {
            label               : 'Alat',
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : value
          }
          ]
        }

         //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#alat').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, ChartData)


    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false,
      hover: {
        mode: 'label',
      },
      tooltips: {
        enabled: true,
        callbacks: {
          label: function(tooltipItem, data) {
            var label = 'Total Alat';
            var val = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
            return label + ' : ' + val;
          }
        }

      }
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      options: barChartOptions
    })
  }
})
  }


  function chart_bahan() {
    $.ajax({
      url : 'dashboard/chart_bahan',
      dataType:'json',
      type : 'post',
      success : function (respon) {
        let label = [];
        let value = [];
        var bln = ["Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        $.each(respon,function (index, data) {
          bl = (data.bulan-1);
          label.push(bln[bl]);
          value.push(data.total);
        });
        

        var ChartData = {
          labels  : label,
          
          datasets: [
          {
            label               : 'Bahan',
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : value
          }
          ]
        }

         //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#bahan').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, ChartData)


    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false,
      hover: {
        mode: 'label',
      },
      tooltips: {
        enabled: true,
        callbacks: {
          label: function(tooltipItem, data) {
            var label = 'Total Bahan';
            var val = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
            return label + ' : ' + val;
          }
        }

      }
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      options: barChartOptions
    })
  }
})
  }
</script>