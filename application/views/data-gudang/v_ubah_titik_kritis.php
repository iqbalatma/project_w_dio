<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Perbarui Titik Kritis - Bahan Baku</h4>
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
                    <a href="<?= base_url(getBeforeLastSegment('', 3) . '/' . getBeforeLastSegment('', 2)) ?>">Data Bahan Baku</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url(getBeforeLastSegment('', 3) . '/' . getBeforeLastSegment('', 2)) ?>">Data Inventory</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="<?= current_url() ?>">Perbarui Titik Kritis</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <?php
                    $attributes = ['id' => 'form_barang_kimia'];
                    echo form_open_multipart('data-gudang/Data_inventory_barang_mentah/update', $attributes); ?>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="id" class="id" value="<?= $data_form[0]->material_id; ?>"></input>
                                <div class="form-group">
                                    <label for="material">Kode Bahan Baku</label>
                                    <input type="text" class="form-control material" id="material" placeholder="Masukkan kode bahan" name="material" readonly value="<?= $data_form[0]->material_code; ?>">
                                    <?= form_error('material', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="fullname">Nama Bahan Baku</label>
                                    <input type="text" class="form-control fullname" id="fullname" placeholder="Masukkan nama bahan" name="fullname" readonly value="<?= $data_form[0]->full_name; ?>">
                                    <?= form_error('fullname', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="quantity">Jumlah</label>
                                    <input type="tel" class="form-control quantity" id="quantity" placeholder="Masukkan jumlah bahan baku" name="quantity" data-filter="\+?\d{0,7}" autofocus required value="<?= $data_form[0]->quantity; ?>">
                                    <?= form_error('quantity', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div> -->
                                <div class="form-group">
                                    <label for="critical_point">Titik Kritis</label>
                                    <input type="tel" class="form-control critical_point" id="critical_point" placeholder="Masukkan jumlah bahan baku" name="critical_point" data-filter="\+?\d{0,7}" autofocus required value="<?= $data_form[0]->critical_point; ?>">
                                    <?= form_error('critical_point', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>

                                <div id="alert-msg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" name="submit" class="btn btn-success" id="submit_barang_kimia">Simpan</button>
                        <a href="<?= base_url('data-gudang/data-inventory-barang-mentah'); ?>" type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</a>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>