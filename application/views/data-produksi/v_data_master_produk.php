            <div class="content">
              <div class="page-inner">

                <div class="row">
                  <div class="col-md-12">
                    <div class="card">

                      <div class="card-header">
                        <div class="d-flex align-items-center">
                          <h4 class="card-title font-weight-bold"><?= $title ?></h4>
                          <div class="ml-auto">
                            <?php if ( role_access($this->session->role_id, ['1', '2']) ) : ?>
                              <a href=<?= current_url() . '/update-hpp' ?> class="btn btn-outline-secondary btn-sm ml-auto ">
                                <i class="fa fa-plus mr-2"></i>
                                <span class="h6">Update Seluruh HPP</span>
                              </a>
                              <a href=<?= current_url() . '/tambah' ?> class="btn btn-default btn-sm ml-auto ">
                                <i class="fa fa-plus mr-2"></i>
                                <span class="h6">Tambah data</span>
                              </a>
                            <?php endif; ?>
                            <div class="btn-group dropleft" data-toggle="tooltip" title="Opsi">
                              <button type="button" class="btn btn-sm btn-light ml-1 mr-2 px-3 py-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="h2"><i class="fas fa-ellipsis-v text-info"></i></span>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= base_url("generate-report/pdf/export?mode=all&menu=master_produk") ?>" target=_blank><i class="fas fa-file-pdf mr-2 text-danger"></i>Export to PDF</a>
                                <!-- <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url("generate-report/pdf/export?mode=all&menu=master_produk") ?>" target=_blank><i class="fas fa-file-excel mr-2 text-success"></i>Generate Excel</a> -->
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="card-body">

                        <div class="table-responsive">
                          <table id="add-row" class="display table table-sm  table-hover">
                            <thead class="thead-light">
                              <tr>
                                <th class="px-3" width="5%">No</th>
                                <th class="px-3">Gambar</th>
                                <th class="px-3">Kode produk</th>
                                <th class="px-3">Nama produk</th>
                                <th class="px-3">Volume</th>
                                <?php if (role_access($this->session->role_id, ['1'])) : ?>
                                  <th class="px-3">HPP</th>
                                  <th class="px-3">Harga reseller</th>
                                <?php endif; ?>
                                <th class="px-3">Harga jual</th>

                                <?php if (role_access($this->session->role_id, ['1'])) : ?>
                                  <th class="">
                                    <center>Aksi</center>
                                  </th>
                                <?php endif; ?>
                              </tr>
                            </thead>
                            <tfoot class="thead-light">
                              <tr>
                                <th class="px-3">No</th>
                                <th class="px-3">Gambar</th>
                                <th class="px-3">Kode produk</th>
                                <th class="px-3">Nama produk</th>
                                <th class="px-3">Volume</th>
                                <?php if (role_access($this->session->role_id, ['1'])) : ?>
                                  <th class="px-3">HPP</th>
                                  <th class="px-3">Harga reseller</th>
                                <?php endif; ?>
                                <th class="px-3">Harga jual</th>

                                <?php if (role_access($this->session->role_id, ['1'])) : ?>
                                  <th class="">
                                    <center>Aksi</center>
                                  </th>
                                <?php endif; ?>
                              </tr>
                            </tfoot>
                            <tbody>
                              <?php
                              if ($products != FALSE) :
                                $i = 1;
                                foreach ($products as $row) : ?>
                                  <tr>
                                    <td class="px-3">
                                      <?= $i++ ?>
                                    </td>
                                    <td class="px-3">
                                      <img src="<?= base_url("assets/img/product/{$row['image']}") ?>" alt="<?= "Avatar {$row['full_name']}" ?>" width="100px">
                                    </td>
                                    <td class="px-3">
                                      <?= $row['product_code'] ?>
                                    </td>
                                    <td class="px-3">
                                      <?= $row['full_name'] ?>
                                    </td>
                                    <td class="px-3 <?= ($row['volume'] != 0) ? '' : 'text-danger' ?>">
                                      <?= $row['volume'] ?> <?= $row['unit'] ?>
                                    </td>
                                    <?php if (role_access($this->session->role_id, ['1'])) : ?>
                                      <td class="px-3 <?= ($row['price_base'] != 0) ? '' : 'text-danger' ?>">
                                        Rp. <?= number_format($row['price_base'], 0, '', '.') ?>
                                      </td>
                                      <td class="px-3 <?= ($row['price_base'] != 0) ? '' : 'text-danger' ?>">
                                        Rp. <?= number_format($row['reseller_price'], 0, '', '.') ?>
                                      </td>
                                    <?php endif; ?>
                                    <td class="px-3 <?= ($row['selling_price'] != 0) ? '' : 'text-danger' ?>">
                                      Rp. <?= number_format($row['selling_price'], 0, '', '.') ?>
                                    </td>


                                    <?php if (role_access($this->session->role_id, ['1'])) : ?>
                                      <td class="">
                                        <div class="form-button-action">
                                          <a href="<?= current_url()."/detail/{$row['id']}" ?>" class="p-2 btn-link btn-default" data-toggle="tooltip" title="Lihat detail" data-original-title="Lihat detail"><i class="fas fa-eye"></i></a>
                                            <a href="<?= current_url()."/edit/{$row['id']}" ?>" class="p-2 btn-link btn-primary" data-toggle="tooltip" title="Ubah" data-original-title="Ubah"><i class="fa fa-edit"></i></a>
                                            <span data-toggle="tooltip" title="Hapus" data-original-title="Hapus">
                                              <a href="#modal-delete-data" type="button" data-toggle="modal" data-target="#modal-delete-data" class="p-2 btn-link btn-danger btn-delete" data-id="<?= $row['id'] ?>"><i class="fa fa-times"></i></a>
                                            </span>
                                        </div>
                                      </td>
                                    <?php endif; ?>
                                  </tr>
                                <?php 
                                endforeach;
                              endif; ?>
                            </tbody>
                          </table>
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
                    <h3 class="modal-title text-danger">Konfirmasi Hapus Data</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body my-3">
                    <h4>Yakin ingin menghapus data?</h4>
                  </div>
                  <form action="<?= current_url() . "/hapus" ?>" method="POST">
                    <div class="modal-footer">
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