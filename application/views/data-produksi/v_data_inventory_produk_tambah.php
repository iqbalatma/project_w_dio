            
            
            
            <div class="content">
              <div class="page-inner">

                <div class="row">

                  <div class="col-md-12">
                    <div class="card">

                      <div class="card-header">
                        <div class="d-flex align-items-center">
                          <h4 class="card-title font-weight-bold"><?= $title ?></h4>
                          <a href="<?= base_url('data-produksi/' . getBeforeLastSegment()) ?>" class="close ml-auto p-1">
                            <span aria-hidden="true">&times;</span>
                          </a>
                        </div>
                      </div>

                      <div class="card-body">
                        <div class="row justify-content-center">
                          <div class="col-10 col-md-6 col-lg-6 col-xl-4">

                            <form id="1" method="post" action="<?= current_url() ?>">
                              <input type="hidden" value="1" name="step">
                              <!-- 1 -->
                              <div class="form-group row">
                                <label for="add-store">
                                  Pilih toko cabang <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="add-store">
                                  <option selected disabled>-- pilih toko --</option>
                                  <?php foreach ($stores as $store): ?>
                                    <option value='<?php echo "{$store->id}||{$store->store_name}" ?>'>
                                      <?php echo "{$store->store_name}" ?>
                                    </option>
                                  <?php endforeach; ?>
                                </select>
                                <?= form_error('add-store') ?>
                              </div>
                              <!-- 2 -->
                              <div class="form-group row">
                                <label for="add-product">
                                  Pilih produk <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="add-product">
                                  <option selected disabled>-- pilih produk --</option>
                                  <?php foreach ($products as $product): ?>
                                    <option value='<?php echo "{$product['id']}||{$product['full_name']}" ?>'>
                                      <?php echo "{$product['full_name']}" ?>
                                    </option>
                                  <?php endforeach; ?>
                                </select>
                                <?= form_error('add-product') ?>
                              </div>
                              <!-- 4 -->
                              <div class="form-group row">
                                <label for="add-qty">
                                  Kuantitas <span class="text-danger">*</span>
                                </label>
                                <input 
                                  type        = "tel"
                                  id          = "add-qty"
                                  name        = "add-qty" 
                                  placeholder = "kuantitas" 
                                  value       = "<?= set_value('add-qty') ?>"
                                  class       = "form-control <?php if (form_error('add-qty') !== '') {echo 'is-invalid';} ?>" 
                                  data-filter = "\+?\d{0,6}"
                                  required
                                >
                                <?= form_error('add-qty') ?>
                              </div>

                              <!-- button -->
                              <div class="form-group row justify-content-center mt-3">
                                <a href="<?= base_url('data-produksi/' . getBeforeLastSegment()) ?>" class="btn btn-outline-secondary col-5 mx-1">
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