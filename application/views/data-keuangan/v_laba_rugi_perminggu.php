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
            <h4 class="page-title">Data per Minggu - Laba & Rugi</h4>
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
                    <a href="<?= current_url() ?>">Data per Minggu</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <div class="w-75 mx-auto">
                            <ul class="nav nav-pills nav-fill ">
                                <li class="nav-item" style="visibility:<?= ($this->session->store_id == '1') ? '' : 'hidden' ?>;">
                                    <a class="nav-link <?= (getLastSegment() == 'perhari') ? 'active':''; ?>" href="<?= base_url("data-keuangan/data-laba-rugi/perhari"); ?>">Per Hari</a>
                                </li>
                                <li class="nav-item" style="visibility:<?= ($this->session->store_id == '1') ? '' : 'hidden' ?>;">
                                    <a class="nav-link <?= (getLastSegment() == 'perminggu') ? 'active':''; ?>" href="<?= base_url("data-keuangan/data-laba-rugi/perminggu"); ?>">Per Minggu</a>
                                </li>
                                <li class="nav-item" style="visibility:<?= ($this->session->store_id == '1') ? 'visible' : 'hidden' ?>;">
                                    <a class="nav-link <?= (getLastSegment() == 'perbulan') ? 'active':''; ?>" href="<?= base_url("data-keuangan/data-laba-rugi/perbulan"); ?>">Per Bulan</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-sm  table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="px-3" width="">No</th>
                                        <th class="px-3" width="">Minggu ke-n, Bulan - Tahun</th>
                                        <th class="px-3" width="">Penjualan</th>
                                        <th class="px-3" width="">Modal</th>
                                        <th class="px-3" width="">Pengeluaran</th>
                                        <th class="px-3" width="">Laba Rugi</th>
                                    </tr>
                                </thead>
                                <tfoot class="thead-light">
                                    <tr>
                                        <th class="px-3">No</th>
                                        <th class="px-3">Minggu ke-n, Bulan - Tahun</th>
                                        <th class="px-3">Penjualan</th>
                                        <th class="px-3">Modal</th>
                                        <th class="px-3">Pengeluaran</th>
                                        <th class="px-3">Laba Rugi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($labarugi as $row) : ?>
                                        <tr>
                                            <td class="px-3"><?= $i; ?></td>
                                            <td class="px-3"><?= "Minggu ke {$row['week_per_month']}, {$row['month_per_year']}" ?></td>
                                            <td class="px-3"><?= price_format($row['penjualan']) ?></td>
                                            <td class="px-3"><?= price_format($row['modal']) ?></td>
                                            <td class="px-3"><?= price_format($row['pengeluaran']) ?></td>
                                            <td class="px-3 font-weight-bold <?= ($row['total'] > 0) ? 'text-primary' : 'text-danger' ?>"><?= price_format($row['total']) ?></td>
                                        </tr>
                                    <?php $i++; endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>