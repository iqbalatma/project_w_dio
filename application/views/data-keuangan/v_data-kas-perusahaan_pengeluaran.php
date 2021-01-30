            <div class="content">
              <div class="page-inner">

                <div class="row">
                  <div class="col-md-12">
                    <div class="card">

                      <div class="card-header">
                        <div class="d-flex align-items-center">
                          <h4 class="card-title font-weight-bold"><?= $title ?></h4>
                          <a href="<?= base_url('data-keuangan/data-kas-perusahaan') ?>" class="close ml-auto p-1">
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
                                <input type="date" name="add-date" id="add-date" class="form-control" required autofocus>
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
                                  minlength   = 3 
                                  maxlength   = 100
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
                                    maxlength   = "11"
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
                                  minlength   = 3 
                                  maxlength   = 500
                                ><?= set_value('add-keterangan') ?></textarea>
                                <?= form_error('add-keterangan') ?>
                              </div>

                              <!-- button -->
                              <div class="form-group row justify-content-center mt-3">
                                <a href="<?= base_url('data-keuangan/data-kas-perusahaan') ?>" class="btn btn-outline-secondary col-5 mx-1">
                                  Batal
                                </a>
                                <button type="button" class="btn btn-success px-5" data-toggle="modal" data-target="#modal"> Konfirmasi </button>
                              </div>


                              <!-- Modal -->
                              <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">

                                    <div class="modal-header">
                                      <h3 class="modal-title font-weight-bold h2" id="exampleModalLongTitle">Konfirmasi Data Uang Kas</h3>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>

                                    <div class="modal-body" id="modal-body">
                                      <h5>
                                        Data yang sudah disimpan tidak dapat dirubah atau dihapus. <br>
                                        <span class="font-weight-bold">Sudah yakin?</span>
                                      </h5>
                                    </div>

                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger px-3" data-dismiss="modal">Cek Kembali</button>
                                      <button type="submit" class="btn btn-outline-success px-3">Yakin dan simpan</button>
                                    </div>

                                  </div>
                                </div>
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