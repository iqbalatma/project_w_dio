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
                        <div class="card-title">Checkout Station</div>
                    </div>

                    <?= form_open('Kasir/konfirmasi_kasir'); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="nama_pelanggan">Nama Pelanggan</label>
                                    <select class="form-control" id="nama_pelanggan" name="nama_pelanggan" onchange='changeValue(this.value)' required>
                                        <option value="">-Pilih Pelanggan-</option>


                                        <?php
                                        $jsArray = "var prdName = new Array();\n";
                                        foreach ($data_customer as $row) {
                                        ?>
                                            <option name="id_customer" value="<?= $row['id']; ?>"><?= $row['full_name']; ?></option>
                                            <?php
                                            $jsArray .= "prdName['" . $row['id'] . "'] = {alamat_pelanggan:'" . addslashes($row['address']) . "',phone:'" . addslashes($row['phone']) . "'};\n";
                                            ?>
                                        <?php
                                        }; ?>

                                    </select>
                                </div>




                                <div>
                                    <div class="form-group">
                                        <label for="custom_alamat">Custom Alamat ? </label>
                                        <input type="checkbox" class="ml-2" id="custom_alamat" name="custom_alamat" onclick="myFunction()">
                                        </input>
                                    </div>
                                    <div class="form-group">

                                    </div>
                                </div>

                                <div id="form_custom_kasir">
                                    <div class="form-group">
                                        <label for="alamat_pelanggan">Alamat Pelanggan</label>
                                        <input type="text" class="form-control" id="alamat_pelanggan" name="alamat_pelanggan" readonly>
                                        </input>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="phone" name="phone" readonly>
                                        </input>
                                    </div>
                                </div>


                                <script type="text/javascript">
                                    <?php echo $jsArray; ?>

                                    function myFunction() {
                                        // Get the checkbox
                                        var checkBox = document.getElementById("custom_alamat");
                                        // Get the output text
                                        var alamat = document.getElementById("alamat_pelanggan");

                                        // If the checkbox is checked, display the output text
                                        if (checkBox.checked == true) {
                                            alamat.removeAttribute('readonly');
                                        } else {

                                            alamat.setAttribute('readonly', true);
                                        }
                                    }





                                    function changeValue(id) {
                                        var sel = document.getElementById('nama_pelanggan');
                                        console.log(sel.value);
                                        // $(document).ready(function() {
                                        // document.writeln("<?php echo "" ?>");

                                        // });
                                        document.getElementById('alamat_pelanggan').value = prdName[id].alamat_pelanggan;
                                        document.getElementById('phone').value = prdName[id].phone;
                                    };
                                </script>


                                <div class="form-group">

                                    <label class="form-label">Barang yang dibeli</label>


                                    <div class="selectgroup selectgroup-pills">






                                        <?php
                                        $i = 0;
                                        foreach ($data_product as $row) {
                                        ?>
                                            <script type="text/javascript">

                                            </script>

                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="product[<?= $i; ?>]" id="product" value="<?= $row['id']; ?>" class="selectgroup-input kelas_product">
                                                <span class="selectgroup-button"><?= $row['full_name']; ?> | Rp <?= $row['selling_price']; ?></span>
                                                <?php

                                                $cek_kuantitas_material = $this->Kasir_model->cek_kuantitas_material($row['id']); //mencari data material berdasarkan id_product

                                                $kuantitas_product = array();
                                                $q = 0;
                                                foreach ($cek_kuantitas_material as $data) {
                                                    $volume = $data['volume'];
                                                    $material_id = $data['material_id']; //id material pada satu product

                                                    $cek_inventory = $this->Kasir_model->cek_inventory($material_id);
                                                    $cek_inventory = $cek_inventory[0]['quantity'];
                                                    $quantity = $cek_inventory / $volume;

                                                    // echo $volume . " ---" . $material_id . "--- " . $cek_inventory . " ---- " . $quantity;
                                                    // echo "<br>";
                                                    $kuantitas_product[$q] = $quantity;
                                                    $q++;
                                                }
                                                sort($kuantitas_product);
                                                $kuantitas_material = $kuantitas_product[0];
                                                ?>


                                                <select name="quantity[<?= $row['id']; ?>]" id="quantity<?= $i; ?>">
                                                    <?php
                                                    $j = 1;
                                                    while ($j <= $kuantitas_material) {
                                                    ?>
                                                        <option value="<?= $j; ?>"><?= $j; ?></option>

                                                    <?php
                                                        $j++;
                                                    }; ?>

                                                </select>

                                                <input type="text" class="" id="custom_harga<?= $i; ?>" name="custom_harga[<?= $row['id']; ?>]" placeholder="Custom Harga">
                                                </input>

                                            </label>

                                            <input type="hidden" id="selling_price<?= $i; ?>" value="<?= $row['selling_price'];; ?>">
                                        <?php
                                            $i++;
                                        }; ?>
                                        <input type="hidden" id="counter" value="<?= $i; ?>">




                                    </div>
                                </div>












                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <a href="<?= base_url(); ?>" class="btn btn-danger">Keluar</a>
                        <!-- <a href="#modal_kasir" class="btn btn-danger">Keluar</a> -->
                        <!-- Button trigger modal -->


                        <!-- <button type="button" class="btn btn-primary open-modal-kasir" data-toggle="modal" data-target="#modal">
                            Checkout
                        </button> -->
                        <!-- <button type="submit" class="btn btn-primary">Checkout</button> -->
                        <button type="submit" class="btn btn-primary">Checkout</button>
                    </div>




                    <!-- Modal -->
                    <!-- <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    </div> -->

                    <?= form_close(); ?>



                </div>
            </div>
        </div>
    </div>
</div>