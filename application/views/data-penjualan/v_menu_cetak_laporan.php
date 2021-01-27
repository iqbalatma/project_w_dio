            <div class="content">
              <div class="page-inner">

                <div class="row">

                  <div class="col-md-9 mx-auto">
                    <div class="card">

                      <div class="card-header">
                        <div class="d-flex align-items-center">
                          <h4 class="card-title font-weight-bold"><?= $title ?></h4>
                          <a href="<?= base_url('data-penjualan/' . getBeforeLastSegment()) ?>" class="close ml-auto p-1">
                            <span aria-hidden="true">&times;</span>
                          </a>
                        </div>
                      </div>

                      <div class="card-body">
                        <form method="post" class="my-5">
                          <!-- <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="transaksi">Laporan Transaksi</label>
                            <div class="col-md-9 flex-col">
                              <div class="custom-control custom-radio">
                                <input value="barang_masuk" type="radio" id="barang_masuk" name="transaksi" class="custom-control-input">
                                <label class="custom-control-label" for="barang_masuk">Barang Masuk</label>
                              </div>
                              <div class="custom-control custom-radio">
                                <input value="barang_keluar" type="radio" id="barang_keluar" name="transaksi" class="custom-control-input">
                                <label class="custom-control-label" for="barang_keluar">Barang Keluar</label>
                              </div>
                              <div class="custom-control custom-radio">
                                <input value="barang_keluar_nominal" type="radio" id="barang_keluar_nominal" name="transaksi" class="custom-control-input">
                                <label class="custom-control-label" for="barang_keluar_nominal">Barang Keluar + Total Nominal</label>
                              </div>
                              <?= form_error('transaksi', '<span class="text-danger small">', '</span>'); ?>
                            </div>
                          </div> -->
                          <div class="row form-group">
                            <label class="col-lg-3 text-lg-right" for="tanggal">Tanggal</label>
                            <div class="col-lg-5">
                              <div class="input-group">
                                <div class="input-group-append">
                                  <span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
                                </div>
                                <input name="tanggal" id="tanggal" type="text" class="form-control" placeholder="Periode Tanggal">
                              </div>
                            </div>
                          </div>
                          <div class="mt-2 row form-group">
                            <div class="col-lg-9 offset-lg-3">
                              <button type="submit" class="py-2 px-5 btn btn-danger btn-icon-split">
                                <span class="icon">
                                  <i class="fa fa-file-pdf"></i>
                                </span>
                                <span class="ml-2 font-weight-bold">
                                  Export ke PDF
                                </span>
                              </button>
                            </div>
                          </div>
                        </form>
                      </div>

                    </div>
                  </div>
                </div>

              </div>
            </div>