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
                    <a href="<?= base_url() ?>">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="<?= current_url() ?>">Kasir</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="<?= current_url() ?>">Checkout Kasir</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Konfirmasi Checkout</div>
                    </div>

                    <?= form_open('kasir/insert-dio'); ?>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12">

                                <div class="d-flex">
                                    <div class="form-group col-8">
                                        <label for="nama_pelanggan">Nama Pelanggan</label>
                                        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?= "{$data_customer->full_name}" ?>" readonly>
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="tipe_pelanggan">Tipe Pelanggan</label>
                                        <input type="text" class="form-control" id="tipe_pelanggan" name="tipe_pelanggan" value="<?= "{$data_customer->cust_type}" ?>" readonly>
                                    </div>
                                </div>

                                <div class="d-flex">
                                    <div class="form-group col-8">
                                        <label for="alamat_pelanggan">Alamat Pengiriman</label>
                                        <input type="text" class="form-control" id="alamat_pelanggan" name="alamat_pelanggan" value="<?= $address ?>" readonly>
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="phone_pelanggan">No. Telepon</label>
                                        <input type="text" class="form-control" id="phone_pelanggan" name="phone_pelanggan" value="<?= "{$phone}" ?>" readonly>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="barang_dibeli">Barang-barang yang dibeli : </label>
                                    <br>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Barang</th>
                                                <th scope="col">Nama Barang</th>
                                                <th scope="col">Jumlah Barang</th>
                                                <th scope="col">Harga Satuan</th>
                                                <th scope="col">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $i = 1;
                                            $harga_jumlah = 0;
                                            $harga_total = 0;
                                            foreach ($data_product as $row) :
                                                // $harga_produk = 0;
                                                // $harga_produk = $this->Product_model->get_by_id($row)->selling_price;
                                                // $data_custom = [
                                                //     'code_product' => $this->Product_model->get_by_id($row)->product_code,
                                                //     'id_customer' => $data_customer->id
                                                // ];
                                                // $tabel_custom = $this->Kasir_model->cek_harga_custom($data_custom);
                                                // pprintd($custom_harga);

                                                // if ($custom_harga[$row] !== "") {
                                                //     $harga_produk = $custom_harga[$row];
                                                // } elseif ($tabel_custom) {
                                                //     $harga_produk = $tabel_custom[0]['price'];
                                                // }

                                                // pprintd($row);

                                            ?>
                                                <tr>
                                                    <th scope="row"><?= $i; ?></th>
                                                    <td><?= $row['product_code'] ?></td>
                                                    <td><?= $row['full_name'] ?></td>
                                                    <td><?= $row['kasir_qty'] ?></td>
                                                    <td><?= price_format($row['kasir_price']) ?></td>
                                                    <?php $harga_jumlah = $row['kasir_price'] * $row['kasir_qty']; ?>
                                                    <td><?= price_format($harga_jumlah) ?></td>
                                                </tr>
                                            <?php
                                                echo '<input type="hidden" name="quantity[' . $row['id'] . ']" value="' . $row['id'] . '">';
                                                echo '<input type="hidden" name="custom_harga[' . $row['id'] . ']" value="' . $row['id'] . '">';

                                                $harga_total += $harga_jumlah;
                                                $i++;
                                            endforeach;


                                            // echo '<input type="hidden" name="harga_total" value="' . $harga_total . '">';
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <label for="harga_total">Harga Total</label>
                                    <input type="text" class="form-control" id="harga_total" name="harga_total" value="<?= price_format($harga_total) ?>" readonly>
                                    </input>
                                    <input type="hidden" name="total_harga" id="total_harga" value="<?= $harga_total; ?>">
                                </div>

                                <?php

                                // ini dulunya nge-foreach $checkbox_value, isi dan bentuknya sama2 id produk, beda variabel aja dari method konfirmasi kasir
                                foreach ($data_product as $row) {
                                    echo '<input type="hidden" name="checkbox_value[]" value="' . $row['id'] . '">';
                                };
                                echo '<input type="hidden" name="customer_id" value="' . $data_customer->id . '">';
                                echo '<input type="hidden" name="address" value="' . $address . '">';
                                echo '<input type="hidden" name="phone" value="' . $phone . '">';


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
                        <a href="<?= base_url("kasir"); ?>" class="btn btn-outline-danger px-5">Batal</a>
                        <!-- <a href="#modal_kasir" class="btn btn-danger">Keluar</a> -->
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary px-5 open-modal-kasir" data-toggle="modal" data-target="#modal"> Konfirmasi </button>
                        <!-- <button type="submit" class="btn btn-primary">Checkout</button> -->
                    </div>




                    <!-- Modal -->
                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h3 class="modal-title font-weight-bold h2" id="exampleModalLongTitle">Konfirmasi Checkout</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body" id="modal-body">
                                    <div class="form-group">
                                        <label class="form-label font-weight-normal" id="total_bayars"><h4> Total Belanjaan adalah: <?= price_format($harga_total) ?> </h4></label>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Jenis pembayaran</label>
                                        <div class="form-check mx-auto">
                                            <label class="form-check-label font-weight-normal">
                                                <input class="form-check form-check-inline" type="radio" name="payment_type" id="kontrabon" value="kontrabon" checked>
                                                Kontrabon
                                            </label>

                                            <label class="form-check-label font-weight-normal">
                                                <input class="form-check form-check-inline" type="radio" name="payment_type" id="transfer" value="transfer">
                                                Transfer
                                            </label>

                                            <label class="form-check-label font-weight-normal">
                                                <input class="form-check form-check-inline" type="radio" name="payment_type" id="cash" value="cash">
                                                Cash
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group payment_cash" style="display:none;">
                                        <label class="form-label">Yang Dibayarkan</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input required autofocus type="tel" name="paid_amount" id="paid_amount" class="form-control" aria-label="Pembayaran" maxlength=11 value=0>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-danger px-5" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary px-5">Checkout</button>
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