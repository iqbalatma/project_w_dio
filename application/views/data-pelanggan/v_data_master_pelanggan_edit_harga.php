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
                          <a href="<?= base_url('data-pelanggan/'.getBeforeLastSegment('', 2)) ?>" class="close ml-auto p-1">
                            <span aria-hidden="true">&times;</span>
                          </a>
                        </div>
                      </div>

                      <div class="card-body">
                        <div class="row justify-content-center">
                          <div class="col-10 col-md-6 col-lg-6 col-xl-4">

                            <form method="POST">
                              <!-- 1 -->
                              <div class="mt-3">
                                <h5 class="font-weight-bold"> Nama pelanggan </h5>
                                <h5 class="bg-light px-2 py-2 rounded"><?= $customer->full_name ?></h5>
                              </div>
                              <!-- 2 -->
                              <?php
                              switch ($customer->cust_type) 
                              {
                                case 'wholesale':
                                  $type = 'Grosir';
                                break;

                                case 'reseller':
                                  $type = 'Reseller';
                                break;
                                
                                case 'retail':
                                  $type = 'Biasa';
                                break;
                                
                                default:
                                  $type = 'Ada eror pada salah satu data, silakan hubungi administrator.';
                                  exit(1); // EXIT_ERROR
                              }
                              ?>
                              <div class="mt-3">
                                <h5 class="font-weight-bold"> Tipe pelanggan </h5>
                                <h5 class="bg-light px-2 py-2 rounded"><?= $type ?></h5>
                              </div>

                              <?php // check for the user will have custom price or not ?>
                              <div class="form-group row">
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
                              </div>

                              <input type="hidden" name="polo" id="polo" value=1>

                              <!-- button -->
                              <div class="form-group row justify-content-center mt-3">
                                <a href="<?= base_url('data-pelanggan/'.getBeforeLastSegment('', 2)) ?>" class="btn btn-light btn-border col-5 mx-1">
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