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
            <h4 class="page-title">Forms</h4>
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
                    <a href="#">Kasir</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Kasir'); ?>">Checkout Kasir</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Konfirmasi Checkout</div>
                    </div>

                    <?= form_open('Kasir/insert'); ?>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="alamat_pelanggan">Nama Pelanggan</label>
                                    <input type="text" class="form-control" id="alamat_pelanggan" name="alamat_pelanggan" value="<?= $this->Customer_model->get_by_id($customer_id)->full_name; ?>" readonly>
                                    </input>
                                </div>
                                <div class="form-group">
                                    <label for="alamat_pelanggan">Barang-barang yang dibeli : </label>
                                    <br>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Barang</th>
                                                <th scope="col">Nama Barang</th>
                                                <th scope="col">Jumlah Barang</th>
                                                <th scope="col">Harga Barang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $i = 1;
                                            $harga_total = 0;
                                            foreach ($checkbox_value as $row) {
                                                $harga_produk = 0;
                                                $harga_produk = $this->Product_model->get_by_id($row)->selling_price;
                                                $data_custom = [
                                                    'code_product' => $this->Product_model->get_by_id($row)->product_code,
                                                    'id_customer' => $customer_id
                                                ];
                                                $tabel_custom = $this->Kasir_model->cek_harga_custom($data_custom);

                                                if ($custom_harga[$row] !== "") {
                                                    $harga_produk = $custom_harga[$row];
                                                } elseif ($tabel_custom) {
                                                    $harga_produk = $tabel_custom[0]['price'];
                                                }

                                            ?>
                                                <tr>
                                                    <th scope="row"><?= $i; ?></th>




                                                    <td><?= $this->Product_model->get_by_id($row)->product_code ?></td>
                                                    <td><?= $this->Product_model->get_by_id($row)->full_name ?></td>
                                                    <td><?= $quantity[$row]; ?></td>
                                                    <td>Rp <?= $harga_produk * $quantity[$row] ?></td>

                                                    <?php $harga_total += $harga_produk * $quantity[$row]; ?>

                                                </tr>
                                            <?php
                                                echo '<input type="hidden" name="quantity[' . $row . ']" value="' . $quantity[$row] . '">';
                                                echo '<input type="hidden" name="custom_harga[' . $row . ']" value="' . $custom_harga[$row] . '">';
                                                $i++;
                                            };

                                            echo '<input type="hidden" name="harga_total" value="' . $harga_total . '">';
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <label for="alamat_pelanggan">Harga Total</label>
                                    <input type="text" class="form-control" id="alamat_pelanggan" name="alamat_pelanggan" value="<?= "Rp " . $harga_total ?>" readonly>
                                    </input>
                                    <input type="hidden" name="total_harga" id="total_harga" value="<?= $harga_total; ?>">
                                </div>

                                <?php

                                foreach ($checkbox_value as $value) {
                                    echo '<input type="hidden" name="checkbox_value[]" value="' . $value . '">';
                                };
                                echo '<input type="hidden" name="customer_id" value="' . $customer_id . '">';
                                echo '<input type="hidden" name="address" value="' . $address . '">';




                                // foreach ($quantity as $value_quantity) {
                                //     echo '<input type="hidden" name="quantity[' . $row . ']" value="' . $value_quantity . '">';
                                // };
                                // foreach ($custom_harga as $value_custom_harga) {
                                //     echo '<input type="hidden" name="custom_harga[]" value="' . $value_custom_harga . '">';
                                // };
                                ?>



                            </div>


                        </div>
                    </div>
                    <div class="card-action">
                        <a href="<?= base_url("Kasir"); ?>" class="btn btn-danger">Keluar</a>
                        <!-- <a href="#modal_kasir" class="btn btn-danger">Keluar</a> -->
                        <!-- Button trigger modal -->


                        <button type="button" class="btn btn-primary open-modal-kasir" data-toggle="modal" data-target="#modal">
                            Konfirmasi Checkout
                        </button>
                        <!-- <button type="submit" class="btn btn-primary">Checkout</button> -->
                    </div>




                    <!-- Modal -->
                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi Checkout</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="modal-body">
                                    <label class="form-label" id="total_bayar">Total Bayar</label>
                                    <div class="form-group">
                                        <label class="form-label">Yang Dibayarkan</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="text" name="paid_amount" id="paid_amount" class="form-control" aria-label="Pembayaran" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?= form_close(); ?>



                </div>
            </div>
        </div>
    </div>
</div>