<div class="content">
    <?php if ($this->session->flashdata('message_berhasil')) {
    ?>
        <div class="alert alert-success" role="alert">
            <?= $this->session->flashdata('message_berhasil'); ?>
        </div>
    <?php
    }; ?>
    <?php if ($this->session->flashdata('message_gagal')) {
    ?>
        <div class="alert alert-danger" role="alert">
            <?= $this->session->flashdata('message_gagal'); ?>
        </div>
    <?php
    }; ?>
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Data Master - Utang Piutang</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="<?= base_url(); ?>">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="<?= current_url() ?>">Data Keuangan</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="<?= current_url() ?>">Data Master</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="btn-group dropleft ml-auto mb-3 float-right" data-toggle="tooltip" title="Opsi">
                            <button type="button" class="btn btn-sm btn-light ml-1 mr-2 px-3 py-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="h2"><i class="fas fa-ellipsis-v text-info"></i></span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= base_url("generate-report/pdf/export?mode=all&menu=hutang_piutang") ?>" target=_blank><i class="fas fa-file-pdf mr-2 text-danger"></i>Export to PDF</a>
                                <!-- <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url("generate-report/pdf/export?mode=all&menu=hutang_piutang") ?>" target=_blank><i class="fas fa-file-excel mr-2 text-success"></i>Generate Excel</a> -->
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="add-row" class="display table table-sm table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="px-3">No</th>
                                        <th class="px-3 text-center">Nama Pelanggan</th>
                                        <th class="px-3 text-center">Alamat Pelanggan</th>
                                        <th class="px-3">No. Telepon</th>
                                        <th class="px-3">Nomor Transaksi</th>
                                        <th class="px-3">Nomor Invoice</th>
                                        <th class="px-3 text-center">Sisa Bayar</th>
                                        <th class="px-3 text-center">Tanggal Bayar</th>
                                        <th class="px-3 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot class="thead-light">
                                    <tr>
                                        <th class="px-3">No</th>
                                        <th class="px-3 text-center">Nama Pelanggan</th>
                                        <th class="px-3 text-center">Alamat Pelanggan</th>
                                        <th class="px-3">No. Telepon</th>
                                        <th class="px-3">Nomor Transaksi</th>
                                        <th class="px-3">Nomor Invoice</th>
                                        <th class="px-3 text-center">Sisa Bayar</th>
                                        <th class="px-3 text-center">Tanggal Bayar</th>
                                        <th class="px-3 text-center">Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($data_hutang_piutang    as $row) : ?>
                                        <tr>
                                            <td class="px-3">
                                                <?= $i++ ?>
                                            </td>
                                            <td class="px-3">
                                                <?= $row['full_name'] ?>
                                            </td>
                                            <td class="px-3">
                                                <?= $row['address'] ?>
                                            </td>
                                            <td class="px-3">
                                                <?= $row['phone'] ?>
                                            </td>
                                            <td class="px-3 font-weight-bold">
                                                <?= $row['trans_number'] ?>
                                            </td>
                                            <td class="px-3">
                                                <?= $row['invoice_number'] ?>
                                            </td>
                                            <td class="px-3">
                                                <?= price_format($row['left_to_paid']) ?>
                                            </td>
                                            <td class="px-3">
                                                <?php $dt = explode(' ', $row['paid_at']);
                                                $d = date_create($dt[0]);
                                                echo date_format($d, "d-M-Y") ?>
                                            </td>
                                            <td class="px-3">
                                                <div class="form-button-action">
                                                    <a href="#modalKonfirmasi" type="button" data-toggle="modal" data-target="#modalKonfirmasi" class="px-2 btn btn-default py-1 btn-delete" data-id="<?= $row['id']; ?> <?= $row['transaction_id']; ?> <?= $row['invoice_number'] ?> <?= $row['left_to_paid'] ?>" data-transaction="<?= $row['transaction_id']; ?>" data-xaja="<?= $row['invoice_number'] ?>">
                                                        Bayar
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>




                    <div class="modal fade" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLongTitle">Pembayaran Hutang</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php
                                echo form_open_multipart('data-keuangan/data-hutang-piutang/bayar-hutang'); ?>

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="pembayaran">Nominal Pembayaran <span class="text-danger">*</span></label>
                                                    <input type="tel" class="form-control pembayaran" id="pembayaran" placeholder="Masukkan jumlah uang yang dibayarkan" name="pembayaran" minlength=1 maxlength=11 autofocus required>
                                                    <?= form_error('fullname', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                                <div id="alert-msg"></div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="imageinput" class="col-form-label">Gambar <small>(opsional)</small></label>
                                                    <input type="file" class="form-control" id="imageinput" name="x">
                                                    <?= form_error('imageinput', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    
                                    <div class="mx-4 my-4">
                                        <h5>
                                            Mohon pastikan nominal pembayaran sudah benar dan sesuai. <br>
                                            <span class="text-danger">Setelah dibayar tidak dapat diubah.</span> <br>
                                            <span class="font-weight-bold">Sudah yakin?</span>
                                        </h5>
                                    </div>

                                    <div class="modal-footer">
                                        <input type="hidden" name="id" class="id"></input>
                                        <input type="hidden" name="transaction" class="transaction"></input>
                                        <input type="hidden" name="xaja" class="xaja"></input>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cek kembali</button>
                                        <button class="btn btn-outline-success">Yakin dan bayar</button>
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