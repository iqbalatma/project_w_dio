            <div class="content">
              <div class="page-inner">

                <div class="row">
                  <div class="col-md-12">
                    <div class="card">

                      <div class="card-header">
                        <div class="d-flex align-items-center">
                          <h4 class="card-title font-weight-bold"><?= $title ?></h4>
                          <a href=<?= current_url() . '/tambah' ?> class="btn btn-default btn-sm ml-auto">
                            <i class="fa fa-plus mr-2"></i>
                            <span class="h6">Tambah data</span>
                          </a>
                        </div>
                      </div>

                      <div class="card-body">

                        <!-- Modal add new data -->
                        <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">
                                  <span>Tambah data pegawai baru</span>
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>

                              <form method="POST" action="<?= current_url() ?>">
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label for="add-fullname">
                                          Nama lengkap
                                        </label>
                                        <input 
                                          type        = "text" 
                                          id          = "add-fullname" 
                                          name        = "add-fullname" 
                                          placeholder = "Nama lengkap" 
                                          value       = "" 
                                          class       = "form-control <?php if(form_error('add-fullname') !== ''){ echo 'is-invalid'; } ?>"
                                          autofocus
                                        >
                                        <?= form_error('add-fullname') ?>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label for="add-phone">
                                          Nomor handphone
                                        </label>
                                        <input 
                                          type        = "tel" 
                                          minlength   = "10"
                                          maxlength   = "14"
                                          id          = "add-phone" 
                                          name        = "add-phone" 
                                          placeholder = "cth: 085647329324" 
                                          value       = "" 
                                          class       = "form-control <?php if(form_error('add-phone') !== ''){ echo 'is-invalid'; } ?>"
                                        >
                                        <?= form_error('add-phone') ?>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label for="add-address">
                                          Alamat
                                        </label>
                                        <textarea 
                                          cols        = "30"
                                          rows        = "3"
                                          id          = "add-address" 
                                          name        = "add-address" 
                                          placeholder = "Alamat lengkap pelanggan" 
                                          value       = "" 
                                          class       = "form-control <?php if(form_error('add-address') !== ''){ echo 'is-invalid'; } ?>"
                                        ></textarea>
                                        <?= form_error('add-address') ?>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="modal-footer no-bd">
                                  <button type="button" class="btn btn-light btn-border" data-dismiss="modal">Batal</button>
                                  <button type="submit" id="addRowButton" class="btn btn-primary">Simpan</button>
                                </div>
                              </form>

                            </div>
                          </div>
                        </div>
                        <!-- /Modal add new data -->

                        <div class="table-responsive">
                          <table id="add-row" class="display table table-sm  table-hover">
                            <thead class="thead-light">
                              <tr>
                                <th class="px-3" width="20px">No</th>
                                <th class="px-3" width="30px">Avatar</th>
                                <th class="px-3">Nama depan</th>
                                <th class="px-3">Nama belakang</th>
                                <th class="px-3">No. Handphone</th>
                                <th class="px-3">Alamat</th>
                                <th class="px-3" style="width: 10%">Aksi</th>
                              </tr>
                            </thead>
                            <tfoot class="thead-light">
                              <tr>
                                <th class="px-3">No</th>
                                <th class="px-3">Avatar</th>
                                <th class="px-3">Nama depan</th>
                                <th class="px-3">Nama belakang</th>
                                <th class="px-3">No. Handphone</th>
                                <th class="px-3">Alamat</th>
                                <th class="px-3">Aksi</th>
                              </tr>
                            </tfoot>
                            <tbody>
                              <?php
                              $i = 1;
                              foreach ($employees as $row) : ?>
                              <tr>
                                <td class="px-3">
                                  <?= $i++ ?>
                                </td>
                                <td class="px-3">
                                  <img src="<?= base_url("assets/img/avatar/{$row['avatar']}") ?>" alt="" width="50px">
                                </td>
                                <td class="px-3">
                                  <?= $row['first_name'] ?>
                                </td>
                                <td class="px-3">
                                  <?= $row['last_name'] ?>
                                </td>
                                <td class="px-3">
                                  <a href="tel:<?= $row['phone'] ?>" class="text-muted"><?= $row['phone'] ?></a>
                                </td>
                                <td class="px-3">
                                  <?= $row['address'] ?>
                                </td>
                                <td class="px-3">
                                  <div class="form-button-action">
                                    <a href="<?= current_url() . "/detail/{$row['id']}" ?>" class="btn btn-link btn-default" data-toggle="tooltip" title="Lihat detail" data-original-title="Lihat detail"><i class="fas fa-eye"></i></a>
                                    <a href="<?= current_url() . "/edit/{$row['id']}" ?>" class="btn btn-link btn-primary" data-toggle="tooltip" title="Ubah" data-original-title="Ubah"><i class="fa fa-edit"></i></a>
                                    <a href="#modal-delete-data" type="button" data-toggle="modal" data-target="#modal-delete-data" class="btn btn-link btn-danger btn-delete" data-id="<?= $row['id'] ?>"><i class="fa fa-times"></i></a>
                                  </div>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>

                      </div>

                    </div>
                  </div>
                </div>

              </div>
            </div>
            
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