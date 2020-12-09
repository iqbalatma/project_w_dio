            <div class="content">
              <div class="page-inner">

                <div class="row">
                  <div class="col-md-12">
                    <div class="card">

                      <div class="card-header">
                        <div class="d-flex align-items-center">
                          <h4 class="card-title font-weight-bold"><?= $title ?></h4>
                          <a href="<?= base_url( 'data-produksi/' . getBeforeLastSegment('', 2) ) ?>" class="close ml-auto p-1">
                            <span aria-hidden="true">&times;</span>
                          </a>
                        </div>
                      </div>

                      <div class="card-body">
                        <div class="row justify-content-center">
                          <div class="col-8 mt-2">

                            <div class="row d-flex">
                              <!-- 1 -->
                              <div class="d-flex avatar avatar-xxl mx-auto">
                                <img src="<?= base_url("assets/img/product/{$product->image}") ?>" alt="" class="avatar-img rounded">
                              </div>
                            </div>
                            <div class="row d-flex">
                              <div class="col-5 mx-auto">
                                <!-- 2 -->
                                <div class="mt-3">
                                  <h5 class="font-weight-bold"> Kode produk </h5>
                                  <h5 class="bg-light px-2 py-2 rounded"><?= $product->product_code ?></h5>
                                </div>
                                <!-- 3 -->
                                <div class="mt-3">
                                  <h5 class="font-weight-bold"> Nama produk </h5>
                                  <h5 class="bg-light px-2 py-2 rounded"><?= $product->full_name ?></h5>
                                </div>
                                <!-- 4 -->
                                <div class="mt-3">
                                  <h5 class="font-weight-bold"> Volume / Berat</h5>
                                  <h5 class="bg-light px-2 py-2 rounded"><?= "{$product->volume} {$product->unit}" ?></h5>
                                </div>
                              </div>

                              <div class="col-5 mx-auto">
                                <!-- 1 -->
                                <div class="mt-3">
                                  <h5 class="font-weight-bold"> HPP </h5>
                                  <h5 class="bg-light px-2 py-2 rounded">Rp. <?= number_format($product->price_base, 0, '', '.') ?></h5>
                                </div>
                                <!-- 2 -->
                                <div class="mt-3">
                                  <h5 class="font-weight-bold"> Harga jual normal </h5>
                                  <h5 class="bg-light px-2 py-2 rounded">Rp. <?= number_format($product->selling_price, 0, '', '.') ?></h5>
                                </div>
                                <!-- 3 -->
                                <!-- <div class="mt-3">
                                  <h5 class="font-weight-bold"> Harga jual reseller </h5>
                                  <h5 class="bg-light px-2 py-2 rounded"></h5>
                                </div> -->
                                <!-- 4 -->
                                <!-- <div class="mt-3">
                                  <h5 class="font-weight-bold"> Harga jual grosir </h5>
                                  <h5 class="bg-light px-2 py-2 rounded"></h5>
                                </div> -->
                                <?php if ($product->price_base == 0) : ?>
                                <p class="mt-4 text-danger"><em>Silakan setting komposisi untuk produk ini agar bisa melihat HPP.</em></p>
                                <?php endif; ?>
                              </div>
                            </div>

                            <hr class="mt-4" width="80%">

                            <div class="row d-flex justify-content-center">
                              <?php 
                              if ($composition !== FALSE) {
                                $i = 1;
                                foreach ($composition as $row) :?>
                                <div class="col-11 mx-auto mt-4">
                                  <h4 class="text-muted ml-2">Bahan baku ke-<?= $i++ ?></h4>
                                  <div class="d-flex flex-wrap flex-row justify-content-center">
                                    <div class="col-6">
                                      <h5 class="font-weight-bold"> Nama </h5>
                                      <h5 class="bg-light px-2 py-2 rounded"><?= $row['full_name'] ?></h5>
                                    </div>
                                    <div class="col-6">
                                      <h5 class="font-weight-bold"> Kode </h5>
                                      <h5 class="bg-light px-2 py-2 rounded"><?= $row['material_code'] ?></h5>
                                    </div>
                                    <div class="col-6">
                                      <h5 class="font-weight-bold"> Harga dasar </h5>
                                      <h5 class="bg-light px-2 py-2 rounded">Rp. <?= number_format($row['price_base'], 0, '', '.') ?></h5>
                                    </div>
                                    <div class="col-6">
                                      <h5 class="font-weight-bold"> Harga dasar x Jumlah </h5>
                                      <h5 class="bg-light px-2 py-2 rounded"><?= "{$row['price_base']} x {$row['volume']}" ?> = Rp. <?= number_format($row['price_base'] * $row['volume'], 0, '', '.') ?></h5>
                                    </div>
                                  </div>
                                </div> <?php 
                                endforeach;
                              } else { ?>
                                <p class="text-danger"><em>Silakan setting komposisi dari produk ini untuk menampilkan daftar bahan mentahnya.</em></p>
                              <?php } ?>
                            </div>

                            <!-- button -->
                            <div class="form-group row justify-content-center mt-5">
                              <a href="<?= base_url( "{$menuActive}/" . getBeforeLastSegment('', 2) ) ?>" class="btn btn-light btn-border col-3 mx-1">
                                Batal
                              </a>
                              <a href="<?= base_url( "{$menuActive}/{$submenuActive}/edit-komposisi/" . getLastSegment() ) ?>" class="btn btn-primary btn-border col-3 mx-1">
                                Setting komposisi
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