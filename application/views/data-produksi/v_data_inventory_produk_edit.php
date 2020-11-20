            <div class="content">
              <div class="page-inner">

                <div class="row">
                  <div class="col-md-12">
                    <div class="card">

                      <div class="card-header">
                        <div class="d-flex align-items-center">
                          <h4 class="card-title font-weight-bold"><?= $title ?></h4>
                          <a href="<?= base_url( 'data-produksi/' . getBeforeLastSegment('', 2) ) ?>" class="close ml-auto p-1">
                            <span aria-hidden="true">&times;</span>
                          </a>
                        </div>
                      </div>

                      <div class="card-body">
                        <div class="row justify-content-center">
                          <div class="col-10 col-md-6 col-lg-6 col-xl-4">

                            <form method="post">

                              <div class="mt-4 d-flex justify-content-center flex-wrap">
                                <!-- 1 -->
                                <div class="form-group row mr-1 col-4 px-0">
                                  <label for="edit-kodeproduk">
                                    Kode produk
                                  </label>
                                  <input 
                                    type        = "text" 
                                    id          = "edit-kodeproduk" 
                                    name        = "edit-kodeproduk" 
                                    placeholder = "Kode produk" 
                                    value       = "<?= (set_value('edit-kodeproduk') !== '') ? set_value('edit-kodeproduk') : $productInventory->product_code ; ?>"
                                    class       = "form-control <?php if(form_error('edit-kodeproduk') !== ''){ echo 'is-invalid'; } ?>"
                                    disabled
                                  >
                                  <?= form_error('edit-kodeproduk') ?>
                                </div>
                                <!-- 2 -->
                                <div class="form-group row ml-1 col-8 px-0">
                                  <label for="edit-fullname">
                                    Nama produk
                                  </label>
                                  <input 
                                    type        = "text" 
                                    id          = "edit-fullname" 
                                    name        = "edit-fullname" 
                                    placeholder = "Nama lengkap produk" 
                                    value       = "<?= (set_value('edit-fullname') !== '') ? set_value('edit-fullname') : $productInventory->full_name ; ?>"
                                    class       = "form-control <?php if(form_error('edit-fullname') !== ''){ echo 'is-invalid'; } ?>"
                                    disabled
                                  >
                                  <?= form_error('edit-fullname') ?>
                                </div>
                                <!-- 4 -->
                                <div class="form-group row mr-1 col-4 px-0">
                                  <label for="edit-qty">
                                    Stok sekarang
                                  </label>
                                  <input 
                                    type        = "text" 
                                    id          = "edit-stoknow" 
                                    name        = "edit-stoknow" 
                                    placeholder = "Jumlah stok produk sekarang" 
                                    value       = "<?= (set_value('edit-stoknow') !== '') ? set_value('edit-stoknow') : $productInventory->quantity ; ?>"
                                    class       = "form-control <?php if(form_error('edit-stoknow') !== ''){ echo 'is-invalid'; } ?>"
                                    disabled
                                  >
                                  <?= form_error('edit-stoknow') ?>
                                </div>
                                <!-- 3 -->
                                <div class="form-group row ml-1 col-8 px-0">
                                  <label for="edit-store">
                                    Lokasi produk (Toko)
                                  </label>
                                  <input 
                                    type        = "text" 
                                    id          = "edit-store" 
                                    name        = "edit-store" 
                                    placeholder = "Lokasi produk" 
                                    value       = "<?= (set_value('edit-store') !== '') ? set_value('edit-store') : $productInventory->store_name ; ?>"
                                    class       = "form-control <?php if(form_error('edit-store') !== ''){ echo 'is-invalid'; } ?>"
                                    disabled
                                  >
                                  <?= form_error('edit-store') ?>
                                </div>
                              </div>

                              <hr class="mt-4" width="80%">

                              <div class="mt-4">
                                <div class="form-group row">
                                  <label>Jenis update stok inventory <span class="text-danger">*</span></label>
                                </div>
                                <div class="form-group row">
                                  <label class="selectgroup-item ml-5 mr-1 btn-secondary btn-border">
                                    <input type="radio" name="update-type" value="-" class="selectgroup-input">
                                    <span class="selectgroup-button">Kurangi stok</span>
                                  </label>
                                  <label class="selectgroup-item mr-5 ml-1 btn-secondary btn-border">
                                    <input type="radio" name="update-type" value="+" class="selectgroup-input">
                                    <span class="selectgroup-button">Tambah stok</span>
                                  </label>
                                </div>
                              </div>

                              <div class="">
                                <div class="form-group row">
                                  </div>
                                  <div class="form-group row">
                                    <label>Jumlah yang akan diperbarui  12312313<span class="text-danger">*</span></label>
                                  <label class="selectgroup-item mr-5 ml-1 btn-secondary btn-border">
                                    <input type="radio" name="update-type" value="+" class="selectgroup-input">
                                    <span class="selectgroup-button">Tam1231bah stok</span>
                                  </label>
                                </div>
                                <div class="form-group row">
                                  <label for="edit-volume">
                                    Volume <span class="text-danger">*</span>
                                  </label>
                                  <input 
                                    type        = "text" 
                                    id          = "edit-volume" 
                                    name        = "edit-volume" 
                                    placeholder = "Komposisi / berat / ukuran per unit" 
                                    value       = "<?= (set_value('edit-volume') !== '') ? set_value('edit-volume') : $productInventory->id ; ?>"
                                    class       = "form-control <?php if(form_error('edit-volume') !== ''){ echo 'is-invalid'; } ?>"
                                  >
                                  <?= form_error('edit-volume') ?>
                                </div>
                              </div>


                              <!-- button -->
                              <div class="form-group row justify-content-center mt-3">
                                <a href="<?= base_url( 'data-produksi/' . getBeforeLastSegment('', 2) ) ?>" class="btn btn-light btn-border col-5 mx-1">
                                  Batal
                                </a>
                                <button type="submit" class="btn btn-success col-5 mx-1">
                                  Simpan
                                </button>
                              </div>

                            </form>

                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>

              </div>
            </div>