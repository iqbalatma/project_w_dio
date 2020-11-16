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
                    <a href="<?= base_url('DataGudang/BarangKimia'); ?>">Data Barang Kimia</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="col-md-4">
                        <a class="btn btn-primary" href="#modalInsert" type="button" data-toggle="modal" data-target="#modalInsert">Tambah Data</a>
                    </div>
                    <br>
                    <table class=" table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Bahan</th>
                                <th scope="col">Nama Bahan</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_barang_kimia as $row) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $row->material_code ?></td>
                                    <td><?= $row->full_name ?></td>
                                    <td><?= $row->unit ?></td>
                                    <td><?= $row->volume ?></td>
                                    <td>Rp <?= $row->price_base ?></td>
                                    <td><?= $row->image ?></td>
                                    <td>
                                        <a href="#modalUpdate" type="button" data-toggle="modal" data-target="#modalUpdate" id="id" data-id="<?= $row->id; ?>" data-material_code="<?= $row->material_code; ?>" data-full_name="<?= $row->full_name; ?>" data-unit="<?= $row->unit; ?>" data-volume="<?= $row->volume; ?>" data-price_base="<?= $row->price_base; ?>" data-image="<?= $row->image; ?>" class="btn btn-primary btn-sm btn-edit">Ubah</a>
                                        <a href="#modalKonfirmasi" type="button" data-toggle="modal" data-target="#modalKonfirmasi" class="btn btn-danger btn-sm btn-delete" data-id="<?= $row->id; ?>">Hapus</a>
                                    </td>
                                </tr>

                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>




                    <!-- Modal Update-->
                    <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Ubah Data Barang Kimia</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('DataGudang/BarangKimia/update'); ?>" method="POST">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="material_code">Kode Bahan</label>
                                            <input type="text" class="form-control material_code" id="material_code" placeholder="Masukkan Kode Bahan" name="material_code">
                                            <?= form_error('material_code', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="full_name">Nama Bahan</label>
                                            <input type="text" class="form-control full_name" id="full_name" placeholder="Masukkan Nama Bahan" name="full_name">
                                            <?= form_error('full_name', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="unit">Satuan Bahan</label>
                                            <select class="form-control unit" id="unit" name="unit">
                                                <option value="gram">Gram</option>
                                                <option value="milimeter">Milimeter</option>
                                            </select>
                                        </div>
                                        <?= form_error('unit', '<small class="text-danger pl-3">', '</small>'); ?>
                                        <div class="form-group">
                                            <label for="volume">Stok</label>
                                            <input type="text" class="form-control volume" id="volume" placeholder="Masukkan Satuan Stok Bahan" name="volume">
                                            <?= form_error('volume', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="price_base">Harga</label>
                                            <input type="text" class="form-control price_base" id="price_base" placeholder="Masukkan Harga Bahan" name="price_base">
                                            <?= form_error('price_base', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>



                                        <div class="form-group">
                                            <label for="image">Gambar</label>
                                            <input type="text" class="form-control image" id="image" placeholder="Masukkan Satuan Stok Bahan" name="image">
                                            <?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <input type="hidden" name="id" class="id"></input>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                                        <button type="submit" class="btn btn-primary">Simpat Perubahan</button>
                                    </div>
                                </form>


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
                                <form action="<?= base_url('DataGudang/BarangKimia/insert'); ?>" method="POST">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="material_code">Kode Bahan</label>
                                            <input type="text" class="form-control material_code" id="material_code" placeholder="Masukkan Kode Bahan" name="material_code" required>
                                            <?= form_error('material_code', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="full_name">Nama Bahan</label>
                                            <input type="text" class="form-control full_name" id="full_name" placeholder="Masukkan Nama Bahan" name="full_name" required>
                                            <?= form_error('full_name', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="unit">Satuan Bahan</label>
                                            <select class="form-control unit" id="unit" name="unit">
                                                <option value="gram">Gram</option>
                                                <option value="milimeter">Milimeter</option>
                                            </select>
                                        </div>
                                        <?= form_error('unit', '<small class="text-danger pl-3">', '</small>'); ?>
                                        <div class="form-group">
                                            <label for="volume">Stok</label>
                                            <input type="text" class="form-control volume" id="volume" placeholder="Masukkan Satuan Stok Bahan" name="volume" required>
                                            <?= form_error('volume', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="price_base">Harga</label>
                                            <input type="text" class="form-control price_base" id="price_base" placeholder="Masukkan Harga Bahan" name="price_base" required>
                                            <?= form_error('price_base', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>



                                        <div class="form-group">
                                            <label for="image">Gambar</label>
                                            <input type="text" class="form-control image" id="image" placeholder="Masukkan Satuan Stok Bahan" name="image">
                                            <?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <input type="hidden" name="id" class="id"></input>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                                    </div>
                                </form>


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

                                <form action="<?= base_url('DataGudang/BarangKimia/delete'); ?>" method="POST">
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