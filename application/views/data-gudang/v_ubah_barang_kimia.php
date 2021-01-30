<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Perbarui Data Bahan Baku</h4>
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
                    <a href="<?= base_url(getBeforeLastSegment('', 3) . '/' . getBeforeLastSegment('', 2)) ?>">Data Master</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="<?= current_url() ?>">Perbarui Data</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <?php
                    $attributes = ['id' => 'form_barang_kimia'];
                    echo form_open_multipart('data-gudang/data-barang-mentah/update', $attributes); ?>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="id" class="id" value="<?= $data_form[0]->id; ?>"></input>
                                <div class="form-group">
                                    <label for="material">Kode Bahan</label>
                                    <input type="text" class="form-control material" id="material" placeholder="Masukkan kode bahan" name="material" minlength=3 maxlength=10 required value="<?= $data_form[0]->material_code; ?>">
                                    <?= form_error('material', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="fullname">Nama Bahan</label>
                                    <input type="text" class="form-control fullname" id="fullname" placeholder="Masukkan nama bahan" name="fullname" maxlength=100 required autofocus value="<?= $data_form[0]->full_name; ?>">
                                    <?= form_error('fullname', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="volumeinput">Volume</label>
                                    <input type="text" class="form-control volumeinput" id="volumeinput" placeholder="Masukkan nama bahan" name="volumeinput" required value="<?= $data_form[0]->volume; ?>">
                                    <?= form_error('volumeinput', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div> -->
                                <input type="hidden" name="volumeinput" value=1>
                                <div class="form-group">
                                    <label for="unitbahan">Satuan Bahan</label>
                                    <select class="form-control unitbahan" id="unitbahan" name="unitbahan" value="<?= $data_form[0]->unit; ?>">
                                        <option value="gram">Gram</option>
                                        <option value="pcs">Pcs</option>
                                        <option value="mililiter">Mililiter</option>
                                    </select>
                                    <?= form_error('unitbahan', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="pricebase">Harga</label>
                                    <input type="tel" class="form-control pricebase" id="pricebase" placeholder="Masukkan Harga Bahan" name="pricebase" data-filter="\+?\d{0,6}" value="<?= $data_form[0]->price_base; ?>">
                                    <?= form_error('pricebase', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="imageinput" class="col-form-label">Gambar</label>
                                    <input type="file" class="form-control" id="imageinput" name="imageinput" value="<?= $data_form[0]->material_code; ?>">
                                    <?= form_error('imageinput', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div id="alert-msg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" name="submit" class="btn btn-success" id="submit_barang_kimia">Simpan</button>
                        <a href="<?= base_url('data-gudang/data-barang-mentah'); ?>" type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</a>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>