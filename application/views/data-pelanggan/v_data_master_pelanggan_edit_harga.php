<?php
// pprintd('asdasdasd');
?>

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
                          <div class="col-10 col-xl-8">

                            <form method="POST">
                              <div class="row d-flex justify-content-center col-8 mx-auto">
                                <!-- 1 -->
                                <div class="col-11 mx-auto mt-3">
                                  <h5 class="font-weight-bold"> Nama pelanggan </h5>
                                  <h5 class="bg-light px-2 py-2 rounded"><?= $customer->full_name ?></h5>
                                </div>
                                <!-- 2 -->
                                <?php
                                switch ($customer->cust_type) 
                                {
                                  case 'reseller':
                                    $type = 'Reseller';
                                  break;
                                  
                                  case 'retail':
                                    $type = 'Biasa (Retail)';
                                  break;
                                  
                                  default:
                                    $type = 'Ada eror pada salah satu data, silakan hubungi administrator.';
                                    exit(1); // EXIT_ERROR
                                }
                                ?>
                                <div class="col-11 mx-auto mt-3">
                                  <h5 class="font-weight-bold"> Tipe pelanggan </h5>
                                  <h5 class="bg-light px-2 py-2 rounded"><?= $type ?></h5>
                                </div>
                              </div>

                              <hr class="mt-4" width="80%">

                              <div class="row d-flex justify-content-center">
                              <?php 
                              if ($custom_price !== FALSE) :
                                $i = 1;
                                foreach ($custom_price as $row) :?>
                                <div class="col-11 mx-auto mt-3">
                                  <h4 class="text-muted ml-2">Harga custom <?= $i++ ?></h4>
                                  <div class="d-flex flex-wrap flex-row justify-content-center">
                                    <div class="col-3">
                                      <h5 class="font-weight-bold"> Kode </h5>
                                      <h5 class="bg-light px-2 py-2 rounded"><?= $row['product_code'] ?></h5>
                                    </div>
                                    <div class="col-5">
                                      <h5 class="font-weight-bold"> Nama barang </h5>
                                      <h5 class="bg-light px-2 py-2 rounded"><?= $row['full_name'] ?></h5>
                                    </div>
                                    <div class="col-3">
                                      <h5 class="font-weight-bold"> Harga </h5>
                                      <h5 class="bg-light px-2 py-2 rounded">Rp. <?= number_format($row['price'], 0, '', '.') ?></h5>
                                    </div>
                                    <div class="col-1 d-flex my-auto">
                                      <span data-toggle="tooltip" title="Hapus" data-original-title="Hapus">
                                        <a href="#modal-delete-data" type="button" data-toggle="modal" data-target="#modal-delete-data" class="p-2 btn-link btn-danger btn-delete" data-id="<?= $row['id'] ?>"><i class="fa fa-times"></i></a>
                                      </span>
                                    </div>
                                  </div>
                                </div> <?php 
                                endforeach;
                              else : ?>
                                <p class="text-danger"><em>Customer belum punya harga custom.</em></p>
                              <?php endif; ?>
                              </div>

                              <hr class="mt-4" width="80%">

                              <?php
                              if ($products) : ?>

                                <div class="mx-5">
                                  <?php // check for the user will have custom price or not ?>
                                  <div class="form-group row">
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input class="form-check-input" id="show-or-hide" name="show-or-hide" type="checkbox" value="scheckbox">
                                        <span class="form-check-sign">Pelanggan punya harga custom lainnya?</span>
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
                                <a href="<?= base_url( 'data-pelanggan/'.getBeforeLastSegment('', 2)."/detail/{$customer->id}" ) ?>" class="btn btn-outline-secondary col-5 mx-1">
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

