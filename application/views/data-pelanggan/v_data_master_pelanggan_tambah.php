            <div class="content">
              <div class="page-inner">

                <!-- <div class="page-header">
                  <h4 class="page-title"><?= $title ?></h4>
                </div> -->

                <div class="row">
                  <div class="col-md-12">
                    <div class="card">

                      <div class="card-header">
                        <div class="d-flex align-items-center">
                          <h4 class="card-title font-weight-bold"><?= $title ?></h4>
                          <a href="<?= base_url( 'data-pelanggan/' . getBeforeLastSegment() ) ?>" class="close ml-auto p-1">
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
                                <label for="add-fullname">
                                  Nama pelanggan <span class="text-danger">*</span>
                                </label>
                                <input 
                                  type        = "text" 
                                  id          = "add-fullname" 
                                  name        = "add-fullname" 
                                  placeholder = "Nama lengkap" 
                                  value       = "<?= set_value('add-fullname') ?>"
                                  class       = "form-control <?php if(form_error('add-fullname') !== ''){ echo 'is-invalid'; } ?>"
                                  autofocus
                                >
                                <?= form_error('add-fullname') ?>
                              </div>
                              <!-- 3 -->
                              <div class="form-group row">
                                <label for="add-tipe">
                                  Tipe pelanggan <span class="text-danger">*</span>
                                </label>
                                <select class="form-control <?php if (form_error('add-tipe') !== '') {echo 'is-invalid';} ?>" name="add-tipe">
                                  <option disabled selected>-- pilih tipe --</option>
                                    <option value="retail"> Biasa / Retail </option>
                                    <option value="reseller"> Reseller </option>
                                </select>
                                <?= form_error('add-tipe') ?>
                              </div>
                              <!-- 2 -->
                              <div class="form-group row">
                                <label for="add-phone">
                                  Nomor handphone <span class="text-danger">*</span>
                                </label>
                                <input 
                                  type        = "tel" 
                                  minlength   = "10"
                                  maxlength   = "14"
                                  id          = "add-phone" 
                                  name        = "add-phone" 
                                  placeholder = "cth: 085619559999" 
                                  value       = "<?= set_value('add-phone') ?>"
                                  class       = "form-control <?php if(form_error('add-phone') !== ''){ echo 'is-invalid'; } ?>"
                                >
                                <?= form_error('add-phone') ?>
                              </div>
                              <!-- 3 -->
                              <div class="form-group row">
                                <label for="add-address">
                                  Alamat <span class="text-danger">*</span>
                                </label>
                                <textarea 
                                  cols        = "30"
                                  rows        = "3"
                                  id          = "add-address" 
                                  name        = "add-address" 
                                  placeholder = "Alamat lengkap pelanggan" 
                                  class       = "form-control <?php if(form_error('add-address') !== ''){ echo 'is-invalid'; } ?>"
                                ><?= set_value('add-address') ?></textarea>
                                <?= form_error('add-address') ?>
                              </div>

                              <?php // check for the user will have custom price or not ?>
                              <!-- <div class="form-group row">
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input" id="show-or-hide" name="show-or-hide" type="checkbox" value="scheckbox">
                                    <span class="form-check-sign">Pelanggan punya harga custom?</span>
                                  </label>
                                </div>
                              </div>
                              
                              <div class="bungkus">
                                <span class="btn btn-sm btn-border btn-secondary add-customprice-div">Tambah produk</span>
                                <span class="element" id="div-0"></span>
                              </div> -->

                              <!-- button -->
                              <div class="form-group row justify-content-center mt-3">
                                <a href="<?= base_url('data-pelanggan/'.getBeforeLastSegment()) ?>" class="btn btn-light btn-border col-5 mx-1">
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