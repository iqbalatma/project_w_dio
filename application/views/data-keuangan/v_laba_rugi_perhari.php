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
            <h4 class="page-title">Data per Hari - Laba & Rugi</h4>
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
                    <a href="<?= current_url() ?>">Data per Hari</a>
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
                                        <th class="px-3" width="20px">No</th>
                                        <th class="px-3" width="40px">Tanggal per Hari</th>
                                        <th class="px-3" width="30px">Modal</th>
                                        <th class="px-3" width="30px">Pemasukan</th>
                                        <th class="px-3" width="30px">Hutang</th>
                                        <th class="px-3">Untung/Rugi</th>

                                    </tr>
                                </thead>
                                <tfoot class="thead-light">
                                    <tr>
                                        <th class="px-3" width="20px">No</th>
                                        <th class="px-3" width="40px">Tanggal per Hari</th>
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
                                            <td class="px-3" width="5%px"><?= $i + 1; ?></td>
                                            <td class="px-3" width="40px"><?= date("d-M-Y", $tanggal_hari_ini[$i]); ?></td>
                                            <td class="px-3" width="30px"><?= price_format($total_modal[$i]); ?></td>
                                            <td class="px-3" width="30px"> <?= price_format($total_pemasukan[$i]); ?></td>
                                            <td class="px-3" width="30px"><?= price_format($hutang_array[$i]); ?></td>
                                            <td class="px-3" width="30px"><?= price_format($nilai_final[$i]); ?></td>
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