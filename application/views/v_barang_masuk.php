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
                    <a href="<?= base_url('data-gudang/Data_barang_kimia'); ?>">Barang Masuk</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="col-md-4 pt-3">
                        <a class="btn btn-primary rounded" href="#modalInsert" type="button" data-toggle="modal" data-target="#modalInsert">Masukkan Barang</a>
                    </div>
                    <br>
                    <table class=" table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Bahan</th>
                                <th scope="col">Nama Bahan</th>
                                <th scope="col">Toko</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Tanggal Masuk</th>
                                <th scope="col">Dimasukkan Oleh</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;

                            foreach ($data_barang_masuk as $row) {
                            ?>
                                <tr>

                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $row->material_code ?></td>
                                    <td><?= $row->full_name ?></td>
                                    <td><?= $row->store_name ?></td>
                                    <td><?= $row->quantity ?></td>
                                    <td><?= $row->created_at; ?></td>
                                    <td><?= $row->updated_by; ?></td>
                                    <td>
                                        <!-- <a href="#modalUpdate" type="button" data-toggle="modal" data-target="#modalUpdate" id="id" data-id="<?= $row->id; ?>" data-material_code="<?= $row->material_code; ?>" data-full_name="<?= $row->full_name; ?>" data-unit="<?= $row->unit; ?>" data-volume="<?= $row->volume; ?>" data-price_base="<?= $row->price_base; ?>" data-image="<?= $row->image; ?>" class="btn btn-primary btn-sm btn-edit">Ubah</a>
                                        <a href="#modalKonfirmasi" type="button" data-toggle="modal" data-target="#modalKonfirmasi" class="btn btn-danger btn-sm btn-delete" data-id="<?= $row->id; ?>">Hapus</a> -->
                                    </td>
                                </tr>

                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>






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
                                        <label for="material_code">Kode Bahan</label>
                                        <select class="form-control material_code" id="material_code" name="material_code">
                                            <?php foreach ($data_barang_kimia as $row) {
                                            ?>
                                                <option value="<?= $row->material_code; ?>"><?= $row->full_name; ?></option>
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

                                <form action="<?= base_url('data-gudang/Data_barang_kimia/delete'); ?>" method="POST">
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