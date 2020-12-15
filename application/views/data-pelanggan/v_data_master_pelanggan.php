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
                          <!-- <span class="h3"><?= $title ?></span> -->
                          <h4 class="card-title font-weight-bold"><?= $title ?></h4>
                          <a href=<?= current_url() . '/tambah' ?> class="btn btn-default btn-sm ml-auto">
                            <i class="fa fa-plus mr-2"></i>
                            <span class="h6">Tambah data</span>
                          </a>
                          <!-- <button class="btn btn-default btn-sm ml-auto" data-toggle="modal" data-target="#addRowModal">
                            <i class="fa fa-plus mr-2"></i>
                            <span class="h6">Tambah data</span>
                          </button> -->
                        </div>
                      </div>

                      <div class="card-body">

                        <div class="table-responsive">
                          <table id="add-row" class="display table table-sm  table-hover">
                            <thead class="thead-light">
                              <tr>
                                <th class="px-3" width="30px">No</th>
                                <th class="px-3">Nama lengkap</th>
                                <th class="px-3">Tipe</th>
                                <th class="px-3">No. Handphone</th>
                                <th class="px-3">Alamat</th>
                                <th class="px-3" style="width: 10%"><center>Aksi</center></th>
                              </tr>
                            </thead>
                            <tfoot class="thead-light">
                              <tr>
                                <th class="px-3">No</th>
                                <th class="px-3">Nama lengkap</th>
                                <th class="px-3">Tipe</th>
                                <th class="px-3">No. Handphone</th>
                                <th class="px-3">Alamat</th>
                                <th class="px-3"><center>Aksi</center></th>
                              </tr>
                            </tfoot>
                            <tbody>
                              <?php
                              if ($customers !== FALSE) :
                                $i = 1;
                                foreach ($customers as $row) : ?>
                                <tr>
                                  <td class="px-3">
                                    <?= $i++ ?>
                                  </td>
                                  <td class="px-3">
                                    <?= $row['full_name'] ?>
                                  </td>
                                  <td class="px-3">
                                    <?php
                                    switch ($row['cust_type']) 
                                    {
                                      case 'wholesale':
                                        echo 'Grosir';
                                      break;
                                      case 'reseller':
                                        echo 'Reseller';
                                      break;
                                      case 'retail':
                                        echo 'Biasa';
                                      break;
                                      default:
                                        echo 'Ada eror pada salah satu data, silakan hubungi administrator.';
                                        exit(1); // EXIT_ERROR
                                    }
                                    ?>
                                  </td>
                                  <td class="px-3">
                                    <?= $row['phone'] ?>
                                  </td>
                                  <td class="px-3">
                                    <?= $row['address'] ?>
                                  </td>

                                  <td class="">
                                    <div class="form-button-action">
                                      <a href="<?= current_url()."/detail/{$row['id']}" ?>" class="p-3 btn-link btn-default" data-toggle="tooltip" title="Lihat detail" data-original-title="Lihat detail"><i class="fas fa-eye"></i></a>
                                      <a href="<?= current_url()."/edit/{$row['id']}" ?>" class="p-3 btn btn-link btn-primary" data-toggle="tooltip" title="Ubah" data-original-title="Ubah"><i class="fa fa-edit"></i></a>
                                      <span data-toggle="tooltip" title="Hapus" data-original-title="Hapus">
                                        <a href="#modal-delete-data" type="button" data-toggle="modal" data-target="#modal-delete-data" class="p-3 btn btn-link btn-danger btn-delete" data-id="<?= $row['id'] ?>"><i class="fa fa-times"></i></a>
                                      </span>
                                    </div>
                                  </td>
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
            
            <?php // modal untuk hapus data ?>
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
            <?php // /modal untuk hapus data ?>