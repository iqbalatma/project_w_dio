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
            <h4 class="page-title">Forms</h4>
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
                    <a href="#">Data Gudang</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('data-gudang/Data_transaksi_barang'); ?>">Data Mutasi Barang</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('data-gudang/Data_transaksi_barang/v_mutasi_ke_cabang'); ?>">Mutasi Barang Ke Cabang</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title font-weight-bold">Pembelian Sukses : INVOICE <?= $cekout['invoice_number'] ?></div>
                        <div class="card-title">Mutasi ke <?= $namaToko ?></div>
                    </div>


                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12 ml-3">
                                <table>
                                    <tr>
                                        <td>
                                            <h3 class="font-weight-bold">Total belanja</h3>
                                        </td>
                                        <td>
                                            <h3>: <?= price_format($cekout['total_harga']) ?>,-</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="55%">
                                            <h3 class="font-weight-bold">Total bayar</h3>
                                        </td>
                                        <td>
                                            <h3>: <?= price_format(0) ?>,-</h3>
                                        </td>
                                    </tr>
                                </table>
                                <hr width="90%">
                                <table>
                                    <?php if ($cekout['sisa_bayar'] != 0) : ?>
                                        <tr>
                                            <td>
                                                <h3 class="font-weight-bold">Sisa yang harus dibayar</h3>
                                            </td>
                                            <td>
                                                <h3>: <?= price_format($cekout['total_harga']) ?>,-</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="65%">
                                                <h3 class="font-weight-bold">Tenggat waktu pembayaran</h3>
                                            </td>
                                            <td>
                                                <h3>: <?= mdate('%d - %M - %Y', human_to_unix($cekout['due_at'])) ?></h3>
                                            </td>
                                        </tr>
                                    <?php else : ?>
                                        <tr>
                                            <td>
                                                <h3 class="font-weight-bold" width="70%">Kembalian</h3>
                                            </td>
                                            <td>
                                                <h3>: <?= price_format($cekout['kembalian']) ?>,-</h3>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">

                        <a href="<?= base_url("generate-report/surat-jalan/generate/" . $id_invoice); ?>" target="_blank" class="btn btn-secondary mx-1">
                            <i class="fas fa-print mr-2"></i> Cetak Surat Jalan
                        </a>
                        <!-- <a href="#modal_kasir" class="btn btn-secondary">Keluar</a> -->
                        <!-- Button trigger modal -->
                        <a href="<?= base_url("generate-report/invoice/generate/" . $id_invoice); ?>" target="_blank" class="btn btn-secondary mx-1">
                            <i class="fas fa-print mr-2"></i> Cetak Invoice
                        </a>


                        <!-- <button type="submit" class="btn btn-primary">Checkout</button> -->
                    </div>




                    <!-- Modal -->
                    <!-- <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi Checkout</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="modal-body">
                                    <label class="form-label" id="total_bayar">Total Bayar</label>
                                    <div class="form-group">
                                        <label class="form-label">Yang Dibayarkan</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="text" name="paid_amount" id="paid_amount" class="form-control" aria-label="Pembayaran" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                                </div>
                            </div>
                        </div>
                    </div> -->





                </div>
            </div>
        </div>
    </div>
</div>