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
                          <a href="<?= base_url('data-produksi/'.getBeforeLastSegment('', 2)) ?>" class="close ml-auto p-1">
                            <span aria-hidden="true">&times;</span>
                          </a>
                        </div>
                      </div>

                      <div class="card-body">
                        <div class="row justify-content-center">
                          <div class="col-10 col-md-6 col-lg-6 col-xl-6">

                            <form method="POST">
                              <div class="row d-flex justify-content-center col-8 mx-auto">
                                <!-- 1 -->
                                <div class="col-11 mx-auto mt-3">
                                  <h5 class="font-weight-bold"> Kode produk </h5>
                                  <h5 class="bg-light px-2 py-2 rounded"><?= $product->product_code ?></h5>
                                </div>
                                <!-- 2 -->
                                <div class="col-11 mx-auto mt-3">
                                  <h5 class="font-weight-bold"> Nama produk </h5>
                                  <h5 class="bg-light px-2 py-2 rounded"><?= $product->full_name ?></h5>
                                </div>
                              </div>

                              <hr class="mt-4" width="80%">

                              <div class="row d-flex justify-content-center">
                              <?php 
                              if ($composition !== FALSE) {
                                $i = 1;
                                foreach ($composition as $row) :?>
                                <div class="col-11 mx-auto mt-3">
                                  <h4 class="text-muted ml-2">Komposisi ke <?= $i++ ?></h4>
                                  <div class="d-flex flex-wrap flex-row justify-content-center">
                                    <div class="col-3">
                                      <h5 class="font-weight-bold"> Kode </h5>
                                      <h5 class="bg-light px-2 py-2 rounded"><?= $row['material_code'] ?></h5>
                                    </div>
                                    <div class="col-5">
                                      <h5 class="font-weight-bold"> Nama bahan baku </h5>
                                      <h5 class="bg-light px-2 py-2 rounded"><?= $row['full_name'] ?></h5>
                                    </div>
                                    <div class="col-3">
                                      <h5 class="font-weight-bold"> Volume / qty </h5>
                                      <h5 class="bg-light px-2 py-2 rounded"><?= $row['volume'] ?></h5>
                                    </div>
                                    <div class="col-1 d-flex my-auto">
                                      <span data-toggle="tooltip" title="Hapus" data-original-title="Hapus">
                                        <a href="#modal-delete-data" type="button" data-toggle="modal" data-target="#modal-delete-data" class="p-2 btn-link btn-danger btn-delete" data-id="<?= $row['pc_id'] ?>"><i class="fa fa-times"></i></a>
                                      </span>
                                    </div>
                                  </div>
                                </div> <?php 
                                endforeach;
                              } else { ?>
                                <p class="text-danger"><em>Produk belum punya komposisi.</em></p>
                              <?php } ?>
                              </div>

                              <hr class="mt-4" width="80%">

                              <?php // check for the user will have custom price or not ?>
                              <div class="form-group row">
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input" id="show-or-hide" name="show-or-hide" type="checkbox" value="scheckbox">
                                    <span class="form-check-sign">Produk punya komposisi lainnya?</span>
                                  </label>
                                </div>
                              </div>
                              
                              <div class="bungkus">
                                <span class="btn btn-sm btn-border btn-secondary add-komposisi-div">Tambah komposisi</span>
                                <span class="element" id="div-0"></span>
                              </div>

                              <input type="hidden" name="polo" id="polo" value=1>

                              <hr class="my-5" width="80%">
                              
                              <!-- button -->
                              <div class="form-group row justify-content-center mb-4">
                                <a href="<?= base_url('data-produksi/'.getBeforeLastSegment('', 2))."/detail/{$product->id}" ?>" class="btn btn-outline-secondary col-5 mx-1">
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




            <?php // modal untuk hapus data 
            ?>
            <div class="modal fade" id="modal-delete-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title text-danger">Konfirmasi Hapus Data Komposisi</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body my-3">
                    <h4>Yakin ingin menghapus data?</h4>
                  </div>
                  <form action="<?= base_url() . "data-produksi/data-master-produk/hapus-komposisi" ?>" method="POST">
                    <div class="modal-footer">
                    <input type="hidden" name="page_id" value="<?= $product->id ?>">
                      <input type="hidden" name="id" class="id"></input>
                      <button class="btn btn-danger btn-border">Hapus Data</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <?php // /modal untuk hapus data 
            ?>