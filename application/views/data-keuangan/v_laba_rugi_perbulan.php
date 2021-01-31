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
            <h4 class="page-title">Data per Bulan - Laba & Rugi</h4>
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
                    <a href="<?= current_url() ?>">Data per Bulan</a>
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
                                        <th class="px-3" width="100px">Tanggal per Bulan</th>
                                        <th class="px-3" width="30px">Modal</th>
                                        <th class="px-3" width="30px">Pemasukan</th>
                                        <!-- <th class="px-3" width="30px">Hutang</th> -->
                                        <th class="px-3">Untung/Rugi</th>
                                    </tr>
                                </thead>
                                <tfoot class="thead-light">
                                    <tr>
                                        <th class="px-3" width="20px">No</th>
                                        <th class="px-3" width="100px">Tanggal per Bulan</th>
                                        <th class="px-3" width="30px">Modal</th>
                                        <th class="px-3" width="30px">Pemasukan</th>
                                        <!-- <th class="px-3" width="30px">Hutang</th> -->
                                        <th class="px-3">Untung/Rugi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    // echo "<pre>";
                                    // echo (date("m-Y", $tanggal_hari_ini[0]));
                                    // echo "<br>";
                                    // echo (date("m-Y", $tanggal_hari_ini[8]));
                                    // echo "</pre>";
                                    $counter = count($tanggal_hari_ini);
                                    $j = 0;
                                    $bulan = array();

                                    while ($j < $counter) {
                                        if (array_search(date("m-Y", $tanggal_hari_ini[$j]), $bulan) === false) {
                                            array_push($bulan, date("m-Y", $tanggal_hari_ini[$j]));
                                        }
                                        $j++;
                                    }

                                    $x = 0;

                                    // if (date("m-Y", $tanggal_hari_ini[2]) == $bulan[0]) {
                                    //     echo "BETUL";
                                    // }
                                    $status = false;
                                    $counter = 1;
                                    while ($x < count($bulan)) {

                                        // echo count($bulan);
                                        $tes = $bulan[$x];
                                        $total_modalx = 0;
                                        $total_pemasukanx = 0;
                                        $hutang_arrayx = 0;
                                        $nilai_finalx = 0;
                                        $i = 0;
                                        while ($i < count($total_modal)) {
                                            if (date("m-Y", $tanggal_hari_ini[$i]) == $tes) {
                                                $total_modalx += $total_modal[$i];
                                                $total_pemasukanx += $total_pemasukan[$i];
                                                $hutang_arrayx += $hutang_array[$i];
                                                $nilai_finalx += $nilai_final[$i];
                                            }
                                            $i++;
                                        }; ?>

                                        <tr>
                                            <td class="px-3" width="5%px"><?= $counter; ?></td>
                                            <td class="px-3" width="40px"><?= $tes ?></td>
                                            <td class="px-3" width="30px"><?= price_format($total_modalx); ?></td>
                                            <td class="px-3" width="30px"><?= price_format($total_pemasukanx); ?></td>
                                            <!-- <td class="px-3" width="30px"><?= price_format($hutang_arrayx); ?></td> -->
                                            <td class="px-3" width="30px"><?= price_format($nilai_finalx); ?></td>
                                        </tr>

                                    <?php
                                        $x++;
                                        $counter++;
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