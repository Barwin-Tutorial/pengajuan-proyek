


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
            <div class="card">

              <!-- /.card-header -->
              <div class="card-body">
                <form class="form" id="form_lap" action="<?php echo base_url('lap_tb/lap_excel') ?>" method="post">
                  <div class=" row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <input type="text" class="form-control form-control-sm " name="tanggal" id="range">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <select class="form-control select2 form-control-sm" style="width: 100%; height: 100%;">
                          <option selected="selected" disabled="">Pilih Gudang</option>
                          <?php foreach ($gudang->result() as $r): ?>
                            <option value="<?=$r->id?>"><?php echo $r->nama ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-4">
                      <div class="form-group input-group-sm">
                        <button type="button" class="btn btn-success " onclick="sortir()">Tampilkan</button>
                        <button type="button" class="btn btn-primary " onclick="eksport()">Eksport</button>
                      </div>
                    </div>

                  </div>
                </form>
                <div id="tampil"></div>
              </div>
            </div>
          </div>
        
    </section>
    <script type="text/javascript">
      $(function () {
    //Initialize Select2 Elements
    $('.select2a').select2()
  })
      $('#range').daterangepicker()

      function sortir() {
        $.ajax({
          url : "<?php echo site_url('laporan/lap_dasboard'); ?>",
          data : $("#form_lap").serialize(),
          dataType: "html",
          type: "POST",
          success : function (response) {
           $('#tampil').html(response);
         }
       })
      }
    </script>
