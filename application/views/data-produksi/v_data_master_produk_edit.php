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
                              <!-- 1 -->
                              <div class="form-group row">
                                <label for="edit-kodeproduk">
                                  Kode produk <span class="text-danger">*</span>
                                </label>
                                <input 
                                  type        = "text" 
                                  id          = "edit-kodeproduk" 
                                  name        = "edit-kodeproduk" 
                                  placeholder = "Kode produk" 
                                  value       = "<?= (set_value('edit-kodeproduk') !== '') ? set_value('edit-kodeproduk') : $product->product_code ; ?>"
                                  class       = "form-control <?php if(form_error('edit-kodeproduk') !== ''){ echo 'is-invalid'; } ?>"
                                  readonly
                                >
                                <?= form_error('edit-kodeproduk') ?>
                              </div>
                              <!-- 2 -->
                              <div class="form-group row">
                                <label for="edit-fullname">
                                  Nama produk <span class="text-danger">*</span>
                                </label>
                                <input 
                                  type        = "text" 
                                  id          = "edit-fullname" 
                                  name        = "edit-fullname" 
                                  placeholder = "Nama lengkap produk" 
                                  value       = "<?= (set_value('edit-fullname') !== '') ? set_value('edit-fullname') : $product->full_name ; ?>"
                                  class       = "form-control <?php if(form_error('edit-fullname') !== ''){ echo 'is-invalid'; } ?>"
                                  autofocus
                                >
                                <?= form_error('edit-fullname') ?>
                              </div>
                              <!-- 3 -->
                              <div class="form-group row">
                                <label for="edit-unit">
                                  Unit <span class="text-danger">*</span>
                                </label>
                                <select class="form-control <?php if (form_error('edit-unit') !== '') {echo 'is-invalid';} ?>" name="edit-unit">
                                  <option disabled selected>-- pilih unit --</option>
                                    <option value="gram" <?php echo ($product->unit == 'gram')?('selected'):('') ?>> Gram </option>
                                    <option value="mililiter" <?php echo ($product->unit == 'mililiter')?('selected'):('') ?>> Mililiter </option>
                                </select>
                                <?= form_error('edit-unit') ?>
                              </div>
                              <!-- 4 -->
                              <div class="form-group row">
                                <label for="edit-volume">
                                  Volume <span class="text-danger">*</span>
                                </label>
                                <input 
                                  type        = "text" 
                                  id          = "edit-volume" 
                                  name        = "edit-volume" 
                                  placeholder = "Komposisi / berat / ukuran per unit" 
                                  value       = "<?= (set_value('edit-volume') !== '') ? set_value('edit-volume') : $product->volume ; ?>"
                                  class       = "form-control <?php if(form_error('edit-volume') !== ''){ echo 'is-invalid'; } ?>"
                                >
                                <?= form_error('edit-volume') ?>
                              </div>

                              <hr class="mt-4" width="80%">
                              
                              <!-- grouping row -->
                              <div class="mt-4 d-flex justify-content-center">
                                <!-- 1 -->
                                <div class="form-group row mr-1 col-6 px-0">
                                  <label for="edit-hpp">
                                    HPP <span class="text-danger">*</span>
                                  </label>
                                  <input 
                                    type        = "text" 
                                    id          = "edit-hpp" 
                                    name        = "edit-hpp" 
                                    placeholder = "HPP" 
                                    value       = "<?= (set_value('edit-hpp') !== '') ? set_value('edit-hpp') : $product->price_base ; ?>"
                                    class       = "form-control <?php if(form_error('edit-hpp') !== ''){ echo 'is-invalid'; } ?>"
                                  >
                                  <?= form_error('edit-hpp') ?>
                                </div>
                                <!-- 2 -->
                                <div class="form-group row ml-1 col-6 px-0">
                                  <label for="edit-priceretail">
                                    Harga jual ecer
                                  </label>
                                  <input 
                                    type        = "text" 
                                    id          = "edit-priceretail" 
                                    name        = "edit-priceretail" 
                                    placeholder = "Harga ecer" 
                                    value       = "<?= (set_value('edit-priceretail') !== '') ? set_value('edit-priceretail') : $product->price_retail ; ?>"
                                    class       = "form-control <?php if(form_error('edit-priceretail') !== ''){ echo 'is-invalid'; } ?>"
                                  >
                                  <?= form_error('edit-priceretail') ?>
                                </div>
                              </div>

                              <!-- grouping row -->
                              <div class="mt-2 d-flex justify-content-center">
                                <!-- 1 -->
                                <div class="form-group row mr-1 col-6 px-0">
                                  <label for="edit-pricereseller">
                                    Harga jual reseller <span class="text-danger">*</span>
                                  </label>
                                  <input 
                                    type        = "text" 
                                    id          = "edit-pricereseller" 
                                    name        = "edit-pricereseller" 
                                    placeholder = "Harga reseller" 
                                    value       = "<?= (set_value('edit-pricereseller') !== '') ? set_value('edit-pricereseller') : $product->price_reseller ; ?>"
                                    class       = "form-control <?php if(form_error('edit-pricereseller') !== ''){ echo 'is-invalid'; } ?>"
                                  >
                                  <?= form_error('edit-pricereseller') ?>
                                </div>
                                <!-- 2 -->
                                <div class="form-group row ml-1 col-6 px-0">
                                  <label for="edit-pricewholesale">
                                    Harga jual grosir
                                  </label>
                                  <input 
                                    type        = "text" 
                                    id          = "edit-pricewholesale" 
                                    name        = "edit-pricewholesale" 
                                    placeholder = "Harga grosir" 
                                    value       = "<?= (set_value('edit-pricewholesale') !== '') ? set_value('edit-pricewholesale') : $product->price_wholesale ; ?>"
                                    class       = "form-control <?php if(form_error('edit-pricewholesale') !== ''){ echo 'is-invalid'; } ?>"
                                  >
                                  <?= form_error('edit-pricewholesale') ?>
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