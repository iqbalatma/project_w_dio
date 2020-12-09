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
                          <div class="col-12">

                            <div class="col-6 col-xl-5 col-lg-6 col-md-8 col-sm-10 d-flex justify-content-center mx-auto row">
                              <!-- 1 -->
                              <div class="col-6 mx-auto mt-3">
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
                              <div class="col-6 mx-auto mt-3">
                                <h5 class="font-weight-bold"> Nomor Handphone </h5>
                                <h5 class="bg-light px-2 py-2 rounded"><?= $customer->phone ?></h5>
                              </div>
                              <div class="col-8 mx-auto mt-3">
                                <h5 class="font-weight-bold"> Alamat </h5>
                                <h5 class="bg-light px-2 py-2 rounded"><?= $customer->address ?></h5>
                              </div>
                              <div class="col-4 mx-auto mt-3">
                                <h5 class="font-weight-bold"> Tipe pelanggan </h5>
                                <h5 class="bg-light px-2 py-2 rounded"><?= $type ?></h5>
                              </div>
                            </div>

                            <hr class="mt-5" width="80%">

                            <h3><center><strong>Produk dengan harga kustom</strong></center></h3>
                            <div class="row d-flex justify-content-center col-12 mx-auto">
                            <?php 
                            if ($custom_price !== FALSE) {
                              $i = 1;
                              foreach ($custom_price as $row) :?>
                              <div class="mx-4 mt-5 d-flex flex-column col-4 justify-content-between">
                                <!-- <h4 class="text-muted mx-auto font-weight-bold">Harga custom <?= $i++ ?></h4> -->
                                <div class="d-flex flex-row justify-content-center">
                                  <div class="">
                                    <h5 class="font-weight-bold"> Gambar </h5>
                                    <img class="rounded border" src="<?= base_url("assets/img/product/{$row['image']}") ?>" alt="<?= "Avatar {$row['full_name']}" ?>" width="150px">
                                  </div>
                                  <div class="d-flex flex-column col-9">
                                    <div class="">
                                      <h5 class="font-weight-bold"> Kode </h5>
                                      <h5 class="bg-light px-2 py-2 rounded"><?= $row['product_code'] ?></h5>
                                    </div>
                                    <div class="">
                                      <h5 class="font-weight-bold"> Nama produk </h5>
                                      <h5 class="bg-light px-2 py-2 rounded"><?= $row['full_name'] ?></h5>
                                    </div>
                                    <div class="">
                                      <h5 class="font-weight-bold"> Harga custom </h5>
                                      <h5 class="bg-light px-2 py-2 rounded">Rp. <?= number_format($row['price'], 0, '', '.') ?></h5>
                                    </div>
                                  </div>
                                </div>
                              </div> <?php 
                              endforeach;
                            } else { ?>
                              <p class="text-danger"><em>Customer belum punya harga custom.</em></p>
                            <?php } ?>
                            </div>
                            
                            <!-- button -->
                            <div class="form-group row justify-content-center mt-5">
                              <a href="<?= base_url( "{$menuActive}/" . getBeforeLastSegment('', 2) ) ?>" class="btn btn-light btn-border col-3 mx-1">
                                Batal
                              </a>
                              <a href="<?= base_url( "{$menuActive}/{$submenuActive}/edit-harga/" . getLastSegment() ) ?>" class="btn btn-primary btn-border col-3 mx-1">
                                Setting Harga Kustom
                              </a>
                              <a href="<?= base_url( "{$menuActive}/{$submenuActive}/edit/" . getLastSegment() ) ?>" class="btn btn-default col-3 mx-1">
                                Perbarui data
                              </a>
                            </div>

                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>

              </div>
            </div>


