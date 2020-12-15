<div class="content">
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
                    <a href="<?= base_url('data-gudang/Data_barang_kimia'); ?>">Data Barang Kimia</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <?php
                    $attributes = ['id' => 'form_barang_kimia'];
                    echo form_open_multipart('data-gudang/Data_inventory_barang_mentah/update', $attributes); ?>
                    <div class="card-header">
                        <div class="card-title">Form Tambah Data</div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="id" class="id" value="<?= $data_form[0]->material_id; ?>"></input>
                                <div class="form-group">
                                    <label for="material">Kode Bahan</label>
                                    <input type="text" class="form-control material" id="material" placeholder="Masukkan kode bahan" name="material" readonly value="<?= $data_form[0]->material_code; ?>">
                                    <?= form_error('material', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="fullname">Nama Bahan</label>
                                    <input type="text" class="form-control fullname" id="fullname" placeholder="Masukkan nama bahan" name="fullname" readonly value="<?= $data_form[0]->full_name; ?>">
                                    <?= form_error('fullname', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="text" class="form-control quantity" id="quantity" placeholder="Masukkan quantity bahan" name="quantity" required value="<?= $data_form[0]->quantity; ?>">
                                    <?= form_error('quantity', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div id="alert-msg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">

                        <a href="<?= base_url('data-gudang/Data_inventory_barang_mentah'); ?>" type="button" class="btn btn-danger" data-dismiss="modal">Keluar</a>
                        <button type="submit" name="submit" class="btn btn-primary" id="submit_barang_kimia">Ubah Data</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>