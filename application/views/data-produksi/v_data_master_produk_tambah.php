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
                                <label for="add-kodeproduk">
                                  Kode produk <span class="text-danger">*</span>
                                </label>
                                <input 
                                  type        = "text"
                                  id          = "add-kodeproduk"
                                  name        = "add-kodeproduk" 
                                  placeholder = "Kode produk" 
                                  value       = "<?= set_value('add-kodeproduk') ?>"
                                  class       = "form-control <?php if (form_error('add-kodeproduk') !== '') {echo 'is-invalid';} ?>" 
                                  minlength   = 3 
                                  maxlength   = 10 
                                  required
                                  autofocus
                                >
                                <?= form_error('add-kodeproduk') ?>
                              </div>
                              <!-- 2 -->
                              <div class="form-group row">
                                <label for="add-fullname">
                                  Nama produk <span class="text-danger">*</span>
                                </label>
                                <input 
                                  type        = "text"
                                  id          = "add-fullname"
                                  name        = "add-fullname" 
                                  placeholder = "Nama lengkap produk" 
                                  value       = "<?= set_value('add-fullname') ?>"
                                  class       = "form-control <?php if (form_error('add-fullname') !== '') {echo 'is-invalid';} ?>" 
                                  maxlength   = 100
                                  required
                                >
                                <?= form_error('add-fullname') ?>
                              </div>
                              <!-- 3 -->
                              <div class="form-group row">
                                <label for="add-unit">
                                  Unit <span class="text-danger">*</span>
                                </label>
                                <select class="form-control <?php if (form_error('add-unit') !== '') {echo 'is-invalid';} ?>" name="add-unit">
                                  <option disabled selected>-- pilih unit --</option>
                                    <option value="gram"> Gram </option>
                                    <option value="mililiter"> Mililiter </option>
                                </select>
                                <?= form_error('add-unit') ?>
                              </div>
                              <!-- 4 -->
                              <div class="form-group row">
                                <label for="add-volume">
                                  Volume <span class="text-danger">*</span>
                                </label>
                                <input 
                                  type        = "tel"
                                  id          = "add-volume"
                                  name        = "add-volume" 
                                  placeholder = "Komposisi / berat / ukuran per unit" 
                                  value       = "<?= set_value('add-volume') ?>"
                                  class       = "form-control <?php if (form_error('add-volume') !== '') {echo 'is-invalid';} ?>" 
                                  data-filter = "\+?\d{0,6}"
                                  required
                                >
                                <?= form_error('add-volume') ?>
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