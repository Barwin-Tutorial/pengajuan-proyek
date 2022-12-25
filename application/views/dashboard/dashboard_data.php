    
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          
          <!-- /.card-header -->
          <div class="card-body">
            <form class="form" id="form_lap" action="<?php echo base_url('lap_tb/lap_excel') ?>" method="post">
              <div class="form-group row">
                <div class="col-sm-2">
                  <input type="text" class="form-control  float-right " name="thn" placeholder="Tahun Pengadaan">
                  </div>
                  <div class="col-sm-2">
                  <input type="text" class="form-control  float-right " name="vsup" id="vsup"  placeholder="Penyedia" >
                </div>
                <div class="col-sm-2">
                  <input type="text" name="nobatch" class="form-control" placeholder="Batch">
                </div>
                <div class="col-sm-2">
                  <input type="text" name="satuan" class="form-control" placeholder="Satuan">
                </div>
                <div class="col-sm-2">
                  <input type="text" name="nie" class="form-control" placeholder="NIE">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-4">
                  <div class="form-group input-group-sm">
                    <button type="button" class="btn btn-primary btn-xs" onclick="sortir()">Tampilkan</button>
                    <button type="button" class="btn btn-primary btn-xs" onclick="eksport()">Eksport</button>
                  </div>
                </div>

              </div>
        </form>
        <div id="tampil"></div>
      </div>
    </div>
  </div>
</div>
</div>
</section>
