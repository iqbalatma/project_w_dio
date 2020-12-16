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
                        </div>
                      </div>

                      <div class="card-body">

                        <div class="table-responsive">
                          <table id="add-row" class="display table table-sm  table-hover">
                            <thead class="thead-light">
                              <tr>
                                <th class="px-3" width="30px">No</th>
                                <th class="px-3">No Invoice</th>
                                <th class="px-3" width="150px">Alamat tujuan</th>
                                <th class="px-3">Total harga</th>
                                <th class="px-3">Jumlah dibayar</th>
                                <th class="px-3">Sisa bayar</th>
                                <th class="px-3">Tanggal transaksi</th>
                                <th class="px-3" style="width: 20%">
                                  <center>Aksi</center>
                                </th>
                              </tr>
                            </thead>
                            <tfoot class="thead-light">
                              <tr>
                                <th class="px-3">No</th>
                                <th class="px-3">No Invoice</th>
                                <th class="px-3">Alamat tujuan</th>
                                <th class="px-3">Total harga</th>
                                <th class="px-3">Jumlah dibayar</th>
                                <th class="px-3">Sisa bayar</th>
                                <th class="px-3">Tanggal transaksi</th>
                                <th class="px-3">
                                  <center>Aksi</center>
                                </th>
                              </tr>
                            </tfoot>
                            <tbody>
                              <?php
                              if ($invoices !== FALSE) :
                                $i = 1;
                                foreach ($invoices as $row) : ?>
                                  <tr>
                                    <td class="px-3">
                                      <?= $i++ ?>
                                    </td>
                                    <td class="px-3">
                                      <?= $row['invoice_number'] ?>
                                    </td>
                                    <td class="px-3">
                                      <?= $row['deliv_address'] ?>
                                    </td>
                                    <td class="px-3">
                                      <?= price_format($row['price_total']) ?>
                                    </td>
                                    <td class="px-3">
                                      <?= price_format($row['paid_amount']) ?>
                                    </td>
                                    <td class="px-3 <?= ($row['left_to_paid'] != 0) ? 'text-danger' : '' ?>">
                                      <?= price_format($row['left_to_paid']) ?>
                                    </td>
                                    <td class="px-3">
                                      <?php $d = date_create($row['created_at']); echo date_format($d, "d-M-Y") ?>
                                    </td>

                                    <td class="">
                                      <div class="form-button-action">
                                        <a href="<?= base_url("generate-report/surat-jalan/generate/" . $row['id']) ?>" class="btn btn-secondary mx-1" data-toggle="tooltip" title="Cetak Surat jalan" data-original-title="Cetak Surat jalan">
                                          <i class="fas fa-print mr-1"></i> Surat jalan
                                        </a>
                                        <a href="<?= base_url("generate-report/invoice/generate/" . $row['id']) ?>" class="btn btn-secondary mx-1" data-toggle="tooltip" title="Cetak Invoice" data-original-title="Cetak Invoice">
                                          <i class="fa fa-print mr-1"></i> Invoice
                                        </a>
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