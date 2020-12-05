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


                    <div class="card-header">
                        <div class="card-title">Form Tambah Data</div>
                    </div>
                    <div class="card-body">

                        <?php
                        $attributes = ['id' => 'form_barang_masuk'];
                        echo form_open_multipart('data-gudang/Data_inventory_barang_mentah/insert', $attributes); ?>
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
                            <input type="text" class="form-control store    " name="store" id="store" value="Gudang Pusat" readonly disabled>

                        </div>
                        <div class="form-group">
                            <label for="quantity">Jumlah</label>
                            <input type="text" class="form-control quantity" id="quantity" placeholder="Masukkan jumlah barang" name="quantity" required>
                            <?= form_error('quantity', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <!-- <div class="form-group">
                            <label for="suplier">Suplier</label>
                            <input type="text" class="form-control suplier" id="suplier" placeholder="Masukkan penginput" name="suplier" required>
                            <?= form_error('suplier', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div> -->

                        <div id="alert-msg"></div>
                    </div>
                    <div class="card-action">
                        <input type="hidden" name="id" class="id"></input>
                        <a href="<?= base_url('data-gudang/Data_inventory_barang_mentah/'); ?>" type="button" class="btn btn-danger" data-dismiss="modal">Keluar</a>
                        <button type="submit" name="submit" id="submit_barang_masuk" class="btn btn-primary">Masukkan Barang</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
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
            echo form_open_multipart('data-gudang/Data_inventory_barang_mentah/insert', $attributes); ?>


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