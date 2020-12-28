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
                    <a href="#">Data Barang</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('data-gudang/Data_inventory_barang_mentah'); ?>">Inventory Barang</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="w-75 mx-auto">
                            <ul class="nav nav-pills nav-fill ">
                                <li class="nav-item">
                                    <a class=" px-3 btn btn-success rounded" href="<?= base_url('data-gudang/Data_inventory_barang_mentah/v_insert'); ?>">Ubah Kuantitas Barang</a>
                                </li>
                                <li class="nav-item">
                                    <a class="px-3 btn btn-primary rounded" href="<?= base_url('data-gudang/Data_inventory_barang_mentah/'); ?>">Tampil Semua Data Inventory</a>
                                </li>
                                <li class="nav-item">
                                    <a class="px-3 btn btn-primary rounded" href="<?= base_url('data-gudang/Data_inventory_barang_mentah/v_data_by_store/1'); ?>">Tampil Inventory Gudang</a>
                                </li>
                                <li class="nav-item">
                                    <a class="px-3 btn btn-primary rounded" href="<?= base_url('data-gudang/Data_inventory_barang_mentah/v_data_by_store/3'); ?>">Tampil Inventory Cicalengka</a>
                                </li>
                                <li class="nav-item">
                                    <a class="px-3 btn btn-primary rounded" href="<?= base_url('data-gudang/Data_inventory_barang_mentah/v_data_by_store/3'); ?>">Tampil Inventory Ujungberung</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php

                    $date = new DateTime(null, new DateTimeZone('Asia/Jakarta'));




                    ?>




                    <div class="card-body">


                        <div class="table-responsive">
                            <table id="add-row" class="display table table-sm  table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="px-3" width="20px">No</th>
                                        <th class="px-3" width="30px">Kode Bahan</th>
                                        <th class="px-3">Nama Bahan</th>

                                        <th class="px-3">Jumlah</th>
                                        <th class="px-3">Titik Kritis</th>
                                        <th class="px-3">Tanggal Update</th>
                                        <th class="px-3">Diinput Oleh</th>
                                        <th class="px-3" style="width: 10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot class="thead-light">
                                    <tr>
                                        <th class="px-3" width="20px">No</th>
                                        <th class="px-3" width="30px">Kode Bahan</th>
                                        <th class="px-3">Nama Bahan</th>


                                        <th class="px-3">Jumlah</th>
                                        <th class="px-3">Titik Kritis</th>
                                        <th class="px-3">Tanggal Update</th>
                                        <th class="px-3">Diinput Oleh</th>
                                        <th class="px-3" style="width: 10%">Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>

                                    <?php
                                    $i = 1;
                                    foreach ($data_inventory_barang as $row) : ?>
                                        <tr>

                                            <td class="px-3">
                                                <?= $i++ ?>
                                            </td>
                                            <td class="px-3 <?= ($row->quantity > $row->critical_point) ? '' : 'text-danger' ?>">
                                                <?= $row->material_code ?>
                                            </td>
                                            <td class="px-3 <?= ($row->quantity > $row->critical_point) ? '' : 'text-danger' ?>">
                                                <?= $row->full_name ?>
                                            </td>

                                            <td class="px-3 <?= ($row->quantity > $row->critical_point) ? '' : 'text-danger' ?>">
                                                <?= $row->quantity ?>
                                            </td>
                                            <td class="px-3 <?= ($row->quantity > $row->critical_point) ? '' : 'text-danger' ?>">
                                                <?= $row->critical_point ?>
                                            </td>
                                            <td class="px-3">

                                                <?php
                                                if ($row->updated_at !== NULL) {
                                                    $dt = explode(' ', $row->updated_at);
                                                    $d = date_create($dt[0]);
                                                    echo "{$dt[1]} <br>" . date_format($d, "d-M-Y");
                                                } else {
                                                    echo "-";
                                                }
                                                ?>
                                            </td>
                                            <td class="px-3">
                                                <?= $row->created_by ?>
                                            </td>
                                            <td class="px-3">
                                                <div class="form-button-action">
                                                    <a href="<?= base_url('data-gudang/Data_inventory_barang_mentah/v_update_critical_point/' . $row->id); ?>" class="btn btn-link btn-edit" data-toggle="tooltip" title="Ubah Critical Point" data-original-title="Ubah"><i class="fa fa-edit"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>











                    <!-- Modal Insert -->
                    <div class="modal fade" id="modalInsert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Barang Kimia</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php
                                $attributes = ['id' => 'form_barang_masuk'];
                                echo form_open_multipart('data-gudang/Data_barang_masuk/insert', $attributes); ?>


                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="material_id">Kode Bahan</label>
                                        <select class="form-control material_id" id="material_id" name="material_id">
                                            <?php foreach ($data_barang_kimia as $row) {
                                            ?>
                                                <option value="<?= $row->id; ?>"><?= $row->full_name; ?></option>
                                            <?php
                                            }; ?>


                                        </select>
                                        <?= form_error('material_code', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="store">Toko</label>
                                        <select class="form-control store" id="store" name="store">
                                            <?php foreach ($data_store as $row) {
                                            ?>
                                                <option value="<?= $row->id; ?>"><?= $row->store_name; ?></option>
                                            <?php
                                            }; ?>
                                        </select>
                                        <?= form_error('material_code', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Jumlah</label>
                                        <input type="text" class="form-control quantity" id="quantity" placeholder="Masukkan jumlah barang" name="quantity" required>
                                        <?= form_error('quantity', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="updated_by">Dimasukkan Oleh</label>
                                        <input type="text" class="form-control updated_by" id="updated_by" placeholder="Masukkan penginput" name="updated_by" required>
                                        <?= form_error('updated_by', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>

                                    <div id="alert-msg"></div>
                                </div>

                                <div class="modal-footer">
                                    <input type="hidden" name="id" class="id"></input>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                                    <button type="submit" name="submit" id="submit_barang_masuk" class="btn btn-primary">Masukkan Barang</button>
                                </div>
                                <?= form_close(); ?>


                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi Hapus Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <h4>Yakin Ingin Menghapus Data ?</h4>
                                </div>

                                <form action="<?= base_url('data-gudang/Data_barang_mentah/delete'); ?>" method="POST">
                                    <div class="modal-footer">
                                        <input type="hidden" name="id" class="id"></input>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                                        <button class="btn btn-primary">Hapus Data</button>
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