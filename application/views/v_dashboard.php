    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                        <h5 class="text-white op-7 mb-2">Selamat datang kembali, <span class="font-weight-bold font-italic h4"><?= $this->session->username ?></span>!</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="informasi-perusahaan" class="btn btn-sm btn-white btn-border mr-2">
                            <span class="h6">Informasi Perusahaan</span>
                        </a>
                        <a href="<?= base_url('data-pelanggan/data-master-pelanggan/tambah') ?>" class="btn btn-sm btn-default">
                            <span class="h6">Tambah Pelanggan</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <!-- <div class="row mt--2">
                <div class="col-md-6">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title">Statistik keseluruhan</div>
                            <div class="card-category">Informasi harian tentang sistem</div>
                            <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                                <div class="px-2 pb-2 pb-md-0 text-center">
                                    <div id="circles-1"></div>
                                    <h6 class="fw-bold mt-3 mb-0">Pelanggan baru</h6>
                                </div>
                                <div class="px-2 pb-2 pb-md-0 text-center">
                                    <div id="circles-2"></div>
                                    <h6 class="fw-bold mt-3 mb-0">Bahan baku</h6>
                                </div>
                                <div class="px-2 pb-2 pb-md-0 text-center">
                                    <div id="circles-3"></div>
                                    <h6 class="fw-bold mt-3 mb-0">Produk</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title">Total pemasukan dan pengeluaran</div>
                            <div class="row py-3">
                                <div class="col-md-4 d-flex flex-column justify-content-around">
                                    <div>
                                        <h6 class="fw-bold text-uppercase text-success op-8">Total Pemasukan</h6>
                                        <h3 class="fw-bold">Rp. 7.300.000</h3>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-uppercase text-danger op-8">Total Pengeluaran</h6>
                                        <h3 class="fw-bold">Rp. 675.000</h3>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div id="chart-container">
                                        <canvas id="totalIncomeChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Statistik penjualan</div>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-success btn-border btn-round btn-sm mr-2">
                                        <span class="btn-label">
                                            <i class="fas fa-file-excel"></i>
                                        </span>
                                        Export
                                    </a>
                                    <a href="#" class="btn btn-default btn-border btn-round btn-sm">
                                        <span class="btn-label">
                                            <i class="fa fa-print"></i>
                                        </span>
                                        Print
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="min-height: 375px">
                                <canvas id="statisticsChart"></canvas>
                            </div>
                            <div id="myChartLegend"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title">Penjualan harian</div>
                            <div class="card-category">25 November 2020</div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="mb-4 mt-2">
                                <h1>Rp. 5.250.000</h1>
                            </div>
                            <div class="pull-in">
                                <canvas id="dailySalesChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="h1 fw-bold float-right text-warning">+7%</div>
                            <h2 class="mb-2">213</h2>
                            <p class="text-muted">Transaksi</p>
                            <div class="pull-in sparkline-fix">
                                <div id="lineChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->


            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="flaticon-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Pelanggan</p>
                                        <h4 class="card-title"><?= $totalCust ?> <small>terdaftar</small></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="flaticon-interface-6"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Transaksi Bulan Ini</p>
                                        <h4 class="card-title"><?= $totalTrxPerMonth ?> <small>kali</small></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="flaticon-graph"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Produk Terjual Bulan Ini</p>
                                        <h4 class="card-title"><?= $totalProductPerMonth ?> <small>item</small></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                        <i class="flaticon-success"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Transaksi Hutang Bulan Ini</p>
                                        <h4 class="card-title"><?= $totalUnpaidPerMonth ?> <small>transaksi</small></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <!-- [1] -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title font-weight-bold">5 Bahan Baku Ter-kritis</div>
                        </div>
                        <div class="card-body pb-0">

                            <?php foreach ($criticalMaterial as $row) : ?>
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="<?= base_url("assets/img/material/{$row['image']}") ?>" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1"><?= $row['full_name'] ?></h6>
                                    <small class="text-muted"><?= $row['material_code'] ?> / <?= $row['store_name'] ?></small>
                                </div>
                                <div class="d-flex ml-auto align-items-center">
                                    <h3 class="text-danger fw-bold"><?= $row['quantity'] ?></h3>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <?php endforeach; ?>
                            <p><a href="<?= base_url("data-gudang/data-barang-kritis") ?>">Selengkapnya...</a></p>
                        </div>
                    </div>
                </div>

                <!-- [2] -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title font-weight-bold">5 Produk Paling Sering Dibeli</div>
                        </div>
                        <div class="card-body pb-0">

                            <?php foreach ($mostBuy as $row) : ?>
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="<?= base_url("assets/img/product/{$row['image']}") ?>" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1"><?= $row['full_name'] ?></h6>
                                    <small class="text-muted"><?= $row['product_code'] ?> / <?= $row['store_name'] ?></small>
                                </div>
                                <div class="d-flex ml-auto align-items-center">
                                    <h3 class="text-info fw-bold"><?= $row['freq'] ?></h3>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <?php endforeach; ?>
                            <p><a href="<?= base_url("data-gudang/data-barang-laku") ?>">Selengkapnya...</a></p>
                        </div>
                    </div>
                </div>

                <!-- [3] -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title font-weight-bold">5 Produk Paling Jarang Dibeli</div>
                        </div>
                        <div class="card-body pb-0">

                            <?php foreach ($leastBuy as $row) : ?>
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="<?= base_url("assets/img/product/{$row['image']}") ?>" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1"><?= $row['full_name'] ?></h6>
                                    <small class="text-muted"><?= $row['product_code'] ?> / <?= $row['store_name'] ?></small>
                                </div>
                                <div class="d-flex ml-auto align-items-center">
                                    <h3 class="text-warning fw-bold"><?= $row['freq'] ?></h3>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <?php endforeach; ?>
                            <p><a href="<?= base_url("data-penjualan/data-penjualan") ?>">Selengkapnya...</a></p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <!-- [1] -->
                <div class="col-md-6">
                    <div class="card full-height">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title font-weight-bold">Invoice(s) - 10 Terakhir</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php 
                            $i = 0;
                            foreach ($lastInvoices1 as $row) :
                                $status = $row['left_to_paid'];
                                $row['price_total']  = price_format($row['price_total'], FALSE, TRUE);
                                $row['paid_amount']  = price_format($row['paid_amount'], FALSE, TRUE);
                                $row['left_to_paid'] = price_format($row['left_to_paid'], FALSE, TRUE);
                                if ($i != 0) : ?>
                                    <div class="separator-dashed"></div>
                                <?php endif; ?>
                                <div class="d-flex">
                                    <div class="avatar avatar-online">
                                        <a href="<?= base_url("generate-report/invoice/generate/{$row['id']}") ?>" class='btn-link'><span class="avatar-title rounded-circle border border-white bg-danger">pdf</span></a>
                                    </div>
                                    <div class="flex-1 ml-3 pt-1">
                                        <?php if ($status == 0 ) $status = '<span class="text-success pl-3">Lunas</span>';
                                        else $status = '<span class="text-warning pl-3">Belum lunas</span>';
                                        ?>
                                        <h6 class="text-uppercase fw-bold mb-1"><?= "{$row['invoice_number']} ({$row['store_name']}) $status"?></h6>
                                        <span class="text-muted"><?= "Harga total:&nbsp;{$row['price_total']} - Dibayar:&nbsp;{$row['paid_amount']} - Sisa:&nbsp;{$row['left_to_paid']}" ?></span>
                                        <span class="text-muted d-block"><?= "Transaction id: {$row['trx_id']}" ?></span>
                                    </div>
                                    <div class="float-right pt-1">
                                        <small class="text-muted"><?php $d = date_create($row['paid_at']); echo date_format($d,"d-M-Y") ?></small>
                                    </div>
                                </div>
                            <?php $i++; endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- [2] -->
                <div class="col-md-6">
                    <div class="card full-height">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title font-weight-bold">Invoice(s) - 10 Terakhir</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php 
                            $i = 0;
                            foreach ($lastInvoices2 as $row) :
                                $status = $row['left_to_paid'];
                                $row['price_total']  = price_format($row['price_total'], FALSE, TRUE);
                                $row['paid_amount']  = price_format($row['paid_amount'], FALSE, TRUE);
                                $row['left_to_paid'] = price_format($row['left_to_paid'], FALSE, TRUE);
                                if ($i != 0) : ?>
                                    <div class="separator-dashed"></div>
                                <?php endif; ?>
                                <div class="d-flex">
                                    <div class="avatar avatar-online">
                                        <a href="<?= base_url("generate-report/invoice/generate/{$row['id']}") ?>" class='btn-link'><span class="avatar-title rounded-circle border border-white bg-danger">pdf</span></a>
                                    </div>
                                    <div class="flex-1 ml-3 pt-1">
                                        <?php if ($status == 0 ) $status = '<span class="text-success pl-3">Lunas</span>';
                                        else $status = '<span class="text-warning pl-3">Belum lunas</span>';
                                        ?>
                                        <h6 class="text-uppercase fw-bold mb-1"><?= "{$row['invoice_number']} ({$row['store_name']}) $status"?></h6>
                                        <span class="text-muted"><?= "Harga total:&nbsp;{$row['price_total']} - Dibayar:&nbsp;{$row['paid_amount']} - Sisa:&nbsp;{$row['left_to_paid']}" ?></span>
                                        <span class="text-muted d-block"><?= "Transaction id: {$row['trx_id']}" ?></span>
                                    </div>
                                    <div class="float-right pt-1">
                                        <small class="text-muted"><?php $d = date_create($row['paid_at']); echo date_format($d,"d-M-Y") ?></small>
                                    </div>
                                </div>
                            <?php $i++; endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
