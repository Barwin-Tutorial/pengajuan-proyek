
            <div class="modal-header">
                <h3 class="modal-title">penerimaan Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" >
                    <input type="hidden" value="" name="id"/> 
                    <div class="card-body">
                        <div class="row">
                           <div class="col-md-6">
                            <div class="form-group row ">
                                <label for="nama" class="col-sm-3 col-form-label">Faktur</label>
                                <div class="col-sm-9 kosong">
                                    <input type="text" class="form-control" name="faktur" id="faktur" placeholder="Faktur" >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label for="nama" class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-9 kosong">
                                    <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label for="nama" class="col-sm-3 col-form-label">Supplier</label>
                                <div class="col-sm-9 kosong">
                                    <input type="text" class="form-control"  name="vsup" id="vsup" placeholder="Supplier" autocomplete="off" >
                                    <input type="hidden" class="form-control"  name="supplier" id="supplier" placeholder="Supplier" autocomplete="off" >
                                    <span class="help-block" ></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row ">
                                <label for="nama" class="col-sm-2 col-form-label">Jumlah</label>
                                <div class="col-sm-4 kosong">
                                    <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="jumlah" id="jumlah" placeholder="Jumlah" >
                                    <span class="help-block"></span>
                                </div>
                                <label for="nama" class="col-sm-2 col-form-label">Kemasan</label>
                                <div class="col-sm-4 kosong">
                                    <input type="text" class="form-control" name="kemasan" id="kemasan" placeholder="Kemasan" value="" >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label for="nama" class="col-sm-2 col-form-label">Expired</label>
                                <div class="col-sm-4 kosong">
                                    <input type="date" class="form-control"  name="ed" id="ed" placeholder="Expired" >
                                    <span class="help-block"></span>
                                </div>
                                <label for="nama" class="col-sm-2 col-form-label">No Batch</label>
                                <div class="col-sm-4 kosong">
                                    <input type="text" class="form-control" name="nobatch" id="nobatch" placeholder="No Batch" value="" >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label for="nama" class="col-sm-2 col-form-label">Barang</label>
                                <div class="col-sm-10 kosong" >
                                    <input type="text" class="form-control" name="produk_nama" id="produk_nama" placeholder="Scan Barcode / Input Manual" autofocus>
                                    <input type="hidden" class="form-control" name="produk_id" id="produk_id" value=""  >
                                    <input type="hidden" class="form-control" name="produk_harga" id="produk_harga" value=""  >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                              
                              <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead class="bg-info">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Kemasan</th>
                                            <th>Jumlah</th>
                                            <th>No Batch</th>
                                            <th>ED</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detail_cart">

                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="batal()">Cancel</button>
    </div>