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


            <h4 class="page-title">Data Barang</h4>
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
                    <a href="#">Data Keuangan</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('data-keuangan/Data_laba_rugi'); ?>">Laba Rugi</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <a href="<?= base_url("data-keuangan/Data_laba_rugi"); ?>" class="btn btn-primary">Labar Rugi Perhari</a>
                        <a href="<?= base_url("data-keuangan/Data_laba_rugi/perminggu"); ?>" class="btn btn-primary">Labar Rugi Perminggu</a>
                        <a href="<?= base_url("data-keuangan/Data_laba_rugi/perbulan"); ?>" class="btn btn-primary">Labar Rugi Perbulan</a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-sm  table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="px-3" width="20px">No</th>
                                        <th class="px-3" width="30px">Tanggal</th>
                                        <th class="px-3" width="30px">Modal</th>
                                        <th class="px-3" width="30px">Pemasukan</th>
                                        <th class="px-3" width="30px">Hutang</th>
                                        <th class="px-3">Untung/Rugi</th>

                                    </tr>
                                </thead>
                                <tfoot class="thead-light">
                                    <tr>
                                        <th class="px-3" width="20px">No</th>
                                        <th class="px-3" width="30px">Tanggal</th>
                                        <th class="px-3" width="30px">Modal</th>
                                        <th class="px-3" width="30px">Pemasukan</th>
                                        <th class="px-3" width="30px">Hutang</th>
                                        <th class="px-3">Untung/Rugi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    while ($i < count($total_modal)) {
                                    ?>
                                        <tr>
                                            <td class="px-3"><?= $i + 1; ?></td>
                                            <td class="px-5"><?= date("Y-M-d", $tanggal_hari_ini[$i]); ?></td>
                                            <td><?= price_format($total_modal[$i]); ?></td>
                                            <td><?= price_format($total_pemasukan[$i]); ?></td>
                                            <td><?= price_format($hutang_array[$i]); ?></td>
                                            <td><?= price_format($nilai_final[$i] - $hutang_array[$i]); ?></td>
                                        </tr>
                                    <?php
                                        $i++;
                                    }; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>






                </div>
            </div>
        </div>
    </div>
</div>