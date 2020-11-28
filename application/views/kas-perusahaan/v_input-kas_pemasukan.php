<div class="content">
              <div class="page-inner">

                <div class="row">
                  <div class="col-md-12">
                    <div class="card">

                      <div class="card-header">
                        <div class="d-flex align-items-center">
                          <h4 class="card-title font-weight-bold"><?= $title ?></h4>
                          <a href="<?= base_url('kas-perusahaan/data-master') ?>" class="close ml-auto p-1">
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
                                <label for="add-date">
                                  Tanggal <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="add-date" id="add-date" class="form-control" required>
                              </div>
                              <!-- 2 -->
                              <div class="form-group row">
                                <label for="add-perihal">
                                  Perihal <span class="text-danger">*</span>
                                </label>
                                <input 
                                  type        = "text" 
                                  id          = "add-perihal" 
                                  name        = "add-perihal" 
                                  placeholder = "Perihal" 
                                  value       = "<?= set_value('add-perihal') ?>"
                                  class       = "form-control <?php if(form_error('add-perihal') !== ''){ echo 'is-invalid'; } ?>"
                                  required
                                >
                                <?= form_error('add-perihal') ?>
                              </div>
                              <!-- 3 -->
                              <div class="form-group row">
                                <label for="add-nominal">
                                  Nominal <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                  </div>
                                  <input 
                                    type        = "tel" 
                                    minlength   = "1"
                                    maxlength   = "14"
                                    id          = "add-nominal" 
                                    name        = "add-nominal" 
                                    placeholder = "cth: 250.000" 
                                    value       = "<?= set_value('add-nominal') ?>"
                                    class       = "form-control <?php if(form_error('add-nominal') !== ''){ echo 'is-invalid'; } ?>"
                                    required
                                  >
                                </div>
                                <?= form_error('add-nominal') ?>
                              </div>
                              <!-- 4 -->
                              <div class="form-group row">
                                <label for="add-keterangan">
                                  Keterangan tambahan
                                </label>
                                <textarea 
                                  cols        = "30"
                                  rows        = "3"
                                  id          = "add-keterangan" 
                                  name        = "add-keterangan" 
                                  placeholder = "OPSIONAL. Tidak harus diisi." 
                                  class       = "form-control <?php if(form_error('add-keterangan') !== ''){ echo 'is-invalid'; } ?>"
                                ><?= set_value('add-keterangan') ?></textarea>
                                <?= form_error('add-keterangan') ?>
                              </div>

                              <!-- button -->
                              <div class="form-group row justify-content-center mt-3">
                                <a href="<?= base_url('kas-perusahaan/data-master') ?>" class="btn btn-light btn-border col-5 mx-1">
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