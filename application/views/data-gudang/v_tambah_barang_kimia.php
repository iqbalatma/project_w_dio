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
                    <a href="<?= base_url('data-gudang/Data_barang_mentah'); ?>">Data Barang Kimia</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <?php
                    $attributes = ['id' => 'form_barang_kimia'];
                    echo form_open_multipart('data-gudang/Data_barang_mentah/insert', $attributes); ?>
                    <div class="card-header">
                        <div class="card-title">Form Tambah Data</div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="material">Kode Bahan</label>
                                    <input type="text" class="form-control material" id="material" placeholder="Masukkan kode bahan" name="material" minlength=3 maxlength=10 required autofocus>
                                    <?= form_error('material', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="fullname">Nama Bahan</label>
                                    <input type="text" class="form-control fullname" id="fullname" placeholder="Masukkan nama bahan" name="fullname" maxlength=100 required>
                                    <?= form_error('fullname', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="volumeinput">Volume</label>
                                    <input type="text" class="form-control volumeinput" id="volumeinput" placeholder="Masukkan volume bahan" name="volumeinput" required>
                                    <?= form_error('volumeinput', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div> -->
                                <input type="hidden" name="volumeinput" value=1>
                                <div class="form-group">
                                    <label for="unitbahan">Satuan Bahan</label>
                                    <select class="form-control unitbahan" id="unitbahan" name="unitbahan">
                                        <option value="gram">Gram</option>
                                        <option value="pcs">Pcs</option>
                                        <option value="mililiter">Mililiter</option>
                                    </select>
                                    <?= form_error('unitbahan', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="pricebase">Harga</label>
                                    <input type="tel" class="form-control pricebase" id="pricebase" placeholder="Masukkan Harga Bahan" name="pricebase" data-filter="\+?\d{0,6}">
                                    <?= form_error('pricebase', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="imageinput" class="col-form-label">Gambar</label>
                                    <input type="file" class="form-control" id="imageinput" name="imageinput">
                                    <?= form_error('imageinput', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div id="alert-msg"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <input type="hidden" name="id" class="id"></input>
                        <a href="<?= base_url('data-gudang/Data_barang_mentah'); ?>" type="button" class="btn btn-danger" data-dismiss="modal">Keluar</a>
                        <button type="submit" name="submit" class="btn btn-primary" id="submit_barang_kimia">Tambah Data</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>