


<?php $data = $materialUnderZero; 
?>


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

                              <?php
                              foreach ($data as $row) : ?>
                              <div>
                                <!-- 1 -->
                                <div class="form-group row">
                                  <label for="kodebahanbaku">
                                    Kode bahan baku
                                  </label>
                                  <input type = "tel" id = "kodebahanbaku" name = "kodebahanbaku" value = "<?= $row['mat_code'] ?>" class = "form-control text-danger" disabled >
                                </div>
                                <!-- 2 -->
                                <div class="form-group row">
                                  <label for="namabahanbaku">
                                    Nama bahan baku
                                  </label>
                                  <input type = "tel" id = "namabahanbaku" name = "namabahanbaku" value = "<?= $row['mat_fullname'] ?>" class = "form-control text-danger" disabled >
                                </div>
                                <!-- 3 -->
                                <div class="form-group row">
                                  <label for="sisabahanbaku">
                                    Sisa bahan baku (Tersedia - dibutuhkan = sisa)
                                  </label>
                                  <input type = "tel" id = "sisabahanbaku" name = "sisabahanbaku" value = "<?= $row['qty_final'] ?>" class = "form-control text-danger" disabled >
                                </div>

                              </div>
                              <hr>
                              <?php endforeach; ?>

                              <!-- button -->
                              <div class="form-group row justify-content-center mt-3">
                                <a href="<?= base_url('data-produksi/data-inventory-produk/tambah') ?>" class="btn btn-outline-secondary col-8 mx-1">
                                  Kembali ke update stok
                                </a>
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