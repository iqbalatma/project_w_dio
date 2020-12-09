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
                          <a href="<?= base_url( 'data-pelanggan/' . getBeforeLastSegment('', 2) ) ?>" class="close ml-auto p-1">
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
                                <label for="edit-fullname">
                                  Nama pelanggan <span class="text-danger">*</span>
                                </label>
                                <input 
                                  type        = "text" 
                                  id          = "edit-fullname" 
                                  name        = "edit-fullname" 
                                  placeholder = "Nama lengkap" 
                                  value       = "<?= (set_value('edit-fullname') !== '') ? set_value('edit-fullname') : $customer->full_name ; ?>"
                                  class       = "form-control <?php if(form_error('edit-fullname') !== ''){ echo 'is-invalid'; } ?>"
                                  autofocus
                                >
                                <?= form_error('edit-fullname') ?>
                              </div>
                              <!-- 3 -->
                              <div class="form-group row">
                                <label for="edit-tipe">
                                  Tipe pelanggan <span class="text-danger">*</span>
                                </label>
                                <select class="form-control <?php if (form_error('edit-tipe') !== '') {echo 'is-invalid';} ?>" name="edit-tipe">
                                  <option disabled selected>-- pilih tipe --</option>
                                    <option value="retail" <?php echo ($customer->cust_type == 'retail')?('selected'):('') ?>> Biasa / Retail </option>
                                    <option value="reseller" <?php echo ($customer->cust_type == 'reseller')?('selected'):('') ?>> Reseller </option>
                                    <option value="wholesale" <?php echo ($customer->cust_type == 'wholesale')?('selected'):('') ?>> Grosir / Wholesale </option>
                                </select>
                                <?= form_error('edit-tipe') ?>
                              </div>
                              <!-- 2 -->
                              <div class="form-group row">
                                <label for="edit-phone">
                                  Nomor handphone <span class="text-danger">*</span>
                                </label>
                                <input 
                                  type        = "tel" 
                                  minlength   = "10"
                                  maxlength   = "14"
                                  id          = "edit-phone" 
                                  name        = "edit-phone" 
                                  placeholder = "cth: 085619559999" 
                                  value       = "<?= (set_value('edit-phone') !== '') ? set_value('edit-phone') : $customer->phone ; ?>"
                                  class       = "form-control <?php if(form_error('edit-phone') !== ''){ echo 'is-invalid'; } ?>"
                                >
                                <?= form_error('edit-phone') ?>
                              </div>
                              <!-- 3 -->
                              <div class="form-group row">
                                <label for="edit-address">
                                  Alamat <span class="text-danger">*</span>
                                </label>
                                <textarea 
                                  cols        = "30"
                                  rows        = "3"
                                  id          = "edit-address" 
                                  name        = "edit-address" 
                                  placeholder = "Alamat lengkap pelanggan" 
                                  class       = "form-control <?php if(form_error('edit-address') !== ''){ echo 'is-invalid'; } ?>"
                                ><?= (set_value('edit-address') !== '') ? set_value('edit-address') : $customer->address ; ?></textarea>
                                <?= form_error('edit-address') ?>
                              </div>

                              <!-- button -->
                              <div class="form-group row justify-content-center mt-3">
                                <a href="<?= base_url( 'data-pelanggan/' . getBeforeLastSegment('', 2) ) ?>" class="btn btn-light btn-border col-5 mx-1">
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