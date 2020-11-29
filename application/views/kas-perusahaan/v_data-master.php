<div class="content">
              <div class="page-inner">

                <div class="row">
                  <div class="col-md-12">
                    <div class="card">

                      <div class="card-header">
                        <div class="d-flex align-items-center">
                          <h4 class="card-title font-weight-bold"><?= $title ?></h4>
                        </div>
                      </div>

                      <div class="card-body">

                        <div class="table-responsive">
                          <table id="table-kas" class="display nowrap table table-sm table-hover">
                            <thead class="thead-light">
                              <tr>
                                <th class="px-3" rowspan="2">No</th>
                                <th class="px-3" rowspan="2">Tanggal</th>
                                <th class="px-3" rowspan="2">Perihal</th>
                                <th class="px-3" rowspan="2">Debet</th>
                                <th class="px-3" rowspan="2">Kredit</th>
                                <th class="px-3" rowspan="2">Saldo akhir</th>
                                <th class="px-3" colspan="5"><center>Keterangan</center></th>
                              </tr>
                              <tr>
                                <th class="px-3">Tipe</th>
                                <th class="px-3">Kode</th>
                                <th class="px-3">Ket. tambahan</th>
                                <th class="px-3">Aksi</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tfoot class="thead-light">
                              <tr>
                                <th class="px-3" rowspan="2">No</th>
                                <th class="px-3" rowspan="2">Tanggal</th>
                                <th class="px-3" rowspan="2">Perihal</th>
                                <th class="px-3" rowspan="2">Debet</th>
                                <th class="px-3" rowspan="2">Kredit</th>
                                <th class="px-3" rowspan="2">Saldo akhir</th>
                                <th class="px-3" colspan="5"><center>Keterangan</center></th>
                              </tr>
                              <tr>
                                <th class="px-3">Tipe</th>
                                <th class="px-3">Kode</th>
                                <th class="px-3">Ket. tambahan</th>
                                <th class="px-3">Aksi</th>
                                <th></th>
                              </tr>
                            </tfoot>
                            <tbody>
                              <?php
                              $i = 1;
                              foreach ($kas as $row) : ?>
                                <tr>
                                  <td class="px-3">
                                    <?= $i++ ?>
                                  </td>
                                  <td class="px-3">
                                    <?php $d = date_create($row['date']); echo date_format($d,"d-M-Y") ?>
                                  </td>
                                  <td class="px-3">
                                    <?= $row['title'] ?>
                                  </td>
                                  <td class="px-3">
                                    Rp. <?= number_format($row['debet'], 0, '', '.') ?>
                                  </td>
                                  <td class="px-3">
                                    Rp. <?= number_format($row['kredit'], 0, '', '.') ?>
                                  </td>
                                  <td class="px-3">
                                    Rp. <?= number_format($row['final_balance'], 0, '', '.') ?>
                                  </td>
                                  <td class="px-3">
                                    <?= $row['type'] ?>
                                  </td>
                                  <td class="px-3">
                                    <?= $row['kas_code'] ?>
                                  </td>
                                  <td class="px-3">
                                    <?= $row['description'] ?>
                                  </td>
                                  
                                  <td class="">
                                    <div class="form-button-action d-flex">
                                      <span data-toggle="tooltip" title="Hapus" data-original-title="Hapus">
                                        <a href="#modal-delete-data" type="button" data-toggle="modal" data-target="#modal-delete-data" class="p-2 btn-link btn-danger btn-delete" data-id="<?= $row['id'] ?>"><i class="fa fa-times"></i></a>
                                      </span>
                                    </div>
                                  </td>
                                  <td></td>

                                  <!-- <td class="">
                                    <div class="form-button-action justify-content-center d-flex">
                                      <?php
                                      // <a href=" current_url() . "/edit/{$row['id']}" " class="p-2 btn-link btn-primary" data-toggle="tooltip" title="Atur stok" data-original-title="Atur stok"><i class="fas fa-plus"></i></a>
                                      // <a href=" current_url() . "/edit/{$row['id']}" " class="p-2 btn-link btn-primary" data-toggle="tooltip" title="Ubah" data-original-title="Ubah"><i class="fa fa-edit"></i></a>
                                      // <a href=" current_url() . "/detail/{$row['id']}" " class="p-2 btn-link btn-default" data-toggle="tooltip" title="Lihat detail" data-original-title="Lihat detail"><i class="fas fa-eye"></i></a>
                                      ?>
                                      <span data-toggle="tooltip" title="Hapus" data-original-title="Hapus">
                                        <a href="#modal-delete-data" type="button" data-toggle="modal" data-target="#modal-delete-data" class="p-2 btn-link btn-danger btn-delete" data-id="<?= $row['id'] ?>"><i class="fa fa-times"></i></a>
                                      </span>
                                    </div>
                                  </td> -->
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