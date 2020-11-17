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
                    <a href="<?= base_url('data-gudang/Data_barang_kimia'); ?>">Data Barang Kimia</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">


                    <div class="card-header">
                        <div class="col-md-4 pt-3">
                            <a class="btn btn-primary rounded" href="<?= base_url('data-gudang/Data_barang_kimia/v_insert'); ?>" type="button">Tambah Data</a>
                        </div>
                    </div>



                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-sm  table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="px-3" width="20px">No</th>
                                        <th class="px-3" width="30px">Kode Bahan</th>
                                        <th class="px-3">Nama Bahan</th>
                                        <th class="px-3">Volume</th>
                                        <th class="px-3">Satuan</th>
                                        <th class="px-3">Harga</th>
                                        <th class="px-3">Gambar</th>

                                        <th class="px-3" style="width: 10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot class="thead-light">
                                    <tr>
                                        <th class="px-3" width="20px">No</th>
                                        <th class="px-3" width="30px">Kode Bahan</th>
                                        <th class="px-3">Nama Bahan</th>
                                        <th class="px-3">Volume</th>
                                        <th class="px-3">Satuan</th>
                                        <th class="px-3">Harga</th>
                                        <th class="px-3">Gambar</th>
                                        <th class="px-3" style="width: 10%">Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($data_barang_kimia as $row) : ?>
                                        <tr>
                                            <td class="px-3">
                                                <?= $i++ ?>
                                            </td>
                                            <td class="px-3">
                                                <?= $row->material_code ?>
                                            </td>
                                            <td class="px-3">
                                                <?= $row->full_name ?>
                                            </td>
                                            <td class="px-3">
                                                <?= $row->volume ?>
                                            </td>
                                            <td class="px-3">
                                                <?= $row->unit ?>
                                            </td>
                                            <td class="px-3">
                                                Rp <?= $row->price_base ?>
                                            </td>
                                            <td class="px-3">
                                                <img src="<?= base_url(); ?>/assets/img/material/<?= $row->image; ?>" width="50px" alt="">
                                            </td>
                                            <td class="px-3">
                                                <div class="form-button-action">
                                                    <a href="<?= base_url('data-gudang/Data_barang_kimia/v_update/' . $row->id); ?>" class="btn btn-link btn-edit" data-toggle="tooltip" title="Hapus" data-original-title="Hapus"><i class="fa fa-edit"></i></a>


                                                    <a href="#modalKonfirmasi" type="button" data-toggle="modal" data-target="#modalKonfirmasi" class="btn btn-link btn-danger btn-delete" data-id="<?= $row->id; ?>"><i class="fa fa-times"></i></a>




                                                </div>
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


<!-- Modal Konfirmasi Hapus -->
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