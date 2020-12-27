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
                          <div class="col-10 col-xl-8">

                            <form method="POST">

                              <?php
                              if ($products) : ?>

                                <div class="mx-5">
                                  <?php // check for the user will have custom price or not ?>
                                  <div class="form-group row">
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input class="form-check-input" id="show-or-hide" name="show-or-hide" type="checkbox" value="scheckbox">
                                        <span class="form-check-sign">Ingin tambah stok produk lainnya?</span>
                                      </label>
                                    </div>
                                  </div>
                                  
                                  <div class="bungkus">
                                    <span class="btn btn-sm btn-border btn-secondary add-customprice-div">Tambah produk</span>
                                    <span class="element" id="div-0"></span>
                                  </div>
                                </div>

                                <input type="hidden" name="polo" id="polo" value=1>
                              
                              <?php else : ?>
                                <p class="text-danger text-center"><em>Tidak ada produk.</em></p>
                              <?php endif; ?>

                              <!-- button -->
                              <div class="form-group row justify-content-center mt-3">
                                <a href="<?= base_url( 'data-pelanggan/'.getBeforeLastSegment('', 2)."/detail/{''}" ) ?>" class="btn btn-outline-secondary col-5 mx-1">
                                  Kembali
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