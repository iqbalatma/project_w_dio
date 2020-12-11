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
                    <a href="#">Kasir</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Kasir'); ?>">Checkout Kasir</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Konfirmasi Checkout</div>
                    </div>


                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12">
                                <h3>Kembalian : Rp <?= $kembalian; ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">

                        <a href="<?= base_url("generate-report/surat-jalan/generate/" . $id_invoice); ?>" class="btn btn-primary">
                            <i class="fas fa-print mr-2"></i> Cetak Surat Jalan
                        </a>
                        <!-- <a href="#modal_kasir" class="btn btn-danger">Keluar</a> -->
                        <!-- Button trigger modal -->
                        <a href="<?= base_url("generate-report/invoice/generate/" . $id_invoice); ?>" class="btn btn-primary">
                            <i class="fas fa-print mr-2"></i> Cetak Invoice
                        </a>


                        <!-- <button type="submit" class="btn btn-primary">Checkout</button> -->
                    </div>




                    <!-- Modal -->
                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    </div>





                </div>
            </div>
        </div>
    </div>
</div>