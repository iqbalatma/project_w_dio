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


            <h4 class="page-title">Data Penjualan</h4>
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
                    <a href="#">Data Penjualan</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('data-gudang/Data_barang_mentah'); ?>">Barang Masuk</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-sm  table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="px-3" width="20px">No</th>
                                        <th class="px-3" width="30px">Kode Product</th>
                                        <th class="px-3">Nama Product</th>
                                        <th class="px-3">Toko</th>
                                        <th class="px-3">Kode Mutasi</th>
                                        <th class="px-3">Kuantitas</th>
                                        <th class="px-3">Jenis Transaksi</th>
                                        <th class="px-3">Tanggal Transaksi</th>
                                        <th class="px-3">Transaksi Oleh</th>
                                    </tr>
                                </thead>
                                <tfoot class="thead-light">
                                    <tr>
                                        <th class="px-3" width="20px">No</th>
                                        <th class="px-3" width="30px">Kode Product</th>
                                        <th class="px-3">Nama Product</th>
                                        <th class="px-3">Toko</th>
                                        <th class="px-3">Kode Mutasi</th>
                                        <th class="px-3">Kuantitas</th>
                                        <th class="px-3">Jenis Transaksi</th>
                                        <th class="px-3">Tanggal Transaksi</th>
                                        <th class="px-3">Transaksi Oleh</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($data_master_penjualan as $row) : ?>
                                        <tr>
                                            <td class="px-3">
                                                <?= $i++ ?>
                                            </td>
                                            <td class="px-3">
                                                <?= $row['product_code'] ?>
                                            </td>
                                            <td class="px-3">
                                                <?= $row['full_name'] ?>
                                            </td>
                                            <td class="px-3">
                                                <?= $row['store_name'] ?>
                                            </td>
                                            <td class="px-3">
                                                <?= $row['mutation_code'] ?>
                                            </td>
                                            <td class="px-3">
                                                <?= $row['quantity'] ?>
                                            </td>
                                            <td class="px-3">
                                                <?= $row['mutation_type'] ?>
                                            </td>
                                            <td class="px-3">
                                                <?php $dt = explode(' ', $row['created_at']); $d = date_create($dt[0]); echo "{$dt[1]} <br>" . date_format($d,"d-M-Y") ?>
                                            </td>
                                            <td class="px-3">
                                                <?= $row['created_by'] ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>



                </div>
            </div>
        </div>
    </div>
</div>