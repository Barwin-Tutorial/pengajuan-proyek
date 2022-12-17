  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">

          <!-- PIE CHART -->
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">10 Obat Terlaris</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group row ">
                <!-- <label for="nama" class="col-sm-2 col-form-label">Perundangan</label> -->
                <div class="col-sm-4 kosong">

                  <select class="form-control form-control-sm" name="perundangan" >
                    <option value="">Pilih Perundangan</option>
                    <?php 
                    foreach ($perundangan as $row){
                      ?>
                      <option value="<?=$row->id?>"><?php echo $row->nama; ?></option>
                    <?php } ?>
                  </select>
                  
                </div>
                <div class="col-sm-4">
                  <input type="date" class="form-control form-control-sm" name="tanggal" value="<?=date("Y-m-d")?>">
                </div>
                <button  class="btn btn-sm btn-success" style="width: 10em" onclick="filter()" ><i class="fa fa-filter"></i>Filter</button>
              </div>
            </div>
            <div class="card-body">
              <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <div class="col-md-6">
          <!-- PIE CHART -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Pelanggan Dengan Jumlah Permintaan Terbanyak</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
              </div>
            </div>
             <div class="card-body">
              <div class="form-group row ">
                <div class="col-sm-4">
                  <input type="date" class="form-control form-control-sm" name="tgl" value="<?=date("Y-m-d")?>">
                </div>
                <button  class="btn btn-sm btn-success" style="width: 10em" onclick="filter_pel()" ><i class="fa fa-filter"></i>Filter</button>
              </div>
            </div>
            <div class="card-body">
              <canvas id="pieChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
      </div>
    </div>
  </section>
  <script type="text/javascript">


    function filter() {
      var id=$('[name="perundangan"]').val();
      var tgl=$('[name="tanggal"]').val();
      $.ajax({
        url : 'grafik/terlaris',
        data : {id:id,tgl:tgl},
        dataType:'json',
        type : 'post',
        success : function (respon) {
          let label = [];
          let value = [];
          $.each(respon,function (index, data) {
            label.push(data.nama);
            value.push(data.total);
          });

          var donutData        = {
            labels: label,
            datasets: [
            {
              data: value,
              backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }
            ]
          }
          var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
          var pieData        = donutData;
          var pieOptions     = {
            maintainAspectRatio : false,
            responsive : true,
          }

    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions      
    })
  }

})
    }

    function filter_pel() {
      var tgl=$('[name="tgl"]').val();
      $.ajax({
        url : 'grafik/chart_pelanggan',
        data : {tgl:tgl},
        dataType:'json',
        type : 'post',
        success : function (respon) {
          let label = [];
          let value = [];
          $.each(respon,function (index, data) {
            label.push(data.nama);
            value.push(data.total);
          });

          var donutData        = {
            labels: label,
            datasets: [
            {
              data: value,
              backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }
            ]
          }
          var pieChartCanvas = $('#pieChart1').get(0).getContext('2d')
          var pieData        = donutData;
          var pieOptions     = {
            maintainAspectRatio : false,
            responsive : true,
          }

    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions      
    })
  }

})
    }

    $(document).ready(function () {
       var id=$('[name="perundangan"]').val();
      var tgl=$('[name="tanggal"]').val();
      $.ajax({
        url : 'grafik/terlaris',
        data : {id:id,tgl:tgl},
        dataType:'json',
        type : 'post',
        success : function (respon) {
          let label = [];
          let value = [];
          $.each(respon,function (index, data) {
            label.push(data.nama);
            value.push(data.total);
          });

          var donutData        = {
            labels: label,
            datasets: [
            {
              data: value,
              backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }
            ]
          }
          var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
          var pieData        = donutData;
          var pieOptions     = {
            maintainAspectRatio : false,
            responsive : true,
          }

    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions      
    })
  }

})

      //Chart Permintaan Pelanggan Terbanyak
     let tglp=$('[name="tgl"]').val();
      $.ajax({
        url : 'grafik/chart_pelanggan',
        dataType:'json',
        data : {tgl:tglp},
        type : 'post',
        success : function (respon) {
          let label = [];
          let value = [];
          $.each(respon,function (index, data) {
            label.push(data.nama);
            value.push(data.total);
          });

          var donutData        = {
            labels: label,
            datasets: [
            {
              data: value,
              backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }
            ]
          }
          var pieChartCanvas = $('#pieChart1').get(0).getContext('2d')
          var pieData        = donutData;
          var pieOptions     = {
            maintainAspectRatio : false,
            responsive : true,
          }

    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
          var pieChart = new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions      
          })
        }

      })


    })
  </script>