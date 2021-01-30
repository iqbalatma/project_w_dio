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
                                        <th class="px-3" width="20px">No</th>
                                        <th class="px-3" width="100%">Range Tanggal per Minggu</th>
                                        <th class="px-3" width="30px">Modal</th>
                                        <th class="px-3" width="30px">Pemasukan</th>
                                        <th class="px-3" width="30px">Hutang</th>
                                        <th class="px-3">Untung/Rugi</th>
                                    </tr>
                                </thead>
                                <tfoot class="thead-light">
                                    <tr>
                                        <th class="px-3" width="20px">No</th>
                                        <th class="px-3" width="100%">Range Tanggal per Minggu</th>
                                        <th class="px-3" width="30px">Modal</th>
                                        <th class="px-3" width="30px">Pemasukan</th>
                                        <th class="px-3" width="30px">Hutang</th>
                                        <th class="px-3">Untung/Rugi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $data_master_tanggal = $tanggal_hari_ini;
                                    $tanggal_pertama = $data_master_tanggal[0];
                                    $tanggal_terakhir = $data_master_tanggal[count($data_master_tanggal) - 1];
                                    $counter = 1;
                                    while ($tanggal_pertama < $tanggal_terakhir) {
                                        $i = 0;
                                        $total_modal_perminggu = 0;
                                        $total_pemasukan_perminggu = 0;
                                        $total_hutang_perminggu = 0;
                                        $total_nilai_perminggu = 0;
                                        $tanggal_perminggu = $tanggal_pertama;
                                        $tanggal_tabel = "";
                                        while ($i < 8) {

                                            if ($i == 0 || $i == 7) {

                                                $tanggal_tabel .= date("d-M-Y", $tanggal_perminggu) . " / ";
                                            }

                                            $key = array_search($tanggal_perminggu, $data_master_tanggal);
                                            if ($key !== false) {

                                                $total_modal_perminggu += $total_modal[$key];
                                                $total_pemasukan_perminggu += $total_pemasukan[$key];
                                                $total_hutang_perminggu += $hutang_array[$key];
                                                $total_nilai_perminggu += $nilai_final[$key];
                                            }

                                            $tanggal_perminggu = $tanggal_perminggu + 86400;

                                            $i++;
                                        }
                                    ?>

                                        <tr>
                                            <td class="px-3" width="5%px"><?= $counter; ?></td>
                                            <td class="px-3" width="40px"><?= substr($tanggal_tabel, 0, -2); ?></td>
                                            <td class="px-3" width="30px"><?= price_format($total_modal_perminggu); ?></td>
                                            <td class="px-3" width="30px"> <?= price_format($total_pemasukan_perminggu); ?></td>
                                            <td class="px-3" width="30px"><?= price_format($total_hutang_perminggu); ?></td>
                                            <td class="px-3" width="30px"><?= price_format($total_nilai_perminggu); ?></td>
                                        </tr>

                                    <?php
                                        $tanggal_pertama = $tanggal_pertama + 86400 * 8;
                                        $counter++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>